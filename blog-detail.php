<?php 
require_once 'includes/init.php'; 

$slug = $_GET['slug'] ?? '';
if (!$slug) {
    header("Location: blogs.php");
    exit();
}

// Fetch Blog
$stmt = $pdo->prepare("SELECT * FROM blogs WHERE slug = ? AND status = 'Published'");
$stmt->execute([$slug]);
$blog = $stmt->fetch();

if (!$blog) {
    header("Location: blogs.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php 
    $page_title = $blog['title'] . " | " . $site_name;
    $meta_desc = $blog['excerpt'];
    // Assuming 'image' field exists or mapping 'image_url' to 'image' for meta-tags.php
    // If meta-tags.php expects a full URL, adjust $page_image accordingly.
    // For now, using the base path as per the instruction's example.
    // If $blog['image'] is not available, consider using $blog['image_url'] directly.
    $page_image = "uploads/blogs/" . ($blog['image'] ?? basename($blog['image_url'])); // Adjusted to use image_url if 'image' field is not present
    $page_keywords = $blog['keywords']; // Added for completeness if meta-tags.php uses it
    $og_type = 'article'; // Specific for blog posts
    include 'includes/meta-tags.php'; 
  ?>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <!-- Styles -->
  <link rel="stylesheet" href="css/styles.css">
  
  <style>
    .blog-content {
        line-height: 1.8;
        font-size: 18px;
        color: #2c3e50;
        font-family: 'Open Sans', sans-serif;
    }
    .blog-content p {
        margin-bottom: 28px;
    }
    .blog-content h2 {
        font-size: 28px;
        margin-top: 48px;
        margin-bottom: 24px;
        color: var(--primary-blue);
        font-weight: 700;
        border-bottom: 2px solid #eee;
        padding-bottom: 12px;
    }
    .blog-content h3 {
        font-size: 22px;
        margin-top: 40px;
        margin-bottom: 16px;
        color: var(--secondary-blue);
        font-weight: 600;
    }
    .blog-content ul, .blog-content ol {
        margin-bottom: 28px;
        padding-left: 20px;
    }
    .blog-content li {
        margin-bottom: 12px;
    }
    .blog-content strong {
        color: #000;
        font-weight: 700;
    }
    .blog-nav {
        display: flex;
        justify-content: space-between;
        padding-top: 40px;
        margin-top: 60px;
        border-top: 1px solid #eee;
    }
    .sidebar-widget {
        background: #f8f9fa;
        padding: 32px;
        border-radius: 16px;
        margin-bottom: 30px;
        border: 1px solid #e9ecef;
    }
    .sidebar-widget h4 {
        font-size: 18px;
        margin-bottom: 20px;
        font-weight: 700;
        color: var(--primary-blue);
    }
    /* CTA Widget Specifics */
    .sidebar-widget.cta-widget {
        background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
        color: #ffffff;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 56, 118, 0.2);
    }
    .sidebar-widget.cta-widget h4 {
        color: #ffffff;
        border-bottom: 1px solid rgba(255,255,255,0.2);
        padding-bottom: 16px;
    }
    .sidebar-widget.cta-widget p {
        color: rgba(255,255,255,0.9);
        font-size: 15px;
        line-height: 1.6;
    }
  </style>
</head>

<body>
  <?php 
    $active_page = 'blogs'; 
    include 'includes/header.php'; 
  ?>

  <main>
    <!-- Page Header -->
    <section class="page-header" style="padding: 120px 0 80px;">
      <div class="page-header-bg" style="background-image: url('<?php echo $blog['image_url'] ?: get_setting('blogs_header_bg', 'images/blog-header.jpg'); ?>'); transform: scale(1.1);"></div>
      <div class="page-header-overlay" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.8));"></div>
      <div class="container">
        <div class="blog-header-content text-center" data-aos="fade-up">
          <div class="blog-meta-top" style="color: rgba(255,255,255,0.9); margin-bottom: 24px; font-weight: 500; letter-spacing: 1px; text-transform: uppercase; font-size: 13px;">
            <i class="far fa-calendar-alt" style="margin-right: 8px;"></i> <?php echo date('M d, Y', strtotime($blog['created_at'])); ?>
          </div>
          <h1 style="font-size: 42px; line-height: 1.2; margin-bottom: 0;"><?php echo htmlspecialchars($blog['title']); ?></h1>
          <nav class="breadcrumb" aria-label="Breadcrumb" style="justify-content: center; margin-top: 32px; opacity: 0.8;">
            <a href="index.php">Home</a>
            <i class="fas fa-chevron-right"></i>
            <a href="blogs.php">Blogs</a>
            <i class="fas fa-chevron-right"></i>
            <span>Detail</span>
          </nav>
        </div>
      </div>
    </section>

    <!-- Blog Content Area -->
    <section style="padding: 100px 0;">
      <div class="container">
        <div class="two-column" style="grid-template-columns: 2fr 1fr; align-items: flex-start; gap: 80px;">
          
          <div class="main-content" data-aos="fade-right">
            <?php if ($blog['image_url']): ?>
              <img src="<?php echo $blog['image_url']; ?>" alt="<?php echo htmlspecialchars($blog['title']); ?>" style="width: 100%; border-radius: 20px; margin-bottom: 50px; box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
            <?php endif; ?>
            
            <div class="blog-content">
              <?php echo nl2br($blog['content']); ?>
            </div>

            <div class="blog-nav">
              <a href="blogs.php" class="btn btn-outline-dark"><i class="fas fa-chevron-left" style="margin-right: 8px;"></i> Back to All Articles</a>
              <div class="share-buttons">
                <span style="font-weight: 700; margin-right: 16px; color: var(--primary-blue);">Share Article:</span>
                <a href="#" style="color: #3b5998; margin: 0 10px; font-size: 18px;"><i class="fab fa-facebook-f"></i></a>
                <a href="#" style="color: #0077b5; margin: 0 10px; font-size: 18px;"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" style="color: #1da1f2; margin: 0 10px; font-size: 18px;"><i class="fab fa-twitter"></i></a>
              </div>
            </div>
          </div>

          <aside class="blog-sidebar" data-aos="fade-left">
            <div class="sidebar-widget">
              <h4>Recent Posts</h4>
              <ul style="list-style: none; padding: 0; margin-top: 24px;">
                <?php
                $stmt = $pdo->prepare("SELECT title, slug, created_at FROM blogs WHERE status = 'Published' AND id != ? ORDER BY created_at DESC LIMIT 5");
                $stmt->execute([$blog['id']]);
                while ($recent = $stmt->fetch()):
                ?>
                  <li style="margin-bottom: 24px; padding-bottom: 24px; border-bottom: 1px solid #f1f1f1; last-child: border-bottom: none;">
                    <a href="blog-detail.php?slug=<?php echo $recent['slug']; ?>" style="text-decoration: none; color: #2c3e50; display: block; transition: color 0.3s;">
                      <div style="font-size: 12px; color: var(--text-muted); margin-bottom: 6px; font-weight: 600; text-transform: uppercase;"><?php echo date('M d, Y', strtotime($recent['created_at'])); ?></div>
                      <div style="font-weight: 600; line-height: 1.4; font-size: 16px;"><?php echo htmlspecialchars($recent['title']); ?></div>
                    </a>
                  </li>
                <?php endwhile; ?>
              </ul>
            </div>

            <div class="sidebar-widget cta-widget">
              <h4>Need Recruitment Help?</h4>
              <p>TransAsia specializes in sourcing top-tier talent for the construction, engineering, and medical industries.</p>
              <a href="contact.php" class="btn btn-white" style="margin-top: 24px; width: 100%; justify-content: center; font-weight: 600;">Partner With Us</a>
            </div>
          </aside>

        </div>
      </div>
    </section>
  </main>

  <?php include 'includes/footer.php'; ?>
</body>
</html>
