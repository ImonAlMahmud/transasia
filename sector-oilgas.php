<?php require_once 'includes/init.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php 
    $page_title = "Oil & Gas Industry Recruitment | " . $site_name;
    $meta_desc = "Specialized manpower solutions for the global energy, oil, and gas sectors. Verified professionals for offshore and onshore projects.";
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
      <div class="page-header-bg" style="background-image: url('images/sector-oilgas.jpg');"></div>
      <div class="page-header-overlay"></div>
      <div class="container">
        <h1 data-aos="fade-up">Oil & Gas / Petrochemical</h1>
        <nav class="breadcrumb" aria-label="Breadcrumb" data-aos="fade-up" data-aos-delay="100">
          <a href="index.php">Home</a>
          <i class="fas fa-chevron-right"></i>
          <a href="industries.php">Industries</a>
          <i class="fas fa-chevron-right"></i>
          <span>Oil & Gas</span>
        </nav>
      </div>
    </section>

    <!-- Sector Detail -->
    <section class="sector-detail-section">
      <div class="container">
        <div class="two-column">
          <div class="column-image" data-aos="fade-right">
            <img src="images/sector-oilgas.jpg" alt="Oil & Gas facility" class="img-fluid rounded shadow">
          </div>
          <div class="column-content" data-aos="fade-left">
            <div class="sector-badge">Energy Expertise</div>
            <h2>Fueling Industry with Technical Talent</h2>
            <p>The Oil & Gas and Petrochemical sectors demand the highest levels of technical expertise, safety compliance, and operational reliability. TransAsia is a trusted partner for companies operating in upstream, midstream, and downstream environments.</p>
            <p>Our recruitment specialists precisely vet candidates to ensure they possess the necessary certifications and experience to operate in high-risk, high-reward industrial environments.</p>
          </div>
        </div>

        <div class="expertise-list mt-5" data-aos="fade-up">
          <div class="expertise-item">
            <i class="fas fa-check-circle"></i>
            <div>
              <h4>Upstream & Drilling Operations</h4>
              <p>Qualified petroleum engineers, rig operators, and technicians for onshore and offshore exploration.</p>
            </div>
          </div>
          <div class="expertise-item">
            <i class="fas fa-check-circle"></i>
            <div>
              <h4>Refining & Petrochemical Processing</h4>
              <p>Skilled operators and maintenance crews for chemical plants and oil refineries.</p>
            </div>
          </div>
          <div class="expertise-item">
            <i class="fas fa-check-circle"></i>
            <div>
              <h4>Pipeline & Infrastructure</h4>
              <p>Experienced technicians and welders specialized in high-pressure pipeline construction and maintenance.</p>
            </div>
          </div>
          <div class="expertise-item">
            <i class="fas fa-check-circle"></i>
            <div>
              <h4>Health, Safety & Environment (HSE)</h4>
              <p>Certified safety officers and inspectors to ensure strict adherence to international safety protocols.</p>
            </div>
          </div>
        </div>

        <div class="cta-premium" data-aos="fade-up">
          <div class="cta-premium-content">
            <h4>Demand for Specialized Oil & Gas Talent?</h4>
            <p>Our energy specialists are ready to help you source the right technical workforce.</p>
          </div>
          <a href="contact.php" class="btn btn-white">Contact Us</a>
        </div>
      </div>
    </section>

    <!-- Detailed Roles -->
    <section class="roles-overhaul-section">
        <div class="container">
            <div class="section-header text-center" data-aos="fade-up">
                <span class="sub-title">Energy Talent Spectrum</span>
                <h2>Roles We Recruit</h2>
                <p>Key positions we fill across the energy and petrochemical supply chain</p>
            </div>
            
            <div class="roles-grid">
                <!-- Category 1 -->
                <div class="role-premium-card" data-aos="fade-up" data-aos-delay="0">
                    <div class="card-accent"></div>
                    <div class="card-header-icon">
                        <div class="icon-circle">
                            <i class="fas fa-flask"></i>
                        </div>
                        <h3>Engineering</h3>
                    </div>
                    <ul class="role-list">
                        <li><i class="fas fa-check"></i> Petroleum Engineers</li>
                        <li><i class="fas fa-check"></i> Chemical Engineers</li>
                        <li><i class="fas fa-check"></i> Mechanical Engineers</li>
                        <li><i class="fas fa-check"></i> Instrument Engineers</li>
                        <li><i class="fas fa-check"></i> Pipeline Engineers</li>
                    </ul>
                </div>

                <!-- Category 2 -->
                <div class="role-premium-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-accent"></div>
                    <div class="card-header-icon">
                        <div class="icon-circle">
                            <i class="fas fa-oil-well"></i>
                        </div>
                        <h3>Field Operations</h3>
                    </div>
                    <ul class="role-list">
                        <li><i class="fas fa-check"></i> Rig Managers</li>
                        <li><i class="fas fa-check"></i> Drillers & Assistant Drillers</li>
                        <li><i class="fas fa-check"></i> Mud Engineers</li>
                        <li><i class="fas fa-check"></i> Roughnecks & Roustabouts</li>
                        <li><i class="fas fa-check"></i> Derrickmen</li>
                    </ul>
                </div>

                <!-- Category 3 -->
                <div class="role-premium-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-accent"></div>
                    <div class="card-header-icon">
                        <div class="icon-circle">
                            <i class="fas fa-tools"></i>
                        </div>
                        <h3>Technical Services</h3>
                    </div>
                    <ul class="role-list">
                        <li><i class="fas fa-check"></i> NDT Technicians</li>
                        <li><i class="fas fa-check"></i> Instrument Technicians</li>
                        <li><i class="fas fa-check"></i> Mechanical Fitters</li>
                        <li><i class="fas fa-check"></i> 6G Welders</li>
                        <li><i class="fas fa-check"></i> Plant Operators</li>
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
