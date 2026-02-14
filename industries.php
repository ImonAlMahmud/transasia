<?php require_once 'includes/init.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php 
    $page_title = "Industries We Serve | " . $site_name . " - Sector-Specific Recruitment";
    $meta_desc = "TransAsia provides specialized recruitment solutions for Oil & Gas, Construction, Hospitality, Healthcare, Manufacturing, and Infrastructure sectors.";
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
      <div class="page-header-bg" style="background-image: url('<?php echo get_setting('industries_header_bg', 'images/industries-header.jpg'); ?>');"></div>
      <div class="page-header-overlay"></div>
      <div class="container">
        <h1 data-aos="fade-up">Industries We Serve</h1>
        <nav class="breadcrumb" aria-label="Breadcrumb" data-aos="fade-up" data-aos-delay="100">
          <a href="index.php">Home</a>
          <i class="fas fa-chevron-right"></i>
          <span>Industries</span>
        </nav>
      </div>
    </section>

    <!-- Industries Introduction -->
    <section aria-labelledby="industries-intro-heading">
      <div class="container">
        <div class="section-header" data-aos="fade-up">
          <h2 id="industries-intro-heading">Sector-Specific Expertise</h2>
          <p>We understand that each industry has unique workforce requirements. Our specialized recruitment teams have
            deep knowledge and experience in key sectors, ensuring we deliver candidates who are not just qualified, but
            truly suited to your industry's demands.</p>
        </div>
      </div>
    </section>

    <!-- Industry Grid -->
    <section class="bg-light" aria-labelledby="sectors-heading">
      <div class="container">
        <div class="section-header" data-aos="fade-up">
          <h2 id="sectors-heading">Our Industry Sectors</h2>
          <p>Click on any sector to learn more about our specialized recruitment capabilities</p>
        </div>
        <div class="industry-grid">
          <!-- Construction -->
          <div class="industry-card" data-aos="fade-up" data-aos-delay="0">
            <div class="industry-card-image">
              <img src="images/sector-construction-new.jpg" alt="Construction industry" onerror="this.src='images/industry-construction.jpg'">
            </div>
            <div class="industry-card-overlay">
              <h3>Construction</h3>
              <a href="#construction" class="industry-card-link">Learn More <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>

          <!-- Oil & Gas / Petrochemical -->
          <div class="industry-card" data-aos="fade-up" data-aos-delay="100">
            <div class="industry-card-image">
              <img src="images/sector-oilgas-new.jpg" alt="Oil & Gas / Petrochemical" onerror="this.src='images/industry-oilgas.jpg'">
            </div>
            <div class="industry-card-overlay">
              <h3>Oil & Gas<br>Petrochemical</h3>
              <a href="#oilgas" class="industry-card-link">Learn More <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>

          <!-- Engineering & Fabrication -->
          <div class="industry-card" data-aos="fade-up" data-aos-delay="200">
            <div class="industry-card-image">
              <img src="images/sector-engineering-new.jpg" alt="Engineering & Fabrication" onerror="this.src='images/industry-infrastructure.jpg'">
            </div>
            <div class="industry-card-overlay">
              <h3>Engineering & Fabrication</h3>
              <a href="#engineering" class="industry-card-link">Learn More <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>

          <!-- Food & Consumers Goods -->
          <div class="industry-card" data-aos="fade-up" data-aos-delay="300">
            <div class="industry-card-image">
              <img src="images/sector-food-new.jpg" alt="Food & Consumers Goods" onerror="this.src='images/industry-manufacturing.jpg'">
            </div>
            <div class="industry-card-overlay">
              <h3>Food & Consumers Goods</h3>
              <a href="#food" class="industry-card-link">Learn More <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>

          <!-- Facility Management -->
          <div class="industry-card" data-aos="fade-up" data-aos-delay="400">
            <div class="industry-card-image">
              <img src="images/sector-facility-new.jpg" alt="Facility Management" onerror="this.src='images/industry-healthcare.jpg'">
            </div>
            <div class="industry-card-overlay">
              <h3>Facility Management</h3>
              <a href="#facility" class="industry-card-link">Learn More <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>

          <!-- Transportation -->
          <div class="industry-card" data-aos="fade-up" data-aos-delay="500">
            <div class="industry-card-image">
              <img src="images/sector-transport-new.jpg" alt="Transportation" onerror="this.src='images/industry-infrastructure.jpg'">
            </div>
            <div class="industry-card-overlay">
              <h3>Transportation</h3>
              <a href="#transport" class="industry-card-link">Learn More <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Sector Details -->
    <section aria-labelledby="capabilities-heading">
      <div class="container">
        <div class="section-header" data-aos="fade-up">
          <h2 id="capabilities-heading">Sector Capabilities</h2>
          <p>Detailed breakdown of our recruitment expertise by industry</p>
        </div>

        <!-- Construction -->
        <div id="construction" class="two-column" style="margin-bottom: 80px;" data-aos="fade-up">
          <div class="column-image">
            <img src="images/sector-construction.jpg" alt="Construction workers" loading="lazy">
          </div>
          <div class="column-content">
            <h3><i class="fas fa-hard-hat" style="color: var(--primary-blue); margin-right: 12px;"></i>Construction</h3>
            <p>From high-rise buildings to infrastructure mega-projects, we supply skilled construction workers who can deliver quality results on time and within budget.</p>
            <ul style="list-style: none; padding: 0; margin: 24px 0;">
              <li style="padding: 8px 0;"><i class="fas fa-check" style="color: var(--primary-blue); margin-right: 12px;"></i>Civil & Structural Engineers</li>
              <li style="padding: 8px 0;"><i class="fas fa-check" style="color: var(--primary-blue); margin-right: 12px;"></i>Project Managers & Supervisors</li>
              <li style="padding: 8px 0;"><i class="fas fa-check" style="color: var(--primary-blue); margin-right: 12px;"></i>Masons, Carpenters, Steel Fixers</li>
              <li style="padding: 8px 0;"><i class="fas fa-check" style="color: var(--primary-blue); margin-right: 12px;"></i>Heavy Equipment Operators</li>
              <li style="padding: 8px 0;"><i class="fas fa-check" style="color: var(--primary-blue); margin-right: 12px;"></i>Surveyors & Draftsmen</li>
            </ul>
            <div class="cta-btns" style="display: flex; gap: 12px; margin-top: 24px;">
              <a href="sector-construction.php" class="btn btn-primary">Read More</a>
              <a href="contact.php" class="btn btn-outline-dark">Request Construction Talent</a>
            </div>
          </div>
        </div>

        <!-- Oil & Gas / Petrochemical -->
        <div id="oilgas" class="two-column reverse" style="margin-bottom: 80px;" data-aos="fade-up">
          <div class="column-image">
            <img src="images/sector-oilgas.jpg" alt="Oil and Gas workers" loading="lazy">
          </div>
          <div class="column-content">
            <h3><i class="fas fa-oil-can" style="color: var(--primary-blue); margin-right: 12px;"></i>Oil & Gas / Petrochemical</h3>
            <p>The oil and gas sector demands highly specialized skills and strict safety compliance. We recruit experienced professionals who understand the rigorous standards of this industry.</p>
            <ul style="list-style: none; padding: 0; margin: 24px 0;">
              <li style="padding: 8px 0;"><i class="fas fa-check" style="color: var(--primary-blue); margin-right: 12px;"></i>Petroleum Engineers & Technicians</li>
              <li style="padding: 8px 0;"><i class="fas fa-check" style="color: var(--primary-blue); margin-right: 12px;"></i>Rig Operators & Drillers</li>
              <li style="padding: 8px 0;"><i class="fas fa-check" style="color: var(--primary-blue); margin-right: 12px;"></i>Pipeline Technicians</li>
              <li style="padding: 8px 0;"><i class="fas fa-check" style="color: var(--primary-blue); margin-right: 12px;"></i>Safety Officers (HSE)</li>
              <li style="padding: 8px 0;"><i class="fas fa-check" style="color: var(--primary-blue); margin-right: 12px;"></i>Maintenance Technicians</li>
            </ul>
            <div class="cta-btns" style="display: flex; gap: 12px; margin-top: 24px;">
              <a href="sector-oilgas.php" class="btn btn-primary">Read More</a>
              <a href="contact.php" class="btn btn-outline-dark">Request Oil & Gas Talent</a>
            </div>
          </div>
        </div>

        <!-- Engineering & Fabrication -->
        <div id="engineering" class="two-column" style="margin-bottom: 80px;" data-aos="fade-up">
          <div class="column-image">
            <img src="images/sector-engineering-new.jpg" alt="Engineering and Fabrication" onerror="this.src='images/sector-oilgas.jpg'">
          </div>
          <div class="column-content">
            <h3><i class="fas fa-gears" style="color: var(--primary-blue); margin-right: 12px;"></i>Engineering & Fabrication</h3>
            <p>We provide highly skilled welders, fabricators, and engineers specialized in heavy industrial projects and complex metal structures.</p>
            <ul style="list-style: none; padding: 0; margin: 24px 0;">
              <li style="padding: 8px 0;"><i class="fas fa-check" style="color: var(--primary-blue); margin-right: 12px;"></i>Certified Welders (6G/TIG/MIG)</li>
              <li style="padding: 8px 0;"><i class="fas fa-check" style="color: var(--primary-blue); margin-right: 12px;"></i>Structural Steel Fabricators</li>
              <li style="padding: 8px 0;"><i class="fas fa-check" style="color: var(--primary-blue); margin-right: 12px;"></i>Mechanical Engineers & Designers</li>
              <li style="padding: 8px 0;"><i class="fas fa-check" style="color: var(--primary-blue); margin-right: 12px;"></i>Pipe Fabricators & Fitters</li>
              <li style="padding: 8px 0;"><i class="fas fa-check" style="color: var(--primary-blue); margin-right: 12px;"></i>CNC Machine Operators</li>
            </ul>
            <div class="cta-btns" style="display: flex; gap: 12px; margin-top: 24px;">
              <a href="sector-engineering.php" class="btn btn-primary">Read More</a>
              <a href="contact.php" class="btn btn-outline-dark">Request Engineering Talent</a>
            </div>
          </div>
        </div>

        <!-- Food & Consumers Goods -->
        <div id="food" class="two-column reverse" style="margin-bottom: 80px;" data-aos="fade-up">
          <div class="column-image">
            <img src="images/sector-food-new.jpg" alt="Food production facility" onerror="this.src='images/sector-manufacturing.jpg'">
          </div>
          <div class="column-content">
            <h3><i class="fas fa-cookie-bite" style="color: var(--primary-blue); margin-right: 12px;"></i>Food & Consumers Goods</h3>
            <p>From production to packaging, we provide a skilled workforce for the fast-moving consumer goods (FMCG) and food processing industries.</p>
            <ul style="list-style: none; padding: 0; margin: 24px 0;">
              <li style="padding: 8px 0;"><i class="fas fa-check" style="color: var(--primary-blue); margin-right: 12px;"></i>Food Processing Operators</li>
              <li style="padding: 8px 0;"><i class="fas fa-check" style="color: var(--primary-blue); margin-right: 12px;"></i>Packaging & Labeling Specialists</li>
              <li style="padding: 8px 0;"><i class="fas fa-check" style="color: var(--primary-blue); margin-right: 12px;"></i>Quality Assurance Technicians</li>
              <li style="padding: 8px 0;"><i class="fas fa-check" style="color: var(--primary-blue); margin-right: 12px;"></i>HACCP & Food Safety Inspectors</li>
              <li style="padding: 8px 0;"><i class="fas fa-check" style="color: var(--primary-blue); margin-right: 12px;"></i>Distribution & Logistics Staff</li>
            </ul>
            <div class="cta-btns" style="display: flex; gap: 12px; margin-top: 24px;">
              <a href="sector-food.php" class="btn btn-primary">Read More</a>
              <a href="contact.php" class="btn btn-outline-dark">Request Food Sector Talent</a>
            </div>
          </div>
        </div>

        <!-- Facility Management -->
        <div id="facility" class="two-column" style="margin-bottom: 80px;" data-aos="fade-up">
          <div class="column-image">
            <img src="images/sector-facility-new.jpg" alt="Facility management services" onerror="this.src='images/sector-healthcare.jpg'">
          </div>
          <div class="column-content">
            <h3><i class="fas fa-building-circle-check" style="color: var(--primary-blue); margin-right: 12px;"></i>Facility Management</h3>
            <p>Ensuring your operations run smoothly with professional maintenance, security, and cleaning services for large-scale facilities.</p>
            <ul style="list-style: none; padding: 0; margin: 24px 0;">
              <li style="padding: 8px 0;"><i class="fas fa-check" style="color: var(--primary-blue); margin-right: 12px;"></i>Security & Loss Prevention Officers</li>
              <li style="padding: 8px 0;"><i class="fas fa-check" style="color: var(--primary-blue); margin-right: 12px;"></i>HVAC & MEP Maintenance Crews</li>
              <li style="padding: 8px 0;"><i class="fas fa-check" style="color: var(--primary-blue); margin-right: 12px;"></i>Janitorial & Soft Services Staff</li>
              <li style="padding: 8px 0;"><i class="fas fa-check" style="color: var(--primary-blue); margin-right: 12px;"></i>Building Management System (BMS) Operators</li>
              <li style="padding: 8px 0;"><i class="fas fa-check" style="color: var(--primary-blue); margin-right: 12px;"></i>Landscaping & Ground Maintenance</li>
            </ul>
            <div class="cta-btns" style="display: flex; gap: 12px; margin-top: 24px;">
              <a href="sector-facility.php" class="btn btn-primary">Read More</a>
              <a href="contact.php" class="btn btn-outline-dark">Request Facility Talent</a>
            </div>
          </div>
        </div>

        <!-- Transportation -->
        <div id="transport" class="two-column reverse" data-aos="fade-up">
          <div class="column-image">
            <img src="images/sector-transport-new.jpg" alt="Transportation and Logistics" onerror="this.src='images/sector-infrastructure.jpg'">
          </div>
          <div class="column-content">
            <h3><i class="fas fa-truck-moving" style="color: var(--primary-blue); margin-right: 12px;"></i>Transportation</h3>
            <p>Providing professional drivers and logistics coordinators for safe and efficient transportation of goods and people.</p>
            <ul style="list-style: none; padding: 0; margin: 24px 0;">
              <li style="padding: 8px 0;"><i class="fas fa-check" style="color: var(--primary-blue); margin-right: 12px;"></i>Heavy & Light Vehicle Drivers</li>
              <li style="padding: 8px 0;"><i class="fas fa-check" style="color: var(--primary-blue); margin-right: 12px;"></i>Logistics & Fleet Coordinators</li>
              <li style="padding: 8px 0;"><i class="fas fa-check" style="color: var(--primary-blue); margin-right: 12px;"></i>Warehouse & Forklift Operators</li>
              <li style="padding: 8px 0;"><i class="fas fa-check" style="color: var(--primary-blue); margin-right: 12px;"></i>Automotive Maintenance Technicians</li>
              <li style="padding: 8px 0;"><i class="fas fa-check" style="color: var(--primary-blue); margin-right: 12px;"></i>Customs & Documentation Clerks</li>
            </ul>
            <div class="cta-btns" style="display: flex; gap: 12px; margin-top: 24px;">
              <a href="sector-transport.php" class="btn btn-primary">Read More</a>
              <a href="contact.php" class="btn btn-outline-dark">Request Transportation Talent</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Download Center -->
    <section class="bg-light" aria-labelledby="download-heading">
      <div class="container">
        <div class="section-header" data-aos="fade-up">
          <h2 id="download-heading">Download Center</h2>
          <p>Access our capability statements and industry-specific brochures</p>
        </div>
        <div class="value-cards">
          <!-- Card 1 -->
          <div class="value-card" data-aos="fade-up" data-aos-delay="0">
            <div class="value-card-icon">
              <i class="fas fa-file-pdf"></i>
            </div>
            <h3><?php echo htmlspecialchars(get_setting('dl_1_title', 'Company Profile')); ?></h3>
            <p><?php echo htmlspecialchars(get_setting('dl_1_desc', 'Complete overview of TransAsia\'s services, certifications, and capabilities.')); ?></p>
            <a href="<?php echo htmlspecialchars(get_setting('dl_1_url', '#')); ?>" class="btn btn-outline-dark btn-sm mt-4">Download PDF</a>
          </div>
          <!-- Card 2 -->
          <div class="value-card" data-aos="fade-up" data-aos-delay="100">
            <div class="value-card-icon">
              <i class="fas fa-file-pdf"></i>
            </div>
            <h3><?php echo htmlspecialchars(get_setting('dl_2_title', 'Sector Capabilities')); ?></h3>
            <p><?php echo htmlspecialchars(get_setting('dl_2_desc', 'Detailed breakdown of our recruitment expertise across all industry sectors.')); ?></p>
            <a href="<?php echo htmlspecialchars(get_setting('dl_2_url', '#')); ?>" class="btn btn-outline-dark btn-sm mt-4">Download PDF</a>
          </div>
          <!-- Card 3 -->
          <div class="value-card" data-aos="fade-up" data-aos-delay="200">
            <div class="value-card-icon">
              <i class="fas fa-file-pdf"></i>
            </div>
            <h3><?php echo htmlspecialchars(get_setting('dl_3_title', 'Ethical Recruitment Policy')); ?></h3>
            <p><?php echo htmlspecialchars(get_setting('dl_3_desc', 'Our commitment to fair recruitment practices and worker protection.')); ?></p>
            <a href="<?php echo htmlspecialchars(get_setting('dl_3_url', '#')); ?>" class="btn btn-outline-dark btn-sm mt-4">Download PDF</a>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer CTA -->
    <section class="footer-cta" aria-label="Call to action">
      <div class="container">
        <div data-aos="fade-up">
          <h2>Looking for Industry-Specific Talent?</h2>
          <p>Our sector specialists are ready to understand your unique requirements</p>
          <a href="contact.php" class="btn btn-white">Talk to a Sector Specialist</a>
        </div>
      </div>
    </section>
  </main>

  <?php include 'includes/footer.php'; ?>
</body>
</html>
