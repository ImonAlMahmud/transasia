<?php require_once 'includes/init.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php 
    $page_title = "Food & Hospitality Recruitment | " . $site_name;
    $meta_desc = "Premium recruitment for hotels, restaurants, and the food service industry. Connecting you with Bangladesh's hospitality professionals.";
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
      <div class="page-header-bg" style="background-image: url('images/sector-manufacturing.jpg');"></div>
      <div class="page-header-overlay"></div>
      <div class="container">
        <h1 data-aos="fade-up">Food & Consumers Goods</h1>
        <nav class="breadcrumb" aria-label="Breadcrumb" data-aos="fade-up" data-aos-delay="100">
          <a href="index.php">Home</a>
          <i class="fas fa-chevron-right"></i>
          <a href="industries.php">Industries</a>
          <i class="fas fa-chevron-right"></i>
          <span>Food & FMCG</span>
        </nav>
      </div>
    </section>

    <!-- Sector Detail -->
    <section class="sector-detail-section">
      <div class="container">
        <div class="two-column">
          <div class="column-image" data-aos="fade-right">
            <img src="images/sector-manufacturing.jpg" alt="Food production and FMCG" class="img-fluid rounded shadow">
          </div>
          <div class="column-content" data-aos="fade-left">
            <div class="sector-badge">FMCG Expertise</div>
            <h2>Quality Manpower for the Consumer Supply Chain</h2>
            <p>The Food and Fast-Moving Consumer Goods (FMCG) industries require a highly disciplined and safety-conscious workforce. At TransAsia, we specialize in supplying skilled personnel for every stage of the consumer product lifecycle, from manufacturing to distribution.</p>
            <p>We ensure that all candidates are well-versed in industry-standard hygiene, safety protocols, and quality assurance measures (HACCP, ISO).</p>
          </div>
        </div>

        <div class="expertise-list mt-5" data-aos="fade-up">
          <div class="expertise-item">
            <i class="fas fa-check-circle"></i>
            <div>
              <h4>Food Processing & Production</h4>
              <p>Certified operators for food production lines, processing plants, and industrial bakeries.</p>
            </div>
          </div>
          <div class="expertise-item">
            <i class="fas fa-check-circle"></i>
            <div>
              <h4>Packaging & Labeling Specialists</h4>
              <p>Skilled workers for high-speed automated packaging, bottling, and labeling systems.</p>
            </div>
          </div>
          <div class="expertise-item">
            <i class="fas fa-check-circle"></i>
            <div>
              <h4>HACCP & Quality Assurance</h4>
              <p>Qualified QA/QC technicians and inspectors to ensure compliance with food safety regulations.</p>
            </div>
          </div>
          <div class="expertise-item">
            <i class="fas fa-check-circle"></i>
            <div>
              <h4>Consumer Goods Distribution</h4>
              <p>Efficient warehouse staff, forklift operators, and delivery coordinators for FMCG logistics.</p>
            </div>
          </div>
        </div>

        <div class="cta-premium" data-aos="fade-up">
          <div class="cta-premium-content">
            <h4>Need Reliable FMCG Manpower?</h4>
            <p>Contact our consumer goods specialists to discuss your high-volume staffing needs.</p>
          </div>
          <a href="contact.php" class="btn btn-white">Contact Us</a>
        </div>
      </div>
    </section>

    <!-- Detailed Roles -->
    <section class="roles-overhaul-section">
        <div class="container">
            <div class="section-header text-center" data-aos="fade-up">
                <span class="sub-title">FMCG Talent Pool</span>
                <h2>Roles We Recruit</h2>
                <p>Essential positions in the food processing and consumer goods sectors</p>
            </div>
            
            <div class="roles-grid">
                <!-- Category 1 -->
                <div class="role-premium-card" data-aos="fade-up" data-aos-delay="0">
                    <div class="card-accent"></div>
                    <div class="card-header-icon">
                        <div class="icon-circle">
                            <i class="fas fa-industry"></i>
                        </div>
                        <h3>Production</h3>
                    </div>
                    <ul class="role-list">
                        <li><i class="fas fa-check"></i> Machine Operators</li>
                        <li><i class="fas fa-check"></i> Line Supervisors</li>
                        <li><i class="fas fa-check"></i> Production Technicians</li>
                        <li><i class="fas fa-check"></i> Packaging Operators</li>
                        <li><i class="fas fa-check"></i> Cleanroom Technicians</li>
                    </ul>
                </div>

                <!-- Category 2 -->
                <div class="role-premium-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-accent"></div>
                    <div class="card-header-icon">
                        <div class="icon-circle">
                            <i class="fas fa-vial"></i>
                        </div>
                        <h3>Quality & Safety</h3>
                    </div>
                    <ul class="role-list">
                        <li><i class="fas fa-check"></i> QA/QC Inspectors</li>
                        <li><i class="fas fa-check"></i> Lab Technicians</li>
                        <li><i class="fas fa-check"></i> Food Safety Officers</li>
                        <li><i class="fas fa-check"></i> Hygiene Supervisors</li>
                        <li><i class="fas fa-check"></i> Compliance Officers</li>
                    </ul>
                </div>

                <!-- Category 3 -->
                <div class="role-premium-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-accent"></div>
                    <div class="card-header-icon">
                        <div class="icon-circle">
                            <i class="fas fa-boxes-stacked"></i>
                        </div>
                        <h3>Supply Chain</h3>
                    </div>
                    <ul class="role-list">
                        <li><i class="fas fa-check"></i> Warehouse Managers</li>
                        <li><i class="fas fa-check"></i> Forklift Operators</li>
                        <li><i class="fas fa-check"></i> Inventory Controllers</li>
                        <li><i class="fas fa-check"></i> Logistics Coordinators</li>
                        <li><i class="fas fa-check"></i> Distribution Supervisors</li>
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
    .role-category h4 i {
        width: 30px;
    }
    .role-category li {
        margin-bottom: 10px;
        display: flex;
        align-items: center;
    }
    .role-category li i {
        margin-right: 10px;
    }
  </style>
</body>

</html>
