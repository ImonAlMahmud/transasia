<?php
$page_title = 'Edit Page Content';
$active_admin_page = 'pages';
require_once 'includes/admin-header.php';

$filename = $_GET['file'] ?? '';
$success_msg = '';
$error_msg = '';

// Security Check
// Security Check: Allow alphanumeric, underscores, hyphens, and slashes. Prevent directory traversal via regex and explicit check.
if (!$filename || !preg_match('/^[a-zA-Z0-9_\-\/]+\.php$/', $filename) || strpos($filename, '..') !== false) {
    header('Location: pages.php');
    exit;
}

$file_path = '../' . $filename;

if (!file_exists($file_path)) {
    die("File not found.");
}

// Handle Save
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content'])) {
    $content = $_POST['content'];
    
    if (file_put_contents($file_path, $content) !== false) {
        log_activity("Edit Content", "Updated content of $filename");
        $success_msg = "Page content updated successfully!";
    } else {
        $error_msg = "Error: Could not write to file. Check permissions.";
    }
}

// Read Content
$content = file_get_contents($file_path);
?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
    <div>
        <h2 style="margin: 0;">Editing: <span style="color: var(--admin-primary);"><?php echo htmlspecialchars($filename); ?></span></h2>
        <p style="color: var(--text-muted); font-size: 14px; margin-top: 5px;">Modify the source code below. Be careful with PHP tags!</p>
    </div>
    <a href="pages.php" class="btn btn-outline-dark"><i class="fas fa-arrow-left"></i> Back to Pages</a>
</div>

<?php if ($success_msg): ?>
    <div style="background: #dcfce7; color: #166534; padding: 16px; border-radius: 8px; margin-bottom: 25px; border: 1px solid #bbf7d0;">
        <i class="fas fa-check-circle"></i> <?php echo $success_msg; ?>
    </div>
<?php endif; ?>

<?php if ($error_msg): ?>
    <div style="background: #fee2e2; color: #991b1b; padding: 16px; border-radius: 8px; margin-bottom: 25px; border: 1px solid #fecaca;">
        <i class="fas fa-exclamation-circle"></i> <?php echo $error_msg; ?>
    </div>
<?php endif; ?>

<div class="content-card" style="padding: 0; overflow: hidden; border-radius: 12px;">
    <form action="edit-page.php?file=<?php echo urlencode($filename); ?>" method="POST">
        <textarea name="content" id="editor" style="width: 100%; height: 600px; padding: 25px; font-family: 'Consolas', 'Monaco', monospace; border: none; resize: vertical; font-size: 14px; line-height: 1.6; background: #1e293b; color: #f8fafc; outline: none;"><?php echo htmlspecialchars($content); ?></textarea>
        
        <div style="padding: 20px 30px; background: #f8fafc; border-top: 1px solid #e2e8f0; display: flex; justify-content: flex-end; gap: 15px;">
            <button type="submit" class="btn btn-primary" style="padding: 12px 30px; font-weight: 600; background: var(--admin-primary);">
                <i class="fas fa-save" style="margin-right: 8px;"></i> Save Changes
            </button>
        </div>
    </form>
</div>

<div style="margin-top: 20px; padding: 15px; background: #fffbeb; border: 1px solid #fef3c7; border-radius: 8px; color: #92400e; font-size: 13px;">
    <i class="fas fa-lightbulb"></i> <strong>Tip:</strong> After saving, you can refresh the live page to see your changes immediately.
</div>

<?php include 'includes/admin-footer.php'; ?>
