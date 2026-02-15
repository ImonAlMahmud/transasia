<?php require_once 'includes/init.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php 
    $page_title = "Transport & Logistics Recruitment | " . $site_name;
    $meta_desc = "Skilled drivers, logistics experts, and transport personnel for global companies. Efficient manpower solutions for your logistics chain.";
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
      <div class="page-header-bg" style="background-image: url('images/sector-infrastructure.jpg');"></div>
      <div class="page-header-overlay"></div>
      <div class="container">
        <h1 data-aos="fade-up">Transportation & Logistics</h1>
        <nav class="breadcrumb" aria-label="Breadcrumb" data-aos="fade-up" data-aos-delay="100">
          <a href="index.php">Home</a>
          <i class="fas fa-chevron-right"></i>
          <a href="industries.php">Industries</a>
          <i class="fas fa-chevron-right"></i>
          <span>Transportation</span>
        </nav>
      </div>
    </section>

    <!-- Sector Detail -->
    <section class="sector-detail-section">
      <div class="container">
        <div class="two-column">
          <div class="column-image" data-aos="fade-right">
            <img src="images/sector-infrastructure.jpg" alt="Transportation and logistics operations" class="img-fluid rounded shadow">
          </div>
          <div class="column-content" data-aos="fade-left">
            <div class="sector-badge">Logistics Expertise</div>
            <h2>Reliable Talent for the Global Supply Chain</h2>
            <p>The transportation and logistics industry is a fast-paced environment that requires reliability, efficiency, and a commitment to safety. TransAsia provides skilled manpower to keep your goods and people moving across borders and within local markets.</p>
            <p>We specialized in sourcing professional heavy and light vehicle drivers, as well as the administrative and technical staff needed to manage complex logistics networks.</p>
          </div>
        </div>

        <div class="expertise-list mt-5" data-aos="fade-up">
          <div class="expertise-item">
            <i class="fas fa-check-circle"></i>
            <div>
              <h4>Professional Transportation Gear</h4>
              <p>Certified heavy vehicle drivers, bus drivers, and specialized forklift operators for various industrial needs.</p>
            </div>
          </div>
          <div class="expertise-item">
            <i class="fas fa-check-circle"></i>
            <div>
              <h4>Logistics & Fleet Management</h4>
              <p>Experienced coordinators to manage fleet operations, route planning, and documentation clerical tasks.</p>
            </div>
          </div>
          <div class="expertise-item">
            <i class="fas fa-check-circle"></i>
            <div>
              <h4>Warehouse & Distribution Center Operations</h4>
              <p>Skilled staff for loading, unloading, inventory management, and computerized warehouse systems.</p>
            </div>
          </div>
          <div class="expertise-item">
            <i class="fas fa-check-circle"></i>
            <div>
              <h4>Maintenance & Automotive Services</h4>
              <p>Qualified mechanics and technicians to ensure your fleet remains in peak operational condition.</p>
            </div>
          </div>
        </div>

        <div class="cta-premium" data-aos="fade-up">
          <div class="cta-premium-content">
            <h4>Scale Your Logistics Capability?</h4>
            <p>Contact our transportation specialists today to discuss your staffing requirements.</p>
          </div>
          <a href="contact.php" class="btn btn-white">Contact Us</a>
        </div>
      </div>
    </section>

    <!-- Detailed Roles -->
    <section class="roles-overhaul-section">
        <div class="container">
            <div class="section-header text-center" data-aos="fade-up">
                <span class="sub-title">Supply Chain Talent</span>
                <h2>Roles We Recruit</h2>
                <p>Essential positions across the transportation and logistics landscape</p>
            </div>
            
            <div class="roles-grid">
                <!-- Category 1 -->
                <div class="role-premium-card" data-aos="fade-up" data-aos-delay="0">
                    <div class="card-accent"></div>
                    <div class="card-header-icon">
                        <div class="icon-circle">
                            <i class="fas fa-truck"></i>
                        </div>
                        <h3>Drivers</h3>
                    </div>
                    <ul class="role-list">
                        <li><i class="fas fa-check"></i> Heavy Truck Drivers (Trailer)</li>
                        <li><i class="fas fa-check"></i> Bus & Coach Drivers</li>
                        <li><i class="fas fa-check"></i> Light Vehicle Drivers</li>
                        <li><i class="fas fa-check"></i> Forklift Operators</li>
                        <li><i class="fas fa-check"></i> Special Vehicle Operators</li>
                    </ul>
                </div>

                <!-- Category 2 -->
                <div class="role-premium-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-accent"></div>
                    <div class="card-header-icon">
                        <div class="icon-circle">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <h3>Logistics & Admin</h3>
                    </div>
                    <ul class="role-list">
                        <li><i class="fas fa-check"></i> Logistics Coordinators</li>
                        <li><i class="fas fa-check"></i> Dispatch Supervisors</li>
                        <li><i class="fas fa-check"></i> Warehouse Supervisors</li>
                        <li><i class="fas fa-check"></i> Customs Clearance Clerks</li>
                        <li><i class="fas fa-check"></i> Inventory Controllers</li>
                    </ul>
                </div>

                <!-- Category 3 -->
                <div class="role-premium-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-accent"></div>
                    <div class="card-header-icon">
                        <div class="icon-circle">
                            <i class="fas fa-wrench"></i>
                        </div>
                        <h3>Fleet Maintenance</h3>
                    </div>
                    <ul class="role-list">
                        <li><i class="fas fa-check"></i> Diesel Mechanics</li>
                        <li><i class="fas fa-check"></i> Auto Electricians</li>
                        <li><i class="fas fa-check"></i> Tyre Technicians</li>
                        <li><i class="fas fa-check"></i> Fleet Managers</li>
                        <li><i class="fas fa-check"></i> Workshop Supervisors</li>
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
