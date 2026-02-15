<?php require_once 'includes/init.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php 
    $page_title = "Facility Management Recruitment | " . $site_name;
    $meta_desc = "Supplying skilled staff for facility management, maintenance, and utility services. Trusted manpower for residential and commercial complexes.";
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
      <div class="page-header-bg" style="background-image: url('images/sector-healthcare.jpg');"></div>
      <div class="page-header-overlay"></div>
      <div class="container">
        <h1 data-aos="fade-up">Facility Management</h1>
        <nav class="breadcrumb" aria-label="Breadcrumb" data-aos="fade-up" data-aos-delay="100">
          <a href="index.php">Home</a>
          <i class="fas fa-chevron-right"></i>
          <a href="industries.php">Industries</a>
          <i class="fas fa-chevron-right"></i>
          <span>Facility Management</span>
        </nav>
      </div>
    </section>

    <!-- Sector Detail -->
    <section class="sector-detail-section">
      <div class="container">
        <div class="two-column">
          <div class="column-image" data-aos="fade-right">
            <img src="images/sector-healthcare.jpg" alt="Facility management operations" class="img-fluid rounded shadow">
          </div>
          <div class="column-content" data-aos="fade-left">
            <div class="sector-badge">FM Expertise</div>
            <h2>Maintaining Your Assets with Professional Staff</h2>
            <p>Facility management is essential for the smooth operation of commercial, residential, and industrial complexes. TransAsia provides high-quality manpower to ensure that your facilities remain safe, clean, and fully operational around the clock.</p>
            <p>From technical MEP (Mechanical, Electrical, Plumbing) services to soft services like security and janitorial care, we source individuals who are trained to deliver service excellence.</p>
          </div>
        </div>

        <div class="expertise-list mt-5" data-aos="fade-up">
          <div class="expertise-item">
            <i class="fas fa-check-circle"></i>
            <div>
              <h4>Technical Maintenance (MEP)</h4>
              <p>Certified HVAC technicians, electricians, and plumbers for comprehensive building maintenance.</p>
            </div>
          </div>
          <div class="expertise-item">
            <i class="fas fa-check-circle"></i>
            <div>
              <h4>Security & Protection Services</h4>
              <p>Trained security officers and loss prevention specialists to safeguard your premises and assets.</p>
            </div>
          </div>
          <div class="expertise-item">
            <i class="fas fa-check-circle"></i>
            <div>
              <h4>Cleaning & Soft Services</h4>
              <p>Professional janitorial staff, housekeepers, and landscaping crews for large-scale facility care.</p>
            </div>
          </div>
          <div class="expertise-item">
            <i class="fas fa-check-circle"></i>
            <div>
              <h4>BMS & Systems Operation</h4>
              <p>Qualified operators for Building Management Systems, fire safety, and surveillance networks.</p>
            </div>
          </div>
        </div>

        <div class="cta-premium" data-aos="fade-up">
          <div class="cta-premium-content">
            <h4>Enhance Your Facility's Service Quality?</h4>
            <p>Contact our FM recruitment desk to source dependable maintenance and service crews.</p>
          </div>
          <a href="contact.php" class="btn btn-white">Contact Us</a>
        </div>
      </div>
    </section>

    <!-- Detailed Roles -->
    <section class="roles-overhaul-section">
        <div class="container">
            <div class="section-header text-center" data-aos="fade-up">
                <span class="sub-title">FM Service Spectrum</span>
                <h2>Roles We Recruit</h2>
                <p>Comprehensive staffing solutions for all facility management needs</p>
            </div>
            
            <div class="roles-grid">
                <!-- Category 1 -->
                <div class="role-premium-card" data-aos="fade-up" data-aos-delay="0">
                    <div class="card-accent"></div>
                    <div class="card-header-icon">
                        <div class="icon-circle">
                            <i class="fas fa-screwdriver-wrench"></i>
                        </div>
                        <h3>Technical Services</h3>
                    </div>
                    <ul class="role-list">
                        <li><i class="fas fa-check"></i> HVAC Technicians</li>
                        <li><i class="fas fa-check"></i> MEP Supervisors</li>
                        <li><i class="fas fa-check"></i> General Electricians</li>
                        <li><i class="fas fa-check"></i> Plumbers & Pipe Fitters</li>
                        <li><i class="fas fa-check"></i> BMS Operators</li>
                    </ul>
                </div>

                <!-- Category 2 -->
                <div class="role-premium-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-accent"></div>
                    <div class="card-header-icon">
                        <div class="icon-circle">
                            <i class="fas fa-shield-halved"></i>
                        </div>
                        <h3>Security & Safety</h3>
                    </div>
                    <ul class="role-list">
                        <li><i class="fas fa-check"></i> Security Guards</li>
                        <li><i class="fas fa-check"></i> Shift Supervisors</li>
                        <li><i class="fas fa-check"></i> CCTV Operators</li>
                        <li><i class="fas fa-check"></i> Fire Safety Marshals</li>
                        <li><i class="fas fa-check"></i> Access Control Officers</li>
                    </ul>
                </div>

                <!-- Category 3 -->
                <div class="role-premium-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-accent"></div>
                    <div class="card-header-icon">
                        <div class="icon-circle">
                            <i class="fas fa-broom"></i>
                        </div>
                        <h3>Soft Services</h3>
                    </div>
                    <ul class="role-list">
                        <li><i class="fas fa-check"></i> Housekeeping Staff</li>
                        <li><i class="fas fa-check"></i> Janitorial Crews</li>
                        <li><i class="fas fa-check"></i> Gardeners & Landscapers</li>
                        <li><i class="fas fa-check"></i> Receptionists</li>
                        <li><i class="fas fa-check"></i> Admin Assistants</li>
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
