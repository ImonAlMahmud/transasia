<?php
$page_title = 'Site Pages';
$active_admin_page = 'pages';
require_once 'includes/admin-header.php';

$success_msg = '';
$error_msg = '';

// Handle Page Actions (Rename/Delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $filename = $_POST['filename'] ?? '';
    
    // Security check: ensure the file is in the root directory and is a .php file
    $filename = $_POST['filename'] ?? ''; // Used for delete/rename

    // Handle 'create' action separately as it doesn't require an existing file
    if ($action === 'create') {
        $new_filename = $_POST['new_filename'] ?? '';
        // Sanitize and ensure .php extension
        if (!str_ends_with($new_filename, '.php')) $new_filename .= '.php';
        
        if (preg_match('/^[a-zA-Z0-9_\-]+\.php$/', $new_filename)) {
            if (!file_exists('../' . $new_filename)) {
                // Page Template
                $template = "<?php require_once 'includes/init.php'; ?>\n";
                $template .= "<!DOCTYPE html>\n<html lang=\"en\">\n<head>\n";
                $template .= "    <meta charset=\"UTF-8\">\n";
                $template .= "    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
                $template .= "    <title>New Page | <?php echo \$site_name; ?></title>\n";
                $template .= "    <link rel=\"stylesheet\" href=\"css/styles.css\">\n";
                $template .= "</head>\n<body>\n";
                $template .= "    <?php \n";
                $template .= "        \$active_page = ''; \n";
                $template .= "        include 'includes/header.php'; \n";
                $template .= "    ?>\n\n";
                $template .= "    <main>\n";
                $template .= "        <section class=\"page-header\">\n";
                $template .= "            <div class=\"container\">\n";
                $template .= "                <h1>New Page</h1>\n";
                $template .= "            </div>\n";
                $template .= "        </section>\n\n";
                $template .= "        <section class=\"container\" style=\"padding: 80px 0;\">\n";
                $template .= "            <h2>Welcome to your new page</h2>\n";
                $template .= "            <p>Start adding your content here...</p>\n";
                $template .= "        </section>\n";
                $template .= "    </main>\n\n";
                $template .= "    <?php include 'includes/footer.php'; ?>\n";
                $template .= "</body>\n</html>";
                
                if (file_put_contents('../' . $new_filename, $template)) {
                    log_activity("Create Page", "Created new page: $new_filename");
                    $success_msg = "Page '$new_filename' created successfully!";
                } else {
                    $error_msg = "Could not create page file.";
                }
            } else {
                $error_msg = "A page with that name already exists.";
            }
        } else {
            $error_msg = "Invalid filename. Use only letters, numbers, and underscores.";
        }
    }
    // Security check for delete/rename: ensure the file is in the root directory and is a .php file
    elseif ($filename && preg_match('/^[a-zA-Z0-9_\-]+\.php$/', $filename) && file_exists('../' . $filename)) {
        if ($action === 'delete') {
            if (unlink('../' . $filename)) {
                log_activity("Delete Page", "Deleted page: $filename");
                $success_msg = "Page '$filename' deleted successfully.";
            } else {
                $error_msg = "Could not delete page.";
            }
        } elseif ($action === 'rename') {
            $new_name = $_POST['new_name'] ?? '';
            if (preg_match('/^[a-zA-Z0-9_\-]+\.php$/', $new_name)) {
                if (rename('../' . $filename, '../' . $new_name)) {
                    log_activity("Rename Page", "Renamed $filename to $new_name");
                    $success_msg = "Page renamed to '$new_name'.";
                } else {
                    $error_msg = "Could not rename page.";
                }
            } else {
                $error_msg = "Invalid new filename. Use only letters, numbers, underscores, and .php extension.";
            }
        }
    }
}

// Scan root directory for .php files
$root_dir = '../';
$files = scandir($root_dir);
$site_pages = [];

foreach ($files as $file) {
    if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
        // Skip hidden files, system files, and admin directory content
        $exclude = ['login.php', 'logout.php', 'db.php', 'auth.php', 'functions.php'];
        if (in_array($file, $exclude)) continue;
        
        $filePath = $root_dir . $file;
        $site_pages[] = [
            'name' => ucwords(str_replace(['_', '-'], ' ', pathinfo($file, PATHINFO_FILENAME))),
            'file' => $file,
            'status' => 'Published',
            'last_mod' => date("M d, Y H:i", filemtime($filePath))
        ];
    }
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

<div class="content-card">
    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h2>Website Pages</h2>
        <button class="btn btn-primary btn-sm" onclick="createPage()"><i class="fas fa-plus"></i> Create New Page</button>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Page Display Name</th>
                <th>File Name</th>
                <th>Status</th>
                <th>Last Modified</th>
                <th style="text-align: right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($site_pages as $page): ?>
            <tr>
                <td style="font-weight: 600;"><?php echo $page['name']; ?></td>
                <td style="font-family: monospace; color: var(--text-muted);">/<?php echo $page['file']; ?></td>
                <td><span class="badge badge-success"><?php echo $page['status']; ?></span></td>
                <td style="font-size: 13px; color: var(--text-muted);"><?php echo $page['last_mod']; ?></td>
                <td style="text-align: right;">
                    <a href="../<?php echo $page['file']; ?>" target="_blank" class="btn-action" title="View"><i class="fas fa-external-link-alt"></i></a>
                    
                    <a href="edit-page.php?file=<?php echo urlencode($page['file']); ?>" class="btn-action" title="Edit Content"><i class="fas fa-edit"></i></a>
                    
                    <button class="btn-action" title="Rename" onclick="renamePage('<?php echo $page['file']; ?>')"><i class="fas fa-file-signature" style="font-size: 14px;"></i></button>
                    
                    <?php if ($page['file'] !== 'index.php'): ?>
                    <form action="pages.php" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this file? This cannot be undone.');">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="filename" value="<?php echo $page['file']; ?>">
                        <button type="submit" class="btn-action" title="Delete" style="color: #ef4444;"><i class="fas fa-trash"></i></button>
                    </form>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
function createPage() {
    const filename = prompt("Enter new filename (e.g. news.php):");
    if (filename) {
        let cleanName = filename.toLowerCase().replace(/[^a-z0-9_\-\.]/g, '');
        if (!cleanName.endsWith('.php')) cleanName += '.php';
        
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'pages.php';
        
        const actionInput = document.createElement('input');
        actionInput.type = 'hidden';
        actionInput.name = 'action';
        actionInput.value = 'create';
        
        const fileInput = document.createElement('input');
        fileInput.type = 'hidden';
        fileInput.name = 'new_filename';
        fileInput.value = cleanName;
        
        form.appendChild(actionInput);
        form.appendChild(fileInput);
        document.body.appendChild(form);
        form.submit();
    }
}

function renamePage(oldName) {
    const newName = prompt("Enter new filename (e.g. services-new.php):", oldName);
    if (newName && newName !== oldName) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'pages.php';
        
        const actionInput = document.createElement('input');
        actionInput.type = 'hidden';
        actionInput.name = 'action';
        actionInput.value = 'rename';
        
        const oldInput = document.createElement('input');
        oldInput.type = 'hidden';
        oldInput.name = 'filename';
        oldInput.value = oldName;
        
        const newInput = document.createElement('input');
        newInput.type = 'hidden';
        newInput.name = 'new_name';
        newInput.value = newName;
        
        form.appendChild(actionInput);
        form.appendChild(oldInput);
        form.appendChild(newInput);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>

<div style="margin-top: 30px; display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
    <div class="content-card" style="padding: 24px;">
        <h3>Site Architecture</h3>
        <p style="color: var(--text-muted); font-size: 14px; margin: 15px 0;">Your website uses a modular PHP architecture. Shared components like the header and footer are located in the <code>/includes</code> directory.</p>
        <div style="display: flex; gap: 10px;">
            <a href="edit-page.php?file=includes/header.php" class="btn btn-outline-sm">Manage Header</a>
            <a href="edit-page.php?file=includes/footer.php" class="btn btn-outline-sm">Manage Footer</a>
        </div>
    </div>
    <div class="content-card" style="padding: 24px;">
        <h3>Media Library</h3>
        <p style="color: var(--text-muted); font-size: 14px; margin: 15px 0;">All images and assets are managed in the <code>/images</code> folder. Ensure all images are optimized for fast loading.</p>
        <a href="media.php" class="btn btn-outline-sm">Open Media Manager</a>
    </div>
</div>

<?php include 'includes/admin-footer.php'; ?>
