<?php require_once 'includes/init.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php 
    $page_title = "Our Services | " . $site_name . " - International Recruitment Solutions";
    $meta_desc = "Comprehensive workforce solutions from TransAsia. Skilled technical workers, construction, hospitality, healthcare, and manufacturing recruitment services.";
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
    $active_page = 'services'; 
    include 'includes/header.php'; 
  ?>

  <main>
    <!-- Page Header -->
    <section class="page-header" aria-label="Page header">
      <div class="page-header-bg" style="background-image: url('<?php echo get_setting('services_header_bg', 'images/services-header.jpg'); ?>');"></div>
      <div class="page-header-overlay"></div>
      <div class="container">
        <h1 data-aos="fade-up" style="max-width: 900px;">One Stop Service: Your Gateway to Qualified Talent</h1>
        <nav class="breadcrumb" aria-label="Breadcrumb" data-aos="fade-up" data-aos-delay="100">
          <a href="index.php">Home</a>
          <i class="fas fa-chevron-right"></i>
          <span>One Stop Service</span>
        </nav>
      </div>
    </section>

    <!-- One Stop Service Intro -->
    <section aria-labelledby="one-stop-intro-heading" style="padding: 100px 0 40px;">
      <div class="container">
        <div class="section-header" data-aos="fade-up" style="max-width: 900px; margin: 0 auto 60px; text-align: center;">
          <h2 id="one-stop-intro-heading" style="font-size: 2.5rem; margin-bottom: 25px;">Your Trusted Gateway to Qualified Talent from Bangladesh</h2>
          <p style="font-size: 1.15rem; line-height: 1.8; color: var(--text-muted); max-width: 800px; margin: 0 auto;">Trans Asia Integrate Services Ltd. offers overseas employers a fully integrated recruitment solution from Bangladesh. As a recognized industry leader, we simplify the complex process of international hiring, ensuring you receive highly qualified, vetted, and job-ready personnel without the typical logistical challenges.</p>
        </div>

        <div class="value-cards" style="margin-top: 40px;">
          <div class="value-card service-feature-card" data-aos="fade-up" data-aos-delay="0">
            <div class="value-card-icon feature-icon-wrapper icon-blue" style="width: 80px; height: 80px; font-size: 32px; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
              <i class="fas fa-layer-group"></i>
            </div>
            <h3>Unified System</h3>
            <p>Three ISO-certified entities working as one to ensure compliance, excellence, and a trouble-free experience.</p>
          </div>
          <div class="value-card service-feature-card" data-aos="fade-up" data-aos-delay="200">
            <div class="value-card-icon feature-icon-wrapper icon-green" style="width: 80px; height: 80px; font-size: 32px; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
              <i class="fas fa-gauge-high"></i>
            </div>
            <h3>Reduced Delays</h3>
            <p>Integrated model ensures consistency and speed, reducing recruitment lead times significantly.</p>
          </div>
          <div class="value-card service-feature-card" data-aos="fade-up" data-aos-delay="400">
            <div class="value-card-icon feature-icon-wrapper icon-amber" style="width: 80px; height: 80px; font-size: 32px; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
              <i class="fas fa-award"></i>
            </div>
            <h3>International Standards</h3>
            <p>Every candidate meets the highest global standards before deployment through rigorous vetting.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Three Entities Section -->
    <section class="bg-light" aria-labelledby="process-heading">
      <div class="container">
        <div class="section-header" data-aos="fade-up">
          <h2 id="process-heading">The Seamless Process: Three Steps to Success</h2>
          <p>Our One Stop Service covers every critical stage of the hiring pipeline</p>
        </div>

        <div class="three-entities-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 30px; margin-top: 50px;">
          
          <!-- Entity 1: Trans Asia -->
          <div class="card" data-aos="fade-up" style="background: #fff; border-radius: 16px; box-shadow: var(--shadow-md); border: 1px solid var(--border-color); overflow: hidden; display: flex; flex-direction: column;">
            <div class="card-image" style="height: 200px; overflow: hidden;">
              <img src="images/office-team.jpg" alt="Trans Asia Office" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <div style="padding: 30px; display: flex; flex-direction: column; flex-grow: 1;">
              <h3 style="margin-bottom: 20px; font-size: 20px; font-weight: 700; color: var(--text-dark);">Trans Asia Integrate Services Ltd.</h3>
              <p style="color: var(--text-muted); line-height: 1.7; margin-bottom: 25px;">As a Government Approved Recruiting Agency and ISO Certified entity, we manage the entire recruitment lifecycle, handling all official clearances and documentation for final deployment.</p>
              <ul style="list-style: none; padding: 0; margin-bottom: 30px; flex-grow: 1;">
                  <li style="padding: 8px 0; font-size: 14px;"><i class="fas fa-check" style="color: #10b981; margin-right: 10px;"></i> Manpower Needs Analysis</li>
                  <li style="padding: 8px 0; font-size: 14px;"><i class="fas fa-check" style="color: #10b981; margin-right: 10px;"></i> Government Clearances</li>
                  <li style="padding: 8px 0; font-size: 14px;"><i class="fas fa-check" style="color: #10b981; margin-right: 10px;"></i> Employment Contracts</li>
              </ul>
              <a href="about.php" class="btn btn-primary btn-block" style="text-align: center;">Visit Now</a>
            </div>
          </div>

          <!-- Entity 2: Catharsis -->
          <div class="card" data-aos="fade-up" data-aos-delay="100" style="background: #fff; border-radius: 16px; box-shadow: var(--shadow-md); border: 1px solid var(--border-color); overflow: hidden; display: flex; flex-direction: column;">
            <div class="card-image" style="height: 200px; overflow: hidden;">
              <img src="images/training-facility.jpg" alt="Catharsis Training" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <div style="padding: 30px; display: flex; flex-direction: column; flex-grow: 1;">
              <h3 style="margin-bottom: 20px; font-size: 20px; font-weight: 700; color: var(--text-dark);">Catharsis Training & Testing Centre</h3>
              <p style="color: var(--text-muted); line-height: 1.7; margin-bottom: 25px;">Specializing in evaluating and preparing candidates through rigorous, job-specific skills testing. Our ISO Certification guarantees fair and standardized assessment.</p>
              <ul style="list-style: none; padding: 0; margin-bottom: 30px; flex-grow: 1;">
                  <li style="padding: 8px 0; font-size: 14px;"><i class="fas fa-check" style="color: #10b981; margin-right: 10px;"></i> Job-specific Skills Testing</li>
                  <li style="padding: 8px 0; font-size: 14px;"><i class="fas fa-check" style="color: #10b981; margin-right: 10px;"></i> Specialized Training</li>
                  <li style="padding: 8px 0; font-size: 14px;"><i class="fas fa-check" style="color: #10b981; margin-right: 10px;"></i> Competency Verification</li>
              </ul>
              <a href="https://www.catharsis.training" target="_blank" class="btn btn-outline-dark btn-block" style="text-align: center;">Visit Now</a>
            </div>
          </div>

          <!-- Entity 3: Surokkha -->
          <div class="card" data-aos="fade-up" data-aos-delay="200" style="background: #fff; border-radius: 16px; box-shadow: var(--shadow-md); border: 1px solid var(--border-color); overflow: hidden; display: flex; flex-direction: column;">
            <div class="card-image" style="height: 200px; overflow: hidden;">
              <img src="images/industry-healthcare.jpg" alt="Surokkha Medical" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <div style="padding: 30px; display: flex; flex-direction: column; flex-grow: 1;">
              <h3 style="margin-bottom: 20px; font-size: 20px; font-weight: 700; color: var(--text-dark);">Surokkha Medical Center Ltd.</h3>
              <p style="color: var(--text-muted); line-height: 1.7; margin-bottom: 25px;">Dedicated exclusively to health screening, providing thorough medical examinations. Formally GHC Approved and ISO Certified for quality management.</p>
              <ul style="list-style: none; padding: 0; margin-bottom: 30px; flex-grow: 1;">
                  <li style="padding: 8px 0; font-size: 14px;"><i class="fas fa-check" style="color: #10b981; margin-right: 10px;"></i> Global Health Compliance</li>
                  <li style="padding: 8px 0; font-size: 14px;"><i class="fas fa-check" style="color: #10b981; margin-right: 10px;"></i> Physical Fitness Vetting</li>
                  <li style="padding: 8px 0; font-size: 14px;"><i class="fas fa-check" style="color: #10b981; margin-right: 10px;"></i> Reliable Lab Reports</li>
              </ul>
              <a href="https://www.surokkha.org" target="_blank" class="btn btn-outline-dark btn-block" style="text-align: center;">Visit Now</a>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- Trans Asia Advantage -->
    <section aria-labelledby="advantage-heading" style="padding: 100px 0;">
      <div class="container">
        <div class="two-column" style="align-items: center; gap: 80px;">
            <div class="column-image" data-aos="fade-right">
                <img src="<?php echo get_setting('advantage_image', 'images/advantage-recruitment.jpg'); ?>" alt="Recruitment Advantage" style="border-radius: 24px; box-shadow: var(--shadow-lg);">
            </div>
            <div class="column-content" data-aos="fade-left">
                <h2 id="advantage-heading" style="margin-bottom: 30px;">The Trans Asia Advantage</h2>
                <div style="display: flex; flex-direction: column; gap: 30px;">
                    <div style="display: flex; gap: 20px;">
                        <i class="fas fa-circle-check" style="font-size: 24px; color: #10b981; margin-top: 5px;"></i>
                        <div>
                            <h4 style="font-size: 20px; margin-bottom: 8px;">Zero Trouble</h4>
                            <p style="color: var(--text-muted);">Eliminate the complexities of coordinating with multiple vendors, government agencies, and medical facilities. We handle it all.</p>
                        </div>
                    </div>
                    <div style="display: flex; gap: 20px;">
                        <i class="fas fa-circle-check" style="font-size: 24px; color: #10b981; margin-top: 5px;"></i>
                        <div>
                            <h4 style="font-size: 20px; margin-bottom: 8px;">Guaranteed Quality</h4>
                            <p style="color: var(--text-muted);">Benefit from candidates who are rigorously tested, medically cleared, and legally recruited under one certified system.</p>
                        </div>
                    </div>
                    <div style="display: flex; gap: 20px;">
                        <i class="fas fa-circle-check" style="font-size: 24px; color: #10b981; margin-top: 5px;"></i>
                        <div>
                            <h4 style="font-size: 20px; margin-bottom: 8px;">Reliable Compliance</h4>
                            <p style="color: var(--text-muted);">All processes are fully compliant with relevant government and international health (GHC) standards.</p>
                        </div>
                    </div>
                </div>
                <div style="margin-top: 50px;">
                    <p style="font-weight: 600; font-style: italic; color: var(--primary-color);">Trans Asia is your strategic partner for securing qualified, healthy, and job-ready talent from Bangladesh.</p>
                    <a href="contact.php" class="btn btn-primary mt-4">Partner With Us</a>
                </div>
            </div>
        </div>
      </div>
    </section>

    <!-- Footer CTA -->
    <section class="footer-cta" aria-label="Call to action">
      <div class="container">
        <div data-aos="fade-up">
          <h2>Ready to Experience Seamless Hiring?</h2>
          <p>Get in touch with our experts to start your recruitment journey</p>
          <a href="contact.php" class="btn btn-white">Contact Us Today</a>
        </div>
      </div>
    </section>
  </main>

  <?php include 'includes/footer.php'; ?>
</body>
</html>
