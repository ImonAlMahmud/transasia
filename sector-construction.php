<?php require_once 'includes/init.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php 
    $page_title = "Construction Sector Recruitment | " . $site_name;
    $meta_desc = "Specialized recruitment solutions for the construction industry. Supplying skilled manpower for high-rise buildings, infrastructure, and mega-projects.";
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
      <div class="page-header-bg" style="background-image: url('images/sector-construction.jpg');"></div>
      <div class="page-header-overlay"></div>
      <div class="container">
        <h1 data-aos="fade-up">Construction Sector</h1>
        <nav class="breadcrumb" aria-label="Breadcrumb" data-aos="fade-up" data-aos-delay="100">
          <a href="index.php">Home</a>
          <i class="fas fa-chevron-right"></i>
          <a href="industries.php">Industries</a>
          <i class="fas fa-chevron-right"></i>
          <span>Construction</span>
        </nav>
      </div>
    </section>

    <!-- Sector Detail -->
    <section class="sector-detail-section">
      <div class="container">
        <div class="two-column">
          <div class="column-image" data-aos="fade-right">
            <img src="images/sector-construction.jpg" alt="Construction projects" class="img-fluid rounded shadow">
          </div>
          <div class="column-content" data-aos="fade-left">
            <div class="sector-badge">Industry Expertise</div>
            <h2>Building Excellence Through Quality Manpower</h2>
            <p>The construction industry is the backbone of urban development and infrastructure. At TransAsia, we understand the critical importance of having a skilled, reliable, and safety-conscious workforce to ensure projects are completed on time and to the highest standards.</p>
            <p>We provide a comprehensive range of recruitment services for the construction sector, from highly qualified engineers and project managers to skilled tradespeople and general laborers.</p>
            
            <div class="expertise-list mt-4">
              <div class="expertise-item">
                <i class="fas fa-check-circle"></i>
                <div>
                  <h4>Civil & Structural Engineering</h4>
                  <p>Qualified engineers with experience in large-scale residential, commercial, and industrial projects.</p>
                </div>
              </div>
              <div class="expertise-item">
                <i class="fas fa-check-circle"></i>
                <div>
                  <h4>Project Management & Supervision</h4>
                  <p>Experienced supervisors and managers to oversee site operations and ensure quality control.</p>
                </div>
              </div>
              <div class="expertise-item">
                <i class="fas fa-check-circle"></i>
                <div>
                  <h4>Skilled Trades</h4>
                  <p>Certified masons, carpenters, steel fixers, plumbers, and electricians ready for deployment.</p>
                </div>
              </div>
              <div class="expertise-item">
                <i class="fas fa-check-circle"></i>
                <div>
                  <h4>Heavy Equipment Operations</h4>
                  <p>Trained operators for cranes, excavators, and other specialized construction machinery.</p>
                </div>
              </div>
            </div>

            <div class="cta-box mt-5 p-4 bg-light rounded border-start border-primary border-4">
              <h4>Ready to Scale Your Construction Team?</h4>
              <p>Contact our sector specialists today to discuss your project requirements.</p>
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
                <span class="sub-title">Resource Spectrum</span>
                <h2>Roles We Recruit</h2>
                <p>We provide a comprehensive range of professionals to meet every project demand</p>
            </div>
            
            <div class="roles-grid">
                <!-- Category 1 -->
                <div class="role-premium-card" data-aos="fade-up" data-aos-delay="0">
                    <div class="card-accent"></div>
                    <div class="card-header-icon">
                        <div class="icon-circle">
                            <i class="fas fa-drafting-compass"></i>
                        </div>
                        <h3>Technical & Design</h3>
                    </div>
                    <ul class="role-list">
                        <li><i class="fas fa-check"></i> Civil Engineers</li>
                        <li><i class="fas fa-check"></i> Structural Engineers</li>
                        <li><i class="fas fa-check"></i> Surveyors</li>
                        <li><i class="fas fa-check"></i> AutoCAD Draftsmen</li>
                        <li><i class="fas fa-check"></i> QA/QC Engineers</li>
                    </ul>
                </div>

                <!-- Category 2 -->
                <div class="role-premium-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-accent"></div>
                    <div class="card-header-icon">
                        <div class="icon-circle">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <h3>Management</h3>
                    </div>
                    <ul class="role-list">
                        <li><i class="fas fa-check"></i> Project Managers</li>
                        <li><i class="fas fa-check"></i> Site Supervisors</li>
                        <li><i class="fas fa-check"></i> Planning Engineers</li>
                        <li><i class="fas fa-check"></i> Safety Officers (HSE)</li>
                        <li><i class="fas fa-check"></i> Quantity Surveyors</li>
                    </ul>
                </div>

                <!-- Category 3 -->
                <div class="role-premium-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-accent"></div>
                    <div class="card-header-icon">
                        <div class="icon-circle">
                            <i class="fas fa-tools"></i>
                        </div>
                        <h3>Skilled Trades</h3>
                    </div>
                    <ul class="role-list">
                        <li><i class="fas fa-check"></i> Masons & Plasterers</li>
                        <li><i class="fas fa-check"></i> Carpenters (Shuttering/Finishing)</li>
                        <li><i class="fas fa-check"></i> Steel Fixers</li>
                        <li><i class="fas fa-check"></i> Electricians & Plumbers</li>
                        <li><i class="fas fa-check"></i> Painters & Tilers</li>
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
