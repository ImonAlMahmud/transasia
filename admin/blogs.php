<?php
require_once '../includes/auth.php';
require_once '../includes/db.php';
require_login();

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $pdo->prepare("SELECT image_url FROM blogs WHERE id = ?");
    $stmt->execute([$id]);
    $image = $stmt->fetchColumn();
    
    if ($image && file_exists('../' . $image)) {
        unlink('../' . $image);
    }
    
    $stmt = $pdo->prepare("DELETE FROM blogs WHERE id = ?");
    $stmt->execute([$id]);
    log_activity('Blog Deleted', "Deleted blog ID: $id");
    header("Location: blogs.php?msg=deleted");
    exit();
}

$active_admin_page = 'blogs';
$page_title = 'Manage Blogs';
include 'includes/admin-header.php';

// Pagination setup
$blogs_per_page = 10;
$current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($current_page - 1) * $blogs_per_page;

// Get total count
$count_stmt = $pdo->query("SELECT COUNT(*) FROM blogs");
$total_blogs = $count_stmt->fetchColumn();
$total_pages = ceil($total_blogs / $blogs_per_page);

// Fetch paginated blogs
$stmt = $pdo->prepare("SELECT * FROM blogs ORDER BY created_at DESC LIMIT ? OFFSET ?");
$stmt->execute([$blogs_per_page, $offset]);
$blogs = $stmt->fetchAll();
?>

<div class="card-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
    <h2>Article List</h2>
    <a href="blog-edit.php" class="btn btn-primary" style="background: var(--admin-primary); padding: 10px 20px; border-radius: 6px; text-decoration: none; color: white; display: flex; align-items: center; gap: 8px;">
        <i class="fas fa-plus"></i> Create New Blog
    </a>
</div>

<?php if (isset($_GET['msg'])): ?>
    <div style="padding: 12px 20px; background: #dcfce7; color: #166534; border-radius: 8px; margin-bottom: 24px;">
        <?php 
        if ($_GET['msg'] == 'deleted') echo "Blog deleted successfully.";
        if ($_GET['msg'] == 'saved') echo "Blog saved successfully.";
        ?>
    </div>
<?php endif; ?>

<div class="content-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($blogs)): ?>
            <tr>
                <td colspan="4" style="text-align: center; padding: 40px; color: var(--text-muted);">No blogs found. Start by creating one!</td>
            </tr>
            <?php endif; ?>
            <?php foreach ($blogs as $blog): ?>
            <tr>
                <td>
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <?php if ($blog['image_url']): ?>
                            <img src="../<?php echo htmlspecialchars($blog['image_url']); ?>" style="width: 50px; height: 35px; object-fit: cover; border-radius: 4px;">
                        <?php else: ?>
                            <div style="width: 50px; height: 35px; background: #eee; border-radius: 4px; display: flex; align-items: center; justify-content: center; font-size: 10px; color: #999;">No Image</div>
                        <?php endif; ?>
                        <div>
                            <div style="font-weight: 500;"><?php echo htmlspecialchars($blog['title']); ?></div>
                            <div style="font-size: 12px; color: var(--text-muted);">/<?php echo htmlspecialchars($blog['slug']); ?></div>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="badge <?php echo ($blog['status'] == 'Published') ? 'badge-success' : 'badge-pending'; ?>">
                        <?php echo $blog['status']; ?>
                    </span>
                </td>
                <td><?php echo date('M d, Y', strtotime($blog['created_at'])); ?></td>
                <td>
                    <a href="blog-edit.php?id=<?php echo $blog['id']; ?>" class="btn-action" title="Edit" style="color: var(--admin-primary);"><i class="fas fa-edit"></i></a>
                    <a href="?delete=<?php echo $blog['id']; ?>" class="btn-action" title="Delete" style="color: #ef4444;" onclick="return confirm('Are you sure you want to delete this blog?')"><i class="fas fa-trash"></i></a>
                    <a href="../blog-detail.php?slug=<?php echo $blog['slug']; ?>" target="_blank" class="btn-action" title="View"><i class="fas fa-external-link-alt"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <!-- Pagination -->
    <?php if ($total_pages > 1): ?>
    <div style="display: flex; justify-content: center; align-items: center; gap: 10px; margin-top: 30px; padding: 20px;">
        <?php if ($current_page > 1): ?>
            <a href="?page=<?php echo $current_page - 1; ?>" class="btn btn-outline-sm" style="padding: 8px 16px;">
                <i class="fas fa-chevron-left"></i> Previous
            </a>
        <?php endif; ?>
        
        <span style="padding: 8px 16px; color: var(--text-muted); font-size: 14px;">
            Page <?php echo $current_page; ?> of <?php echo $total_pages; ?> (<?php echo $total_blogs; ?> total articles)
        </span>
        
        <?php if ($current_page < $total_pages): ?>
            <a href="?page=<?php echo $current_page + 1; ?>" class="btn btn-outline-sm" style="padding: 8px 16px;">
                Next <i class="fas fa-chevron-right"></i>
            </a>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>

<?php include 'includes/admin-footer.php'; ?>
