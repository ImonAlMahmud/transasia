<?php
// Handle AJAX uploads BEFORE any HTML output
if (isset($_GET['action']) && $_GET['action'] === 'ajax_upload') {
    require_once '../includes/auth.php';
    require_once '../includes/db.php';
    require_once '../includes/functions.php';
    require_login();
    
    // CSRF Check for AJAX
    $token = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
    if (!validate_csrf_token($token)) {
        header('HTTP/1.1 403 Forbidden');
        echo json_encode(['success' => false, 'error' => 'CSRF token mismatch']);
        exit;
    }

    header('Content-Type: application/json');
    if (!empty($_FILES['file'])) {
        $file = $_FILES['file'];
        $upload_dir = '../downloads/';
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);
        
        $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $new_filename = 'ql_' . uniqid() . '.' . $file_ext;
        
        if (move_uploaded_file($file['tmp_name'], $upload_dir . $new_filename)) {
            echo json_encode(['success' => true, 'path' => 'downloads/' . $new_filename]);
            exit;
        }
    }
    echo json_encode(['success' => false]);
    exit;
}

$page_title = 'Site Settings';
$active_admin_page = 'settings';
require_once 'includes/admin-header.php';

$success_msg = '';
$error_msg = '';
$current_tab = $_GET['tab'] ?? 'general';

// Allowed settings keys to prevent pollution
$allowed_settings = [
    'general' => ['site_name', 'site_description', 'chairman_image', 'chairman_message'],
    'downloads' => ['quick_links'],
    'contact' => ['primary_email', 'support_phone', 'whatsapp_number', 'site_address', 'office_hours', 'map_embed_url'],
    'video' => ['company_video_url', 'company_video_autoplay', 'company_video_start_time', 'company_video_thumbnail', 'company_video_in_hero'],
    'social' => ['facebook_url', 'linkedin_url', 'whatsapp_number', 'twitter_url'],
    'seo' => ['meta_keywords', 'google_analytics_id', 'meta_description_global'],
    'smtp' => ['smtp_host', 'smtp_port', 'smtp_username', 'smtp_password', 'smtp_encryption', 'smtp_from_name', 'smtp_from_email'],
    'page_images' => [
        'home_hero_bg', 
        'about_header_bg', 'about_story_image', 'about_why_bd_image',
        'process_header_bg',
        'services_header_bg', 'advantage_image',
        'clients_header_bg',
        'contact_header_bg',
        'industries_header_bg',
        'blogs_header_bg'
    ],
    'security' => [] // Placeholder for now
];

$default_images = [
    'home_hero_bg' => 'images/hero-bg.jpg',
    'about_header_bg' => 'images/about-header.jpg', 
    'about_story_image' => 'images/office-team.jpg',
    'about_why_bd_image' => 'images/bangladesh-workforce.jpg',
    'services_header_bg' => 'images/services-header.jpg',
    'advantage_image' => 'images/advantage-recruitment.jpg',
    'process_header_bg' => 'images/hero-recruitment.jpg',
    'clients_header_bg' => 'images/clients-header.jpg',
    'contact_header_bg' => 'images/contact-header.jpg',
    'industries_header_bg' => 'images/industries-header.jpg',
    'blogs_header_bg' => 'images/blogs-header.jpg'
];

// Handle Settings Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF Validation
    $csrf_token = $_POST['csrf_token'] ?? '';
    if (!validate_csrf_token($csrf_token)) {
        $error_msg = "Security failure. CSRF token invalid.";
    } else {
        $tab_to_save = $_POST['tab'] ?? 'general';
        
        if (isset($allowed_settings[$tab_to_save])) {
            try {
                $pdo->beginTransaction();
            
            $stmt = $pdo->prepare("INSERT INTO site_settings (setting_key, setting_value) VALUES (?, ?) 
                                   ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)");
            
            // Handle checkbox for boolean values (unchecked boxes are not posted)
            if ($tab_to_save === 'video') {
                if (!isset($_POST['company_video_autoplay'])) $_POST['company_video_autoplay'] = '0';
                if (!isset($_POST['company_video_in_hero'])) $_POST['company_video_in_hero'] = '0';
            }

            foreach ($allowed_settings[$tab_to_save] as $key) {
                if (isset($_POST[$key])) {
                    $stmt->execute([$key, $_POST[$key]]);
                }
            }

            // Handle File Uploads
            if (!empty($_FILES)) {
                $upload_base_dir = '../images/'; // Relative to admin/
                if (!is_dir($upload_base_dir)) mkdir($upload_base_dir, 0755, true);

                foreach ($_FILES as $key => $file) {
                    if ($file['error'] === UPLOAD_ERR_OK && in_array($key, $allowed_settings[$tab_to_save])) {
                        $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                        
                        if (in_array($file_ext, $allowed_ext)) {
                            // Use the setting key as filename + extension (e.g., advantage_image.jpg)
                            // This ensures we don't accumulate unused files
                            $new_filename = $key . '.' . $file_ext;
                            $destination = $upload_base_dir . $new_filename;
                            
                            if (move_uploaded_file($file['tmp_name'], $destination)) {
                                // Save relative path for frontend use
                                $stmt->execute([$key, 'images/' . $new_filename]);
                            }
                        }
                    }
                }
            }

            $pdo->commit();
            
            // Log the activity
            log_activity("Update " . ucfirst($tab_to_save), "Admin updated the " . $tab_to_save . " settings");
            
            $success_msg = "Settings under " . ucfirst($tab_to_save) . " updated successfully!";
            $current_tab = $tab_to_save; // Keep the same tab
        } catch (Exception $e) {
            $pdo->rollBack();
            $error_msg = "Error updating settings: " . $e->getMessage();
        }
    }
}
}

// Handle Image Deletion
if (isset($_GET['action']) && $_GET['action'] === 'delete_image' && isset($_GET['key']) && isset($_GET['tab'])) {
    $token = $_GET['csrf_token'] ?? '';
    if (!validate_csrf_token($token)) {
        die('Security failure.');
    }
    
    $key_to_delete = $_GET['key'];
    $tab_redirect = $_GET['tab'];
    
    // Validate if the key belongs to page_images to prevent unauthorized deletion
    if (isset($allowed_settings['page_images']) && in_array($key_to_delete, $allowed_settings['page_images'])) {
        try {
            // Get current file path
            $stmt = $pdo->prepare("SELECT setting_value FROM site_settings WHERE setting_key = ?");
            $stmt->execute([$key_to_delete]);
            $current_path = $stmt->fetchColumn();
            
            // Delete file if it exists and is not a default system asset
            // We only delete if it flows through our upload system (starts with images/)
            // And we can even check if the filename contains the key to be extra safe
            if ($current_path && file_exists('../' . $current_path) && strpos($current_path, 'images/') === 0) {
                 unlink('../' . $current_path);
            }
            
            // Remove from database (set to empty string)
            $stmt = $pdo->prepare("UPDATE site_settings SET setting_value = '' WHERE setting_key = ?");
            $stmt->execute([$key_to_delete]);
            
            // Generate success message and redirect
            $redirect_url = "settings.php?tab=" . urlencode($tab_redirect) . "&msg=" . urlencode("Image removed successfully");
            header("Location: " . $redirect_url);
            exit;
        } catch (Exception $e) {
            $error_msg = "Error deleting image: " . $e->getMessage();
        }
    }
}


// Fetch System Logs if in security tab
$system_logs = [];
$total_logs = 0;
$logs_per_page = 15;
$current_page = isset($_GET['log_page']) ? max(1, intval($_GET['log_page'])) : 1;
$offset = ($current_page - 1) * $logs_per_page;

if ($current_tab === 'security') {
    try {
        // Get total count
        $count_stmt = $pdo->query("SELECT COUNT(*) FROM activity_logs");
        $total_logs = $count_stmt->fetchColumn();
        
        // Fetch paginated logs
        $stmt = $pdo->prepare("SELECT al.*, a.username FROM activity_logs al 
                             LEFT JOIN admins a ON al.admin_id = a.id 
                             ORDER BY al.created_at DESC 
                             LIMIT ? OFFSET ?");
        $stmt->execute([$logs_per_page, $offset]);
        $system_logs = $stmt->fetchAll();
    } catch (Exception $e) {
        $system_logs = []; // Fallback if table doesn't exist yet
    }
}

$total_pages = ceil($total_logs / $logs_per_page);

// Fetch all settings
$stmt = $pdo->query("SELECT * FROM site_settings");
$raw_settings = $stmt->fetchAll();
$settings = [];
foreach ($raw_settings as $row) {
    $settings[$row['setting_key']] = $row['setting_value'];
}

/**
 * Helper to render tab links
 */
function render_tab($id, $label, $icon, $active_tab) {
    $is_active = ($id === $active_tab);
    $style = $is_active 
        ? "background: #eff6ff; color: var(--admin-primary); font-weight: 600;" 
        : "color: var(--text-muted);";
    
    echo "<li><a href='settings.php?tab=$id' style='display: block; padding: 12px 20px; border-radius: 8px; text-decoration: none; transition: 0.3s; $style'>
          <i class='$icon' style='margin-right: 10px; width: 20px;'></i> $label</a></li>";
}
?>

<?php if ($success_msg): ?>
    <div style="background: #dcfce7; color: #166534; padding: 16px; border-radius: 8px; margin-bottom: 30px; border: 1px solid #bbf7d0;">
        <i class="fas fa-check-circle"></i> <?php echo $success_msg; ?>
    </div>
<?php endif; ?>

<?php if ($error_msg): ?>
    <div style="background: #fee2e2; color: #991b1b; padding: 16px; border-radius: 8px; margin-bottom: 30px; border: 1px solid #fecaca;">
        <i class="fas fa-exclamation-circle"></i> <?php echo $error_msg; ?>
    </div>
<?php endif; ?>

<div class="settings-grid" style="display: grid; grid-template-columns: 280px 1fr; gap: 40px; align-items: start;">
    
    <!-- Settings Nav -->
    <div class="content-card" style="padding: 10px;">
        <ul style="list-style: none; padding: 0; margin: 0;">
            <?php 
               render_tab('general', 'General', 'fas fa-cog', $current_tab);
                render_tab('downloads', 'Downloads', 'fas fa-file-download', $current_tab);
                render_tab('page_images', 'Page Images', 'fas fa-images', $current_tab);
                render_tab('video', 'Home Video', 'fas fa-video', $current_tab);
                render_tab('contact', 'Contact Info', 'fas fa-address-book', $current_tab);
                render_tab('social', 'Social Media', 'fas fa-share-alt', $current_tab);
                render_tab('smtp', 'SMTP Settings', 'fas fa-envelope-open-text', $current_tab);
                render_tab('seo', 'SEO & Metadata', 'fas fa-search', $current_tab);
                render_tab('security', 'Security & Logs', 'fas fa-shield-alt', $current_tab);
            ?>
        </ul>
    </div>

    <!-- Settings Form Area -->
    <div class="content-card" style="padding: 40px;">
        <form action="settings.php?tab=<?php echo $current_tab; ?>" method="POST" class="admin-form" enctype="multipart/form-data">
            <input type="hidden" name="tab" value="<?php echo $current_tab; ?>">
            <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">

            <?php if ($current_tab === 'general'): ?>
                <h2 style="margin-bottom: 30px; font-size: 22px;">General Website Settings</h2>
                <div style="margin-bottom: 24px;">
                    <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px;">Site Name</label>
                    <input type="text" name="site_name" value="<?php echo htmlspecialchars($settings['site_name'] ?? ''); ?>" style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; font-size: 15px;">
                </div>
                <div style="margin-bottom: 24px;">
                    <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px;">Site Description</label>
                    <textarea name="site_description" style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; font-size: 15px; min-height: 100px;"><?php echo htmlspecialchars($settings['site_description'] ?? ''); ?></textarea>
                </div>
                <div style="margin-bottom: 30px; display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px;">Primary Email</label>
                        <input type="email" name="primary_email" value="<?php echo htmlspecialchars($settings['primary_email'] ?? ''); ?>" style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; font-size: 15px;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px;">Support Phone</label>
                        <input type="text" name="support_phone" value="<?php echo htmlspecialchars($settings['support_phone'] ?? ''); ?>" style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; font-size: 15px;">
                    </div>
                </div>
                <div style="margin-bottom: 24px;">
                    <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px;">Chairman Image URL</label>
                    <input type="text" name="chairman_image" value="<?php echo htmlspecialchars($settings['chairman_image'] ?? 'images/chairman.jpg'); ?>" style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; font-size: 15px;" placeholder="images/chairman.jpg">
                </div>
                <div style="margin-bottom: 24px;">
                    <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px;">Chairman Message</label>
                    <textarea name="chairman_message" style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; font-size: 15px; min-height: 150px;"><?php echo htmlspecialchars($settings['chairman_message'] ?? ''); ?></textarea>
                </div>
                <div style="padding: 24px; background: #f8fafc; border-radius: 12px; margin-bottom: 30px;">
                    <h4 style="margin-bottom: 15px; font-size: 15px;">Website Logo</h4>
                    <div style="display: flex; align-items: center; gap: 30px;">
                        <img src="../images/logo.png" alt="Logo" height="50">
                        <button type="button" class="btn btn-outline-sm">Change Logo</button>
                        <p style="font-size: 12px; color: var(--text-muted);">Recommended: PNG, 400x120px</p>
                    </div>
                </div>

            <?php elseif ($current_tab === 'downloads'): ?>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                    <h2 style="font-size: 22px; margin: 0;">Quick Links Manager</h2>
                    <button type="button" onclick="addLink()" class="btn btn-primary" style="padding: 10px 20px; font-size: 14px; background: #2563eb;">
                        <i class="fas fa-plus" style="margin-right: 8px;"></i> Add New Link
                    </button>
                </div>

                <div id="links-container">
                    <!-- Links will be added here -->
                </div>

                <input type="hidden" name="quick_links" id="quick_links_input">

                <script>
                    let links = <?php echo !empty($settings['quick_links']) ? $settings['quick_links'] : '[]'; ?>;

                    function renderLinks() {
                        const container = document.getElementById('links-container');
                        container.innerHTML = '';

                        if (links.length === 0) {
                            container.innerHTML = `
                                <div style="text-align: center; padding: 60px 40px; background: #f8fafc; border: 2px dashed #e2e8f0; border-radius: 12px; color: #64748b;">
                                    <i class="fas fa-link fa-3x" style="margin-bottom: 20px; opacity: 0.3;"></i>
                                    <p style="margin: 0; font-size: 16px;">No quick links added yet.</p>
                                    <p style="margin-top: 5px; font-size: 14px;">Add your first link using the button above.</p>
                                </div>
                            `;
                            return;
                        }

                        links.forEach((link, index) => {
                            const card = document.createElement('div');
                            card.className = 'form-group';
                            card.style = 'margin-bottom: 30px; background: #fff; padding: 25px; border-radius: 12px; border: 1px solid #e2e8f0; position: relative; transition: all 0.2s;';
                            card.innerHTML = `
                                <button type="button" onclick="removeLink(${index})" style="position: absolute; top: 15px; right: 15px; background: #fee2e2; color: #dc3545; border: none; width: 32px; height: 32px; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center;" title="Remove Link">
                                    <i class="fas fa-times"></i>
                                </button>
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 15px;">
                                    <div>
                                        <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 8px; color: #334155;">Card Title</label>
                                        <input type="text" value="${escapeHtml(link.title)}" onchange="updateLink(${index}, 'title', this.value)" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;">
                                    </div>
                                    <div>
                                        <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 8px; color: #334155;">Icon (FontAwesome Class)</label>
                                        <input type="text" value="${escapeHtml(link.icon || 'fas fa-link')}" onchange="updateLink(${index}, 'icon', this.value)" placeholder="e.g. fas fa-file-pdf" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;">
                                    </div>
                                </div>
                                <div style="margin-bottom: 15px;">
                                    <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 8px; color: #334155;">Description</label>
                                    <textarea onchange="updateLink(${index}, 'desc', this.value)" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; min-height: 60px;">${escapeHtml(link.desc)}</textarea>
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 8px; color: #334155;">Target URL or Upload File</label>
                                    <div style="display: flex; gap: 10px;">
                                        <input type="text" id="url-${index}" value="${escapeHtml(link.url)}" onchange="updateLink(${index}, 'url', this.value)" placeholder="e.g. about.php or uploaded path" style="flex-grow: 1; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;">
                                        <button type="button" onclick="document.getElementById('file-input-${index}').click()" class="btn btn-outline-sm" style="background: #f1f5f9; white-space: nowrap;">
                                            <i class="fas fa-upload"></i> Upload
                                        </button>
                                        <input type="file" id="file-input-${index}" style="display: none;" onchange="handleFileUpload(this, ${index})">
                                    </div>
                                    <div id="progress-${index}" style="display: none; height: 4px; background: #e2e8f0; border-radius: 2px; margin-top: 8px; overflow: hidden;">
                                        <div id="progress-bar-${index}" style="width: 0%; height: 100%; background: #2563eb; transition: width 0.3s;"></div>
                                    </div>
                                </div>
                            `;
                            container.appendChild(card);
                        });
                    }

                    function handleFileUpload(input, index) {
                        if (!input.files || !input.files[0]) return;
                        
                        const file = input.files[0];
                        const formData = new FormData();
                        formData.append('file', file);

                        const progressBar = document.getElementById(`progress-bar-${index}`);
                        const progressContainer = document.getElementById(`progress-${index}`);
                        progressContainer.style.display = 'block';
                        progressBar.style.width = '0%';

                        fetch('settings.php?action=ajax_upload', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '<?php echo generate_csrf_token(); ?>'
                            },
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                progressBar.style.width = '100%';
                                setTimeout(() => {
                                    updateLink(index, 'url', data.path);
                                    document.getElementById(`url-${index}`).value = data.path;
                                    progressContainer.style.display = 'none';
                                }, 500);
                            } else {
                                alert('Upload failed. Please try again.');
                                progressContainer.style.display = 'none';
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred during upload.');
                            progressContainer.style.display = 'none';
                        });
                    }

                    function addLink() {
                        links.push({ title: 'New Link', desc: 'Brief description of this resource...', url: '#', icon: 'fas fa-link' });
                        renderLinks();
                        saveToInput();
                    }

                    function removeLink(index) {
                        if (confirm('Are you sure you want to remove this link?')) {
                            links.splice(index, 1);
                            renderLinks();
                            saveToInput();
                        }
                    }

                    function updateLink(index, key, value) {
                        links[index][key] = value;
                        saveToInput();
                    }

                    function saveToInput() {
                        document.getElementById('quick_links_input').value = JSON.stringify(links);
                    }

                    function escapeHtml(text) {
                        if (!text) return "";
                        const div = document.createElement('div');
                        div.textContent = text;
                        return div.innerHTML.replace(/"/g, '&quot;').replace(/'/g, '&#39;');
                    }

                    document.addEventListener('DOMContentLoaded', () => {
                        renderLinks();
                        saveToInput();
                    });

                    // Ensure value is saved on form submit
                    document.querySelector('form').addEventListener('submit', function() {
                        saveToInput();
                    });
                </script>

            <?php elseif ($current_tab === 'page_images'): ?>
                <h2 style="margin-bottom: 30px; font-size: 22px;">Page Images Management</h2>
                
                <div class="page-images-grid">
                    <?php 
                    $image_sections = [
                        'Home Page' => ['home_hero_bg' => 'Hero Section Background'],
                        'About Page' => [
                            'about_header_bg' => 'Header Background',
                            'about_story_image' => 'Company Story Image',
                            'about_why_bd_image' => 'Why Bangladesh Image'
                        ],
                        'Services Page' => [
                            'services_header_bg' => 'Header Background',
                            'advantage_image' => 'Trans Asia Advantage Image'
                        ],
                        'Recruitment Process' => ['process_header_bg' => 'Header Background'],
                        'Industries Page' => ['industries_header_bg' => 'Header Background'],
                        'Blogs Page' => ['blogs_header_bg' => 'Header Background'],
                        'Clients Page' => ['clients_header_bg' => 'Header Background'],
                        'Contact Page' => ['contact_header_bg' => 'Header Background']
                    ];

                    foreach ($image_sections as $section_title => $fields): 
                    ?>
                        <div class="section-group" style="margin-bottom: 40px; background: #fff; padding: 25px; border-radius: 12px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); border: 1px solid #eee;">
                            <h4 style="color: var(--admin-primary); margin-bottom: 20px; font-size: 18px; border-bottom: 2px solid #f0f0f0; padding-bottom: 10px;"><?php echo $section_title; ?></h4>
                            
                            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 25px;">
                                <?php foreach ($fields as $key => $label): 
                                    $has_custom = !empty($settings[$key]);
                                    $current_image = $has_custom ? $settings[$key] : ($default_images[$key] ?? '');
                                    // Fix relative path for admin view
                                    $display_path = '../' . $current_image;
                                ?>
                                <div class="image-card" style="background: #f8f9fa; padding: 15px; border-radius: 8px; border: 1px solid #e9ecef;">
                                    <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 12px; color: #333;"><?php echo $label; ?></label>
                                    
                                    <div class="image-preview" style="position: relative; margin-bottom: 15px; border-radius: 6px; overflow: hidden; border: 1px solid #ddd; aspect-ratio: 16/9; background: #eee;">
                                        <img src="<?php echo htmlspecialchars($display_path); ?>?t=<?php echo time(); ?>" 
                                             alt="Preview" 
                                             style="width: 100%; height: 100%; object-fit: cover;">
                                        
                                        <?php if ($has_custom): ?>
                                            <span style="position: absolute; top: 10px; right: 10px; background: var(--admin-primary); color: #fff; font-size: 11px; padding: 4px 8px; border-radius: 4px; font-weight: 600;">Custom</span>
                                        <?php else: ?>
                                            <span style="position: absolute; top: 10px; right: 10px; background: #6c757d; color: #fff; font-size: 11px; padding: 4px 8px; border-radius: 4px; font-weight: 600;">Default</span>
                                        <?php endif; ?>
                                    </div>

                                    <div style="display: flex; gap: 10px; align-items: center;">
                                        <div style="flex-grow: 1;">
                                            <input type="file" name="<?php echo $key; ?>" accept="image/*" id="file-<?php echo $key; ?>" class="inputfile" style="width: 100%; font-size: 13px;">
                                        </div>
                                        <?php if ($has_custom): ?>
                                            <a href="settings.php?action=delete_image&key=<?php echo $key; ?>&tab=page_images&csrf_token=<?php echo generate_csrf_token(); ?>" 
                                               class="btn-delete" 
                                               onclick="return confirm('Revert to default image?');"
                                               title="Revert to Default"
                                               style="display: flex; align-items: center; justify-content: center; width: 36px; height: 36px; background: #fee2e2; color: #dc3545; border-radius: 6px; text-decoration: none; transition: all 0.2s;">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    <p style="font-size: 12px; color: #888; margin-top: 8px; margin-bottom: 0;">
                                        <?php echo $has_custom ? 'Custom image uploaded.' : 'Using default system image.'; ?>
                                    </p>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            <?php elseif ($current_tab === 'contact'): ?>
                <h2 style="margin-bottom: 30px; font-size: 22px;">Contact Information</h2>
                <div style="margin-bottom: 24px;">
                    <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px;">Full Office Address</label>
                    <textarea name="site_address" style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; font-size: 15px; min-height: 80px;"><?php echo htmlspecialchars($settings['site_address'] ?? ''); ?></textarea>
                </div>
                <div style="margin-bottom: 24px;">
                    <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px;">Office Hours</label>
                    <input type="text" name="office_hours" value="<?php echo htmlspecialchars($settings['office_hours'] ?? 'Sunday-Thursday: 9:00 AM - 6:00 PM (BST)'); ?>" style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; font-size: 15px;">
                </div>
                <div style="margin-bottom: 24px;">
                    <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px;">Google Maps Embed URL</label>
                    <input type="text" name="map_embed_url" value="<?php echo htmlspecialchars($settings['map_embed_url'] ?? ''); ?>" placeholder="https://www.google.com/maps/embed?pb=..." style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; font-size: 15px;">
                </div>

            <?php elseif ($current_tab === 'social'): ?>
                <h2 style="margin-bottom: 30px; font-size: 22px;">Social Media Links</h2>
                <div style="margin-bottom: 24px;">
                    <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px;"><i class="fab fa-facebook" style="color: #1877f2; margin-right: 8px;"></i> Facebook Page URL</label>
                    <input type="url" name="facebook_url" value="<?php echo htmlspecialchars($settings['facebook_url'] ?? ''); ?>" style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; font-size: 15px;">
                </div>
                <div style="margin-bottom: 24px;">
                    <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px;"><i class="fab fa-linkedin" style="color: #0a66c2; margin-right: 8px;"></i> LinkedIn Company URL</label>
                    <input type="url" name="linkedin_url" value="<?php echo htmlspecialchars($settings['linkedin_url'] ?? ''); ?>" style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; font-size: 15px;">
                </div>
                <div style="margin-bottom: 24px;">
                    <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px;"><i class="fab fa-whatsapp" style="color: #25d366; margin-right: 8px;"></i> WhatsApp Number</label>
                    <input type="text" name="whatsapp_number" value="<?php echo htmlspecialchars($settings['whatsapp_number'] ?? ''); ?>" placeholder="+8801XXXXXXXXX" style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; font-size: 15px;">
                </div>
                <div style="margin-bottom: 24px;">
                    <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px;"><i class="fab fa-twitter" style="color: #1da1f2; margin-right: 8px;"></i> Twitter (X) URL</label>
                    <input type="url" name="twitter_url" value="<?php echo htmlspecialchars($settings['twitter_url'] ?? ''); ?>" style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; font-size: 15px;">
                </div>

            <?php elseif ($current_tab === 'seo'): ?>
                <h2 style="margin-bottom: 30px; font-size: 22px;">SEO & Global Metadata</h2>
                <div style="margin-bottom: 24px;">
                    <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px;">Global Meta Keywords</label>
                    <input type="text" name="meta_keywords" value="<?php echo htmlspecialchars($settings['meta_keywords'] ?? ''); ?>" style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; font-size: 15px;" placeholder="recruitment, manpower, bangladesh...">
                </div>
                <div style="margin-bottom: 24px;">
                    <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px;">Global Meta Description</label>
                    <textarea name="meta_description_global" style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; font-size: 15px; min-height: 80px;"><?php echo htmlspecialchars($settings['meta_description_global'] ?? ''); ?></textarea>
                </div>
                <div style="margin-bottom: 24px;">
                    <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px;">Google Analytics (G-ID)</label>
                    <input type="text" name="google_analytics_id" value="<?php echo htmlspecialchars($settings['google_analytics_id'] ?? ''); ?>" placeholder="G-XXXXXXXXXX" style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; font-size: 15px;">
                </div>

            <?php elseif ($current_tab === 'smtp'): ?>
                <h2 style="margin-bottom: 30px; font-size: 22px;">SMTP Configuration</h2>
                <div style="margin-bottom: 24px; display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px;">SMTP Host</label>
                        <input type="text" name="smtp_host" value="<?php echo htmlspecialchars($settings['smtp_host'] ?? 'smtp.gmail.com'); ?>" placeholder="e.g. smtp.gmail.com" style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; font-size: 15px;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px;">SMTP Port</label>
                        <input type="text" name="smtp_port" value="<?php echo htmlspecialchars($settings['smtp_port'] ?? '587'); ?>" placeholder="e.g. 587" style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; font-size: 15px;">
                    </div>
                </div>
                <div style="margin-bottom: 24px; display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px;">SMTP Username</label>
                        <input type="text" name="smtp_username" value="<?php echo htmlspecialchars($settings['smtp_username'] ?? ''); ?>" style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; font-size: 15px;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px;">SMTP Password</label>
                        <input type="password" name="smtp_password" value="<?php echo htmlspecialchars($settings['smtp_password'] ?? ''); ?>" style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; font-size: 15px;">
                    </div>
                </div>
                <div style="margin-bottom: 24px;">
                    <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px;">Encryption</label>
                    <select name="smtp_encryption" style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; font-size: 15px;">
                        <option value="none" <?php echo ($settings['smtp_encryption'] ?? '') === 'none' ? 'selected' : ''; ?>>None</option>
                        <option value="ssl" <?php echo ($settings['smtp_encryption'] ?? '') === 'ssl' ? 'selected' : ''; ?>>SSL</option>
                        <option value="tls" <?php echo ($settings['smtp_encryption'] ?? '') === 'tls' ? 'selected' : ''; ?>>TLS</option>
                    </select>
                </div>
                <div style="margin-bottom: 24px; display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px;">From Name</label>
                        <input type="text" name="smtp_from_name" value="<?php echo htmlspecialchars($settings['smtp_from_name'] ?? 'TransAsia System'); ?>" style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; font-size: 15px;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px;">From Email Address</label>
                        <input type="email" name="smtp_from_email" value="<?php echo htmlspecialchars($settings['smtp_from_email'] ?? 'noreply@transasia.ltd'); ?>" style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; font-size: 15px;">
                    </div>
                </div>

            <?php elseif ($current_tab === 'video'): ?>
                <h2 style="margin-bottom: 30px; font-size: 22px;">Company Overview Video</h2>
                <div style="margin-bottom: 24px;">
                    <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px;">Video URL (YouTube/Vimeo/Direct)</label>
                    <input type="url" name="company_video_url" value="<?php echo htmlspecialchars($settings['company_video_url'] ?? ''); ?>" placeholder="https://www.youtube.com/watch?v=..." style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; font-size: 15px;">
                    <p style="font-size: 13px; color: var(--text-muted); margin-top: 5px;">Supports YouTube, Vimeo, or direct MP4 links.</p>
                </div>
                <div style="margin-bottom: 24px; display: flex; align-items: center; gap: 10px;">
                    <input type="checkbox" name="company_video_autoplay" id="autoplay" value="1" <?php echo ($settings['company_video_autoplay'] ?? '') == '1' ? 'checked' : ''; ?> style="width: 18px; height: 18px;">
                    <label for="autoplay" style="font-weight: 600; font-size: 15px; cursor: pointer;">Enable Autoplay</label>
                </div>
                <div style="margin-bottom: 24px; display: flex; align-items: center; gap: 10px;">
                    <input type="checkbox" name="company_video_in_hero" id="hero_video" value="1" <?php echo ($settings['company_video_in_hero'] ?? '') == '1' ? 'checked' : ''; ?> style="width: 18px; height: 18px;">
                    <label for="hero_video" style="font-weight: 600; font-size: 15px; cursor: pointer;">Show Video in Header (Left Side)</label>
                </div>
                <div style="margin-bottom: 24px;">
                    <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px;">Start Time (Seconds)</label>
                    <input type="number" name="company_video_start_time" value="<?php echo htmlspecialchars($settings['company_video_start_time'] ?? '0'); ?>" min="0" style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; font-size: 15px;">
                </div>
                <div style="margin-bottom: 24px;">
                    <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px;">Thumbnail Image URL (Optional)</label>
                    <input type="text" name="company_video_thumbnail" value="<?php echo htmlspecialchars($settings['company_video_thumbnail'] ?? ''); ?>" placeholder="images/video-thumb.jpg" style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 8px; font-size: 15px;">
                </div>

            <?php elseif ($current_tab === 'security'): ?>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h2 style="font-size: 22px; margin: 0;">System Activity Log</h2>
                    <a href="export_logs.php?csrf_token=<?php echo generate_csrf_token(); ?>" class="btn btn-outline-sm" style="background: #10b981; color: white; border-color: #10b981;">
                        <i class="fas fa-download" style="margin-right: 8px;"></i> Export to CSV
                    </a>
                </div>
                <div style="overflow-x: auto;">
                    <table class="admin-table" style="min-width: 600px;">
                        <thead>
                            <tr>
                                <th>Date & Time</th>
                                <th>Admin</th>
                                <th>Action</th>
                                <th style="min-width: 200px;">Description</th>
                                <th>IP Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($system_logs)): ?>
                            <tr>
                                <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 40px;">No logs found.</td>
                            </tr>
                            <?php endif; ?>
                            <?php foreach ($system_logs as $log): ?>
                            <tr style="font-size: 13px;">
                                <td style="color: var(--text-muted);"><?php echo date('M d, H:i:s', strtotime($log['created_at'])); ?></td>
                                <td style="font-weight: 600;"><?php echo htmlspecialchars($log['username'] ?? 'System'); ?></td>
                                <td><span class="badge badge-pending" style="background: #f1f5f9; color: #475569;"><?php echo htmlspecialchars($log['action']); ?></span></td>
                                <td><?php echo htmlspecialchars($log['description']); ?></td>
                                <td style="font-family: monospace; color: var(--text-muted);"><?php echo $log['ip_address']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <?php if ($total_pages > 1): ?>
                <div style="display: flex; justify-content: center; align-items: center; gap: 10px; margin-top: 30px;">
                    <?php if ($current_page > 1): ?>
                        <a href="?tab=security&log_page=<?php echo $current_page - 1; ?>" class="btn btn-outline-sm" style="padding: 8px 16px;">
                            <i class="fas fa-chevron-left"></i> Previous
                        </a>
                    <?php endif; ?>
                    
                    <span style="padding: 8px 16px; color: var(--text-muted); font-size: 14px;">
                        Page <?php echo $current_page; ?> of <?php echo $total_pages; ?> (<?php echo $total_logs; ?> total logs)
                    </span>
                    
                    <?php if ($current_page < $total_pages): ?>
                        <a href="?tab=security&log_page=<?php echo $current_page + 1; ?>" class="btn btn-outline-sm" style="padding: 8px 16px;">
                            Next <i class="fas fa-chevron-right"></i>
                        </a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                </div>
                
                <div style="margin-top: 40px; padding: 24px; background: #fffcf0; border: 1px solid #fde68a; border-radius: 12px;">
                    <h4 style="color: #92400e; margin-bottom: 10px;"><i class="fas fa-user-shield"></i> Password Management</h4>
                    <p style="font-size: 14px; color: #b45309; margin-bottom: 15px;">To change administrator passwords or manage account access, please visit the Users section.</p>
                    <a href="users.php" class="btn btn-outline-dark" style="background: white;">Manage Accounts</a>
                </div>
            <?php endif; ?>

            <?php if ($current_tab !== 'security'): ?>
                <div style="display: flex; justify-content: flex-end; gap: 15px; border-top: 1px solid var(--border-color); padding-top: 30px; margin-top: 30px;">
                    <button type="reset" class="btn btn-outline-dark" style="padding: 10px 24px; border: 1px solid var(--border-color); border-radius: 8px; cursor: pointer;">Cancel</button>
                    <button type="submit" class="btn btn-primary" style="padding: 10px 24px; border: none; border-radius: 8px; background: var(--admin-primary); color: white; font-weight: 600; cursor: pointer;">Save Changes</button>
                </div>
            <?php endif; ?>
        </form>
    </div>
</div>

<?php include 'includes/admin-footer.php'; ?>
