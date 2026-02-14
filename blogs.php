<?php require_once 'includes/init.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php 
    $page_title = "Industry Insights & News | " . $site_name;
    $meta_desc = "Stay updated with the latest trends in international recruitment, labor market insights, and industry news from TransAsia Integrate Service Ltd.";
    include 'includes/meta-tags.php'; 
  ?>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <!-- Styles -->
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>
  <?php 
    $active_page = 'blogs'; 
    include 'includes/header.php'; 

    // Fetch Published Blogs
    $stmt = $pdo->query("SELECT * FROM blogs WHERE status = 'Published' ORDER BY created_at DESC");
    $blogs = $stmt->fetchAll();
  ?>

  <main>
    <!-- Page Header -->
    <section class="page-header" aria-label="Page header">
      <div class="page-header-bg" style="background-image: url('<?php echo get_setting('blogs_header_bg', 'images/blog-header.jpg'); ?>');"></div>
      <div class="page-header-overlay"></div>
      <div class="container">
        <h1 data-aos="fade-up">Industry Updates</h1>
        <nav class="breadcrumb" aria-label="Breadcrumb" data-aos="fade-up" data-aos-delay="100">
          <a href="index.php">Home</a>
          <i class="fas fa-chevron-right"></i>
          <span>Blogs</span>
        </nav>
      </div>
    </section>

    <!-- Blog Grid -->
    <section class="blogs-section" style="padding: 80px 0;">
      <div class="container">
        <?php if (empty($blogs)): ?>
          <div class="text-center" data-aos="fade-up">
            <i class="fas fa-newspaper" style="font-size: 64px; color: #ddd; margin-bottom: 24px; display: block;"></i>
            <h3>No Articles Found</h3>
            <p>We are currently updating our insights. Please check back soon!</p>
            <a href="index.php" class="btn btn-primary mt-4">Back to Home</a>
          </div>
        <?php else: ?>
          <div class="blog-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 30px;">
            <?php foreach ($blogs as $blog): ?>
              <article class="blog-card" data-aos="fade-up">
                <div class="blog-card-image" style="height: 240px; overflow: hidden; position: relative;">
                  <img src="<?php echo $blog['image_url'] ?: 'images/blog-placeholder.jpg'; ?>" alt="<?php echo htmlspecialchars($blog['title']); ?>" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;" loading="lazy">
                </div>
                <div class="blog-card-content" style="padding: 30px; background: white;">
                  <div class="blog-meta" style="font-size: 13px; color: var(--text-muted); margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                    <i class="far fa-calendar-alt"></i> <?php echo date('M d, Y', strtotime($blog['created_at'])); ?>
                  </div>
                  <h3 style="font-size: 20px; line-height: 1.4; margin-bottom: 15px;"><?php echo htmlspecialchars($blog['title']); ?></h3>
                  <p style="color: var(--text-muted); font-size: 15px; margin-bottom: 20px;"><?php echo htmlspecialchars($blog['excerpt']); ?></p>
                  <a href="blog-detail.php?slug=<?php echo $blog['slug']; ?>" class="read-more" style="font-weight: 600; color: var(--primary-blue); text-decoration: none; display: flex; align-items: center; gap: 8px;">
                    Read More <i class="fas fa-arrow-right"></i>
                  </a>
                </div>
              </article>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </section>
  </main>

  <?php include 'includes/footer.php'; ?>
</body>
</html>
