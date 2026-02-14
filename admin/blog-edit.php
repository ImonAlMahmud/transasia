<?php
require_once '../includes/auth.php';
require_once '../includes/db.php';
require_login();

$blog_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$blog = [
    'title' => '',
    'slug' => '',
    'keywords' => '',
    'content' => '',
    'excerpt' => '',
    'image_url' => '',
    'status' => 'Draft',
    'created_at' => date('Y-m-d H:i:s')
];

if ($blog_id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM blogs WHERE id = ?");
    $stmt->execute([$blog_id]);
    $blog = $stmt->fetch();
    if (!$blog) {
        header("Location: blogs.php");
        exit();
    }
}

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $slug = $_POST['slug'] ?: strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
    $keywords = $_POST['keywords'];
    $content = $_POST['content'];
    $excerpt = $_POST['excerpt'] ?: substr(strip_tags($content), 0, 160);
    $status = $_POST['status'];
    $created_at = $_POST['created_at'];
    $image_url = $blog['image_url'];

    // Handle Image Upload
    if (isset($_FILES['blog_image']) && $_FILES['blog_image']['error'] === 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        $filename = $_FILES['blog_image']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if (in_array($ext, $allowed)) {
            $new_name = 'blog_' . time() . '.' . $ext;
            $upload_path = '../images/' . $new_name;
            
            if (move_uploaded_file($_FILES['blog_image']['tmp_name'], $upload_path)) {
                // Delete old image if exists
                if ($image_url && file_exists('../' . $image_url)) {
                    unlink('../' . $image_url);
                }
                $image_url = 'images/' . $new_name;
            }
        }
    }

    if ($blog_id > 0) {
        $stmt = $pdo->prepare("UPDATE blogs SET title = ?, slug = ?, keywords = ?, content = ?, excerpt = ?, image_url = ?, status = ?, created_at = ? WHERE id = ?");
        $stmt->execute([$title, $slug, $keywords, $content, $excerpt, $image_url, $status, $created_at, $blog_id]);
        log_activity('Blog Updated', "Updated blog ID: $blog_id");
    } else {
        $stmt = $pdo->prepare("INSERT INTO blogs (title, slug, keywords, content, excerpt, image_url, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $slug, $keywords, $content, $excerpt, $image_url, $status, $created_at]);
        log_activity('Blog Created', "Created blog: $title");
    }
    
    header("Location: blogs.php?msg=saved");
    exit();
}

$active_admin_page = 'blogs';
$page_title = ($blog_id > 0) ? 'Edit Blog Post' : 'Create New Blog Post';
include 'includes/admin-header.php';
?>

<div class="content-card">
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-grid" style="display: grid; grid-template-columns: 2fr 1fr; gap: 32px;">
            <!-- Left Column: Content -->
            <div class="form-left">
                <div class="form-group" style="margin-bottom: 24px;">
                    <label style="display: block; font-weight: 500; margin-bottom: 8px;">Blog Title *</label>
                    <input type="text" name="title" value="<?php echo htmlspecialchars($blog['title']); ?>" required style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 6px; font-size: 16px;" placeholder="Enter blog title">
                </div>
                
                <div class="form-group" style="margin-bottom: 24px;">
                    <label style="display: block; font-weight: 500; margin-bottom: 8px;">Slug (SEO Friendly URL)</label>
                    <input type="text" name="slug" value="<?php echo htmlspecialchars($blog['slug']); ?>" style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 6px; color: #666;" placeholder="Auto-generated from title if left blank">
                </div>

                <div class="form-group" style="margin-bottom: 24px;">
                    <label style="display: block; font-weight: 500; margin-bottom: 8px;">Blog Content *</label>
                    <textarea name="content" required style="width: 100%; height: 400px; padding: 12px; border: 1px solid var(--border-color); border-radius: 6px; font-family: inherit; line-height: 1.6;"><?php echo htmlspecialchars($blog['content']); ?></textarea>
                </div>

                <div class="form-group">
                    <label style="display: block; font-weight: 500; margin-bottom: 8px;">Excerpt (Brief Summary for Listing)</label>
                    <textarea name="excerpt" style="width: 100%; height: 100px; padding: 12px; border: 1px solid var(--border-color); border-radius: 6px; font-family: inherit;"><?php echo htmlspecialchars($blog['excerpt']); ?></textarea>
                </div>
            </div>

            <!-- Right Column: Settings & SEO -->
            <div class="form-right">
                <div class="form-card" style="background: #f9fafb; padding: 24px; border-radius: 12px; border: 1px solid var(--border-color); margin-bottom: 24px;">
                    <h3 style="margin-top: 0; font-size: 16px; margin-bottom: 16px;">Publishing Options</h3>
                    
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: 500; margin-bottom: 8px;">Status</label>
                        <select name="status" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 6px;">
                            <option value="Draft" <?php echo ($blog['status'] == 'Draft') ? 'selected' : ''; ?>>Draft</option>
                            <option value="Published" <?php echo ($blog['status'] == 'Published') ? 'selected' : ''; ?>>Published</option>
                        </select>
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: 500; margin-bottom: 8px;">Published Date</label>
                        <input type="datetime-local" name="created_at" value="<?php echo date('Y-m-d\TH:i', strtotime($blog['created_at'])); ?>" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 6px;">
                    </div>

                    <div class="form-group">
                        <label style="display: block; font-weight: 500; margin-bottom: 8px;">Featured Image</label>
                        <?php if ($blog['image_url']): ?>
                            <img src="../<?php echo $blog['image_url']; ?>" style="width: 100%; border-radius: 8px; margin-bottom: 12px; border: 1px solid #ddd;">
                        <?php endif; ?>
                        <input type="file" name="blog_image" style="width: 100%;">
                        <p style="font-size: 12px; color: #666; margin-top: 8px;">Recommended size: 1200x800px. Formats: JPG, PNG, WEBP.</p>
                    </div>
                </div>

                <div class="form-card" style="background: #f9fafb; padding: 24px; border-radius: 12px; border: 1px solid var(--border-color);">
                    <h3 style="margin-top: 0; font-size: 16px; margin-bottom: 16px;">SEO Metadata</h3>
                    
                    <div class="form-group">
                        <label style="display: block; font-weight: 500; margin-bottom: 8px;">Keywords (Comma separated)</label>
                        <textarea name="keywords" style="width: 100%; height: 100px; padding: 12px; border: 1px solid var(--border-color); border-radius: 6px; font-family: inherit; font-size: 14px;" placeholder="recruitment, manpower, construction, overseas..."><?php echo htmlspecialchars($blog['keywords']); ?></textarea>
                    </div>
                </div>

                <div style="margin-top: 32px; display: flex; flex-direction: column; gap: 12px;">
                    <button type="submit" class="btn btn-primary" style="width: 100%; padding: 14px; background: var(--admin-primary); border: none; border-radius: 8px; color: white; font-weight: 600; cursor: pointer;">Save Article</button>
                    <a href="blogs.php" style="text-align: center; color: var(--text-muted); text-decoration: none; font-size: 14px;">Cancel & Return</a>
                </div>
            </div>
        </div>
    </form>
</div>

<?php include 'includes/admin-footer.php'; ?>
