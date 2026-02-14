<?php require_once 'includes/init.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php 
    $page_title = "About Us | " . $site_name . " - International Recruitment";
    $meta_desc = "Learn about TransAsia Integrate Service Ltd - Bangladesh's trusted government-licensed recruitment agency. Our mission, vision, values, and commitment to ethical recruitment.";
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
    $active_page = 'about'; 
    include 'includes/header.php'; 
  ?>

  <main>
    <!-- Page Header -->
    <section class="page-header" aria-label="Page header">
      <div class="page-header-bg" style="background-image: url('<?php echo get_setting('about_header_bg', 'images/about-header.jpg'); ?>');"></div>
      <div class="page-header-overlay"></div>
      <div class="container">
        <h1 data-aos="fade-up">About TransAsia</h1>
        <nav class="breadcrumb" aria-label="Breadcrumb" data-aos="fade-up" data-aos-delay="100">
          <a href="index.php">Home</a>
          <i class="fas fa-chevron-right"></i>
          <span>About Us</span>
        </nav>
      </div>
    </section>

    <!-- Company Story -->
    <section class="company-story" aria-labelledby="story-heading">
      <div class="container">
        <div class="two-column">
          <div class="column-content" data-aos="fade-right">
              <p>Trans Asia Integrate Services Ltd. is a trusted overseas recruiting agency dedicated to connecting global employers with skilled, reliable, and motivated manpower from Bangladesh. With a commitment to excellence and integrity, we specialize in providing end-to-end recruitment solutions that meet the dynamic needs of international markets across various industries.

Since our establishment, we have built a strong reputation for professionalism, transparency, and efficiency in manpower deployment. Our goal is to create sustainable employment opportunities for Bangladeshi workers while helping foreign employers achieve their workforce objectives seamlessly. Feel free to watch our profile for more details.

We believe that the success of any organization begins with its people. That’s why we focus on quality recruitment, ethical practices, and continuous improvement to ensure mutual growth, satisfaction, and long-term partnerships with our clients and candidates alike.</p>
            <div style="display: flex; gap: 15px; margin-top: 24px; flex-wrap: wrap;">
                <a href="contact.php" class="btn btn-primary">Get In Touch</a>
                <a href="uploads/company-profile.pdf" download class="btn btn-secondary">
                    <i class="fas fa-download" style="margin-right: 8px;"></i> Download Company Profile
                </a>
            </div>
          </div>
          <div class="column-image" data-aos="fade-left">
            <img src="<?php echo get_setting('about_story_image', 'images/office-team.jpg'); ?>" alt="TransAsia office and team" loading="lazy">
          </div>
        </div>
      </div>
    </section>

    <!-- Mission Vision Values -->
    <section class="bg-light" aria-labelledby="mvv-heading">
      <div class="container">
        <div class="section-header" data-aos="fade-up">
          <h2 id="mvv-heading">Our Mission, Vision & Values</h2>
          <p>The principles that guide everything we do</p>
        </div>
        <div class="mvv-grid">
          <div class="mvv-card" data-aos="fade-up" data-aos-delay="0">
            <div class="mvv-icon">
              <i class="fas fa-bullseye"></i>
            </div>
            <h3>Our Mission</h3>
            <p>To connect talent with opportunity through ethical, efficient, and innovative recruitment solutions. We
              are committed to empowering job seekers with fair access to global employment, supporting our clients with
              dependable and high-quality workforce solutions, and upholding the highest standards of professionalism,
              safety, and social responsibility in every placement we make.</p>
          </div>
          <div class="mvv-card" data-aos="fade-up" data-aos-delay="100">
            <div class="mvv-icon">
              <i class="fas fa-eye"></i>
            </div>
            <h3>Our Vision</h3>
            <p>To be a leading global recruitment agency recognized for excellence, integrity, and innovation —
              connecting skilled professionals across Asia and beyond, empowering people, and driving sustainable growth
              for clients and communities alike.</p>
          </div>
          <div class="mvv-card" data-aos="fade-up" data-aos-delay="200">
            <div class="mvv-icon">
              <i class="fas fa-heart"></i>
            </div>
            <h3>Our Core Values</h3>
            <p><strong>Integrity:</strong> Honesty and transparency in every aspect<br>
              <strong>Excellence:</strong> Delivering quality that exceeds expectations<br>
              <strong>Accountability:</strong> Taking ownership of our responsibilities<br>
              <strong>Respect:</strong> Treating everyone with dignity and fairness<br>
              <strong>Sustainability:</strong> Championing responsible practices<br>
              <strong>Collaboration:</strong> Building strong partnerships
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Compliance Section -->
    <section class="compliance-section" aria-labelledby="compliance-heading">
      <div class="container">
        <div class="section-header" data-aos="fade-up">
          <h2 id="compliance-heading">Certifications & Compliance</h2>
          <p>Our commitment to quality and ethical standards</p>
        </div>
        <div class="compliance-grid">
          <div class="compliance-item" data-aos="fade-up" data-aos-delay="0">
            <div class="compliance-badge">
              <i class="fas fa-certificate"></i>
            </div>
            <h3>Government License #1472</h3>
            <p>TransAsia Integrate Service Ltd holds a valid government-approved recruiting license (RL-1472) issued by
              the Bureau of Manpower, Employment and Training (BMET), Ministry of Expatriates' Welfare and Overseas
              Employment, Government of Bangladesh.</p>
          </div>
          <div class="compliance-item" data-aos="fade-up" data-aos-delay="100">
            <div class="compliance-badge">
              <i class="fas fa-award"></i>
            </div>
            <h3>ISO 9001:2015 Certified</h3>
            <p>We are proud to be ISO 9001:2015 certified, reflecting our commitment to delivering transparent,
              consistent, and high-quality recruitment services. This certification ensures that all aspects of our
              operations adhere to globally recognized best practices.</p>
          </div>
        </div>
        <div class="text-center mt-5" data-aos="fade-up">
          <div
            style="background: var(--bg-light); padding: 32px; border-radius: var(--border-radius); max-width: 800px; margin: 0 auto;">
            <i class="fas fa-hand-holding-heart"
              style="font-size: 48px; color: var(--accent-green); margin-bottom: 16px;"></i>
            <h3 style="margin-bottom: 16px;">Ethical Recruitment Policy</h3>
            <p>TransAsia is committed to ethical recruitment practices. We strictly adhere to a <strong>"No Worker
                Fees"</strong> policy, ensuring that job seekers are never charged for recruitment services. All costs
              are borne by the employing companies, in line with international labor standards and the ILO's definition
              of fair recruitment.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Why Bangladesh -->
    <section class="why-bangladesh" aria-labelledby="why-heading">
      <div class="container">
        <div class="two-column reverse">
          <div class="column-image" data-aos="fade-right">
            <img src="<?php echo get_setting('about_why_bd_image', 'images/bangladesh-workforce.jpg'); ?>" alt="Bangladesh skilled workforce" loading="lazy">
          </div>
          <div class="column-content" data-aos="fade-left">
            <h2 id="why-heading"></h2>
            <p>Trans Asia Integrate Services Ltd. handles the entire overseas recruitment process from start to finish. We don’t just send workers abroad—they screen, train, medically test, document, and support them every step of the way.
            </p>
            <ul style="list-style: none; padding: 0; margin: 24px 0;">
              <li style="padding: 12px 0; border-bottom: 1px solid var(--border-color);">
                <i class="fas fa-check-circle" style="color: var(--accent-green); margin-right: 12px;"></i>
                <strong>They recruit workers for many industries and skill levels.
              </li>
              <li style="padding: 12px 0; border-bottom: 1px solid var(--border-color);">
                <i class="fas fa-check-circle" style="color: var(--accent-green); margin-right: 12px;"></i>
                <strong>Every candidate is carefully selected, tested, trained, and medically cleared through their own centers.
              </li>
              <li style="padding: 12px 0; border-bottom: 1px solid var(--border-color);">
                <i class="fas fa-check-circle" style="color: var(--accent-green); margin-right: 12px;"></i>
                <strong>They handle all paperwork, visas, and government compliance.
              </li>
              <li style="padding: 12px 0; border-bottom: 1px solid var(--border-color);">
                <i class="fas fa-check-circle" style="color: var(--accent-green); margin-right: 12px;"></i>
                <strong>Workers are prepared for life and work abroad through orientation and counseling.
              </li>
              <li style="padding: 12px 0;">
                <i class="fas fa-check-circle" style="color: var(--accent-green); margin-right: 12px;"></i>
                <strong>They manage travel and deployment.
              </li>
<li style="padding: 12px 0;">
                <i class="fas fa-check-circle" style="color: var(--accent-green); margin-right: 12px;"></i>
                <strong>Even after workers are placed, the company continues support for both employers and employees.
              </li>
            </ul>
            <a href="services.php" class="btn btn-primary">Explore Our Services</a>
          </div>
        </div>
      </div>
    </section>

    <!-- Chairman Message -->
    <section class="chairman-message-section bg-light" aria-labelledby="chairman-heading">
      <div class="container">
        <div class="two-column" style="align-items: center; gap: 60px;">
          <!-- Left: Framed Image -->
          <div class="chairman-image-col" data-aos="fade-right">
            <div style="position: relative; padding: 20px;">
              <div style="position: absolute; top: 0; left: 0; width: 80%; height: 80%; border: 10px solid var(--admin-primary); border-bottom: none; border-right: none; z-index: 1;"></div>
              <div style="position: absolute; bottom: 0; right: 0; width: 80%; height: 80%; border: 10px solid var(--admin-primary); border-top: none; border-left: none; z-index: 1;"></div>
              <img src="<?php echo get_setting('chairman_image', 'images/chairman.jpg'); ?>" 
                   alt="Chairman of TransAsia" 
                   style="width: 100%; display: block; position: relative; z-index: 2; box-shadow: var(--shadow-lg); border-radius: 4px;">
              <div style="margin-top: 25px; text-align: center; position: relative; z-index: 2;">
                <h4 style="font-size: 24px; color: var(--primary-color); margin-bottom: 5px;">Chairman</h4>
                <p style="color: var(--text-muted); font-weight: 500; text-align: center;">Trans Asia Integrate Services Ltd.</p>
              </div>
            </div>
          </div>
          <!-- Right: Message Content -->
          <div class="chairman-content-col" data-aos="fade-left">
            <div class="section-header" style="text-align: left; margin-bottom: 30px;">
              <h2 id="chairman-heading" style="margin-bottom: 15px;">Message from the Chairman</h2>
              <div style="width: 60px; height: 4px; background: var(--admin-primary);"></div>
            </div>
            <div style="font-size: 18px; line-height: 1.8; color: var(--text-color); font-style: italic; position: relative; padding-left: 40px;">
              <i class="fas fa-quote-left" style="position: absolute; left: 0; top: 0; color: #e2e8f0; font-size: 32px;"></i>
              <?php echo nl2br(get_setting('chairman_message', 'Our commitment to excellence and integrity is at the core of everything we do. At Trans Asia Integrate Services Ltd., we bridge the gap between global opportunity and local talent, ensuring a future of mutual growth and prosperity.')); ?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Global Presence -->
    <section aria-labelledby="presence-heading">
      <div class="container">
        <div class="section-header" data-aos="fade-up">
          <h2 id="presence-heading">Our Global Presence</h2>
          <p>Serving clients and candidates across multiple continents</p>
        </div>
        <div class="value-cards">
          <?php
          // Fetch active offices from database
          $stmt = $pdo->query("SELECT * FROM global_offices WHERE is_active = 1 ORDER BY display_order ASC");
          $offices = $stmt->fetchAll();
          
          $delay = 0;
          foreach ($offices as $office):
          ?>
          <div class="value-card" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
            <div class="value-card-icon">
              <i class="<?php echo htmlspecialchars($office['icon']); ?>"></i>
            </div>
            <h3><?php echo htmlspecialchars($office['office_name']); ?></h3>
            <p><?php echo htmlspecialchars($office['address']); ?></p>
          </div>
          <?php 
          $delay += 100;
          endforeach; 
          ?>
        </div>
      </div>
    </section>

    <!-- Footer CTA -->
    <section class="footer-cta" aria-label="Call to action">
      <div class="container">
        <div data-aos="fade-up">
          <h2>Ready to Partner With Us?</h2>
          <p>Experience the TransAsia difference in international recruitment</p>
          <a href="contact.php" class="btn btn-white">Contact Us Today</a>
        </div>
      </div>
    </section>
  </main>

  <?php include 'includes/footer.php'; ?>
</body>
</html>
