<?php require_once 'includes/init.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php 
    $page_title = "Engineering & Technical Recruitment | " . $site_name;
    $meta_desc = "Connecting global projects with Bangladesh's expert engineers and technical professionals. Specialized solutions for complex technical needs.";
    include 'includes/meta-tags.php'; 
  ?>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Open+Sans:wght@400;500;600&display=swap"
    rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <!-- Styles -->
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>
  <?php 
    $active_page = 'industries'; 
    include 'includes/header.php'; 
  ?>

  <main>
    <!-- Page Header -->
    <section class="page-header" aria-label="Page header">
      <div class="page-header-bg" style="background-image: url('images/sector-engineering-new.jpg');"></div>
      <div class="page-header-overlay"></div>
      <div class="container">
        <h1 data-aos="fade-up">Engineering & Fabrication</h1>
        <nav class="breadcrumb" aria-label="Breadcrumb" data-aos="fade-up" data-aos-delay="100">
          <a href="index.php">Home</a>
          <i class="fas fa-chevron-right"></i>
          <a href="industries.php">Industries</a>
          <i class="fas fa-chevron-right"></i>
          <span>Engineering</span>
        </nav>
      </div>
    </section>

    <!-- Sector Detail -->
    <section class="sector-detail-section">
      <div class="container">
        <div class="two-column">
          <div class="column-image" data-aos="fade-right">
            <img src="images/sector-engineering-new.jpg" alt="Engineering and Fabrication" class="img-fluid rounded shadow">
          </div>
          <div class="column-content" data-aos="fade-left">
            <div class="sector-badge">Precision Engineering</div>
            <h2>Technical Mastery in Fabrication & Design</h2>
            <p>Our Engineering & Fabrication sector recruitment focuses on sourcing high-caliber professionals who bring technical precision and innovation to industrial projects. We support diverse fields including automotive, aerospace, structural, and mechanical engineering.</p>
            <p>We specialized in identifying candidates with advanced technical certifications and hands-on experience in complex metalworks and precision assembly.</p>
            
            <div class="expertise-list mt-4">
              <div class="expertise-item">
                <i class="fas fa-check-circle"></i>
                <div>
                  <h4>Structural Steel Fabrication</h4>
                  <p>Skilled fabricators and fitters specialized in heavy structural steel for buildings, bridges, and industrial complexes.</p>
                </div>
              </div>
              <div class="expertise-item">
                <i class="fas fa-check-circle"></i>
                <div>
                  <h4>Certified Welding Services</h4>
                  <p>Certified 6G, TIG, and MIG welders capable of working in challenging industrial environments with precision.</p>
                </div>
              </div>
              <div class="expertise-item">
                <i class="fas fa-check-circle"></i>
                <div>
                  <h4>Industrial Mechanical Engineering</h4>
                  <p>Experienced mechanical engineers specialized in manufacturing systems, automation, and industrial design.</p>
                </div>
              </div>
              <div class="expertise-item">
                <i class="fas fa-check-circle"></i>
                <div>
                  <h4>CNC & Precision Machining</h4>
                  <p>Expert CNC operators and technicians skilled in computer-aided manufacturing and precision tool design.</p>
                </div>
              </div>
            </div>

            <div class="cta-box mt-5 p-4 bg-light rounded border-start border-primary border-4">
              <h4>Scale Your Engineering Capacity?</h4>
              <p>Connect with our technical recruitment team to find your next specialist.</p>
              <a href="contact.php" class="btn btn-primary">Partner with Us</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Detailed Roles -->
    <section class="roles-overhaul-section">
        <div class="container">
            <div class="section-header text-center" data-aos="fade-up">
                <span class="sub-title">Technical Expertise</span>
                <h2>Roles We Recruit</h2>
                <p>Key technical positions we regularly fill in the engineering sector</p>
            </div>
            
            <div class="roles-grid">
                <!-- Category 1 -->
                <div class="role-premium-card" data-aos="fade-up" data-aos-delay="0">
                    <div class="card-accent"></div>
                    <div class="card-header-icon">
                        <div class="icon-circle">
                            <i class="fas fa-gears"></i>
                        </div>
                        <h3>Engineering Roles</h3>
                    </div>
                    <ul class="role-list">
                        <li><i class="fas fa-check"></i> Mechanical Engineers</li>
                        <li><i class="fas fa-check"></i> Structural Engineers</li>
                        <li><i class="fas fa-check"></i> Civil Engineers</li>
                        <li><i class="fas fa-check"></i> Production Engineers</li>
                        <li><i class="fas fa-check"></i> Design Engineers (SolidWorks)</li>
                    </ul>
                </div>

                <!-- Category 2 -->
                <div class="role-premium-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-accent"></div>
                    <div class="card-header-icon">
                        <div class="icon-circle">
                            <i class="fas fa-hammer"></i>
                        </div>
                        <h3>Fabrication Roles</h3>
                    </div>
                    <ul class="role-list">
                        <li><i class="fas fa-check"></i> Structural Steel Fabricators</li>
                        <li><i class="fas fa-check"></i> Sheet Metal Workers</li>
                        <li><i class="fas fa-check"></i> CNC Machine Operators</li>
                        <li><i class="fas fa-check"></i> Metal Finishers & Grinders</li>
                        <li><i class="fas fa-check"></i> Tool & Die Makers</li>
                    </ul>
                </div>

                <!-- Category 3 -->
                <div class="role-premium-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-accent"></div>
                    <div class="card-header-icon">
                        <div class="icon-circle">
                            <i class="fas fa-fire"></i>
                        </div>
                        <h3>Welding Roles</h3>
                    </div>
                    <ul class="role-list">
                        <li><i class="fas fa-check"></i> 6G Certified Welders</li>
                        <li><i class="fas fa-check"></i> TIG / MIG Welders</li>
                        <li><i class="fas fa-check"></i> Pipe Welders</li>
                        <li><i class="fas fa-check"></i> Underwater Welders</li>
                        <li><i class="fas fa-check"></i> Flux-Cored Arc Welders</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

  </main>

  <?php include 'includes/footer.php'; ?>

  <style>
    .sector-detail-section {
        padding: 80px 0;
    }
    .sector-badge {
        display: inline-block;
        padding: 6px 16px;
        background-color: rgba(var(--primary-blue-rgb), 0.1);
        color: var(--primary-blue);
        border-radius: 50px;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .expertise-list {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }
    .expertise-item {
        display: flex;
        gap: 16px;
    }
    .expertise-item i {
        color: var(--primary-blue);
        font-size: 24px;
        margin-top: 4px;
    }
    .expertise-item h4 {
        margin-bottom: 8px;
        font-size: 18px;
    }
    .expertise-item p {
        margin: 0;
        font-size: 15px;
        color: var(--text-muted);
    }
  </style>
</body>

</html>
