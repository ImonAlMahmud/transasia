<?php
$page_title = 'Media Library';
$active_admin_page = 'pages';
require_once 'includes/admin-header.php';

$upload_dir = '../images/';
$success_msg = '';
$error_msg = '';

// Handle Image Upload or Replace
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? 'upload';
    $target_file = $_POST['target_file'] ?? '';

    // 1. Handle File Upload (New or Replace)
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['image'];
        $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed_exts = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp'];
        
        if (in_array($file_ext, $allowed_exts)) {
            // If replacing, keep existing name. If uploading, use original name.
            $new_filename = ($action === 'replace' && $target_file) ? $target_file : preg_replace('/[^a-zA-Z0-9_\-\.]/', '', $file['name']);
            
            if (move_uploaded_file($file['tmp_name'], $upload_dir . $new_filename)) {
                log_activity(($action === 'replace' ? "Replace Media" : "Upload Media"), ($action === 'replace' ? "Replaced $target_file with uploaded file" : "Uploaded image: $new_filename"));
                $success_msg = "Image " . ($action === 'replace' ? "replaced" : "uploaded") . " successfully!";
            } else {
                $error_msg = "Failed to save image.";
            }
        } else {
            $error_msg = "Invalid file type. Allowed: " . implode(', ', $allowed_exts);
        }
    }
    
    // 2. Handle Replace via URL
    elseif ($action === 'replace_url' && !empty($_POST['url']) && $target_file) {
        $url = $_POST['url'];
        $file_content = @file_get_contents($url);
        
        if ($file_content !== false) {
            // Check if it's actually an image (basic check)
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime_type = $finfo->buffer($file_content);
            $allowed_mimes = ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml', 'image/webp'];
            
            if (in_array($mime_type, $allowed_mimes)) {
                if (file_put_contents($upload_dir . $target_file, $file_content)) {
                    log_activity("Replace Media", "Replaced $target_file with URL: $url");
                    $success_msg = "Image replaced successfully from URL!";
                } else {
                    $error_msg = "Failed to save image from URL.";
                }
            } else {
                $error_msg = "URL does not point to a valid image.";
            }
        } else {
            $error_msg = "Could not fetch image from URL.";
        }
    }
}

// Handle Image Deletion
if (isset($_GET['delete'])) {
    $delete_file = $_GET['delete'];
    // Security check: ensure file is in images/ and is a valid image ext
    $file_ext = strtolower(pathinfo($delete_file, PATHINFO_EXTENSION));
    $allowed_exts = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp'];
    
    if (in_array($file_ext, $allowed_exts) && !str_contains($delete_file, '/') && file_exists($upload_dir . $delete_file)) {
        if (unlink($upload_dir . $delete_file)) {
            log_activity("Delete Media", "Deleted image: $delete_file");
            $success_msg = "Image deleted successfully.";
        } else {
            $error_msg = "Could not delete image.";
        }
    }
}

// Scan images directory
$files = array_diff(scandir($upload_dir), ['.', '..']);
$images = [];
foreach ($files as $file) {
    if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp'])) {
        $images[] = [
            'name' => $file,
            'size' => round(filesize($upload_dir . $file) / 1024, 2) . ' KB',
            'modified' => date("M d, Y", filemtime($upload_dir . $file))
        ];
    }
}
?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
    <h2>Media Library</h2>
    <button onclick="document.getElementById('file-upload').click()" class="btn btn-primary">
        <i class="fas fa-upload"></i> Upload Image
    </button>
    <form id="upload-form" action="media.php" method="POST" enctype="multipart/form-data" style="display: none;">
        <input type="hidden" name="action" id="form-action" value="upload">
        <input type="hidden" name="target_file" id="form-target" value="">
        <input type="file" id="file-upload" name="image" onchange="document.getElementById('upload-form').submit()">
    </form>
</div>

<?php if ($success_msg): ?>
    <div style="background: #dcfce7; color: #166534; padding: 15px; border-radius: 8px; margin-bottom: 25px; border: 1px solid #bbf7d0;">
        <i class="fas fa-check-circle"></i> <?php echo $success_msg; ?>
    </div>
<?php endif; ?>

<?php if ($error_msg): ?>
    <div style="background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 25px; border: 1px solid #fecaca;">
        <i class="fas fa-exclamation-circle"></i> <?php echo $error_msg; ?>
    </div>
<?php endif; ?>

<div class="content-card">
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; padding: 10px;">
        <?php foreach ($images as $img): ?>
        <div style="border: 1px solid var(--border-color); border-radius: 12px; overflow: hidden; background: white; transition: transform 0.2s; position: relative;" class="media-item">
            <div style="height: 150px; display: flex; align-items: center; justify-content: center; background: #f8fafc; overflow: hidden;">
                <img src="../images/<?php echo $img['name']; ?>" style="max-width: 100%; max-height: 100%; object-fit: contain;">
            </div>
            <div style="padding: 12px;">
                <div style="font-size: 13px; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="<?php echo $img['name']; ?>">
                    <?php echo $img['name']; ?>
                </div>
                <div style="font-size: 11px; color: var(--text-muted); margin-top: 4px; display: flex; justify-content: space-between;">
                    <span><?php echo $img['size']; ?></span>
                    <span><?php echo $img['modified']; ?></span>
                </div>
            </div>
            <div style="padding: 8px; border-top: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <a href="../images/<?php echo $img['name']; ?>" target="_blank" class="btn-action" title="View Full Image"><i class="fas fa-eye"></i></a>
                    <div style="display: inline-block; position: relative;" class="dropdown">
                        <button class="btn-action" title="Replace Image"><i class="fas fa-sync-alt"></i></button>
                        <div class="dropdown-content">
                            <a href="#" onclick="replaceByFile('<?php echo $img['name']; ?>')"><i class="fas fa-upload"></i> Upload File</a>
                            <a href="#" onclick="replaceByURL('<?php echo $img['name']; ?>')"><i class="fas fa-link"></i> Via Link</a>
                        </div>
                    </div>
                </div>
                <a href="?delete=<?php echo urlencode($img['name']); ?>" class="btn-action" style="color: #ef4444;" title="Delete" onclick="return confirm('Delete this image forever?')"><i class="fas fa-trash"></i></a>
            </div>
        </div>
        <?php endforeach; ?>
        
        <?php if (empty($images)): ?>
        <div style="grid-column: 1 / -1; text-align: center; padding: 60px; color: var(--text-muted);">
            <i class="fas fa-images fa-4x" style="margin-bottom: 20px; opacity: 0.2; display: block;"></i>
            No images found in the library.
        </div>
        <?php endif; ?>
    </div>
</div>

<style>
.media-item:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-md);
}

/* Dropdown Styles */
.dropdown { position: relative; display: inline-block; }
.dropdown-content {
    display: none;
    position: absolute;
    background-color: white;
    min-width: 140px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.1);
    z-index: 10;
    border-radius: 8px;
    padding: 8px 0;
    bottom: 100%;
    left: 0;
    border: 1px solid var(--border-color);
}
.dropdown:hover .dropdown-content { display: block; }
.dropdown-content a {
    color: var(--text-main);
    padding: 8px 16px;
    text-decoration: none;
    display: block;
    font-size: 13px;
}
.dropdown-content a:hover { background-color: #f1f5f9; }
</style>

<script>
function replaceByFile(filename) {
    document.getElementById('form-action').value = 'replace';
    document.getElementById('form-target').value = filename;
    document.getElementById('file-upload').click();
}

function replaceByURL(filename) {
    const url = prompt("Enter image URL to replace " + filename + ":");
    if (url) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'media.php';
        
        const actionInput = document.createElement('input');
        actionInput.type = 'hidden';
        actionInput.name = 'action';
        actionInput.value = 'replace_url';
        
        const targetInput = document.createElement('input');
        targetInput.type = 'hidden';
        targetInput.name = 'target_file';
        targetInput.value = filename;
        
        const urlInput = document.createElement('input');
        urlInput.type = 'hidden';
        urlInput.name = 'url';
        urlInput.value = url;
        
        form.appendChild(actionInput);
        form.appendChild(targetInput);
        form.appendChild(urlInput);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>

<?php include 'includes/admin-footer.php'; ?>
