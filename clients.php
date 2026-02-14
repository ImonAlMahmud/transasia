<?php require_once 'includes/init.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php 
    $page_title = "Our Clients | " . $site_name . " - Trusted by Industry Leaders";
    $meta_desc = "TransAsia partners with leading companies across the Middle East and Southeast Asia. View our client portfolio, case studies, and testimonials.";
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
    $active_page = 'clients'; 
    include 'includes/header.php'; 
  ?>

  <main>
    <!-- Page Header -->
    <section class="page-header" aria-label="Page header">
      <div class="page-header-bg" style="background-image: url('<?php echo get_setting('clients_header_bg', 'images/clients-header.jpg'); ?>');"></div>
      <div class="page-header-overlay"></div>
      <div class="container">
        <h1 data-aos="fade-up">Our Clients</h1>
        <nav class="breadcrumb" aria-label="Breadcrumb" data-aos="fade-up" data-aos-delay="100">
          <a href="index.php">Home</a>
          <i class="fas fa-chevron-right"></i>
          <span>Clients</span>
        </nav>
      </div>
    </section>

    <!-- Clients Introduction -->
    <section aria-labelledby="clients-intro-heading" style="padding-bottom: 40px;">
      <div class="container">
        <div class="section-header" data-aos="fade-up" style="max-width: 100%; text-align: center;">
          <h2 id="clients-intro-heading">Trusted by Industry Leaders</h2>
          <p style="max-width: 1000px; margin: 0 auto; font-size: 18px; line-height: 1.8;">
            TransAsia Integrated Service Ltd stands as a premier recruitment partner for some of the most influential enterprises across the Middle East and Southeast Asia. With over a decade of experience in human resource management, we have built a reputation for excellence based on trust, integrity, and our unparalleled ability to source top-tier talent for complex, high-stakes projects. Our client portfolio spans critical global sectors including large-scale infrastructure construction, advanced healthcare systems, high-tech manufacturing, and international hospitality. By deeply understanding the unique operational demands and cultural nuances of each partner, we don't just provide personnel; we deliver comprehensive workforce solutions that integrate seamlessly into your company's mission and fuel sustainable growth on an international scale.
          </p>
        </div>
      </div>
    </section>

    <!-- Client Logo Grid -->
    <section class="bg-light" aria-labelledby="client-logos-heading">
      <div class="container">
        <div class="section-header" data-aos="fade-up">
          <h2 id="client-logos-heading">Our Client Portfolio</h2>
          <p>Filter by region to see our clients in your area</p>
        </div>

        <!-- Filter Buttons -->
        <div class="client-filter" data-aos="fade-up">
          <button class="filter-btn active" data-filter="all">All Clients</button>
          <button class="filter-btn" data-filter="middle-east">Middle East</button>
          <button class="filter-btn" data-filter="southeast-asia">Southeast Asia</button>
          <button class="filter-btn" data-filter="others">Others</button>
        </div>

        <!-- Client Grid -->
        <div class="client-grid" data-aos="fade-up">
          <!-- Luxbee -->
          <div class="client-grid-item" data-region="southeast-asia">
            <div class="client-card">
              <img src="images/clients/luxbee.png" alt="Luxbee" loading="lazy" onerror="this.onerror=null;this.src='https://placehold.co/140x60/ffffff/0056b3?text=Luxbee&font=montserrat';">
              <span class="client-name">Luxbee SDN BHD</span>
            </div>
          </div>
          <!-- Ginco -->
          <div class="client-grid-item" data-region="middle-east">
            <div class="client-card">
              <img src="images/clients/ginco.png" alt="Ginco" loading="lazy" onerror="this.onerror=null;this.src='https://placehold.co/140x60/ffffff/0056b3?text=Ginco&font=roboto';">
              <span class="client-name">Ginco Electro</span>
            </div>
          </div>
          <!-- E-Cast -->
          <div class="client-grid-item" data-region="middle-east">
            <div class="client-card">
              <img src="images/clients/ecast.png" alt="E-Cast" loading="lazy" onerror="this.onerror=null;this.src='https://placehold.co/180x80/ffffff/dc3545?text=E-CAST&font=montserrat';">
              <span class="client-name">E-Cast</span>
            </div>
          </div>
          <!-- Al Million -->
          <div class="client-grid-item" data-region="middle-east">
            <div class="client-card">
              <img src="images/clients/almillion.jpg" alt="Al Million services" loading="lazy" onerror="this.onerror=null;this.src='https://placehold.co/180x80/ffffff/28a745?text=Al+-+Million\nTransportation&font=roboto';">
              <span class="client-name">Al Million Services</span>
            </div>
          </div>
          <!-- Al Jaber -->
          <div class="client-grid-item" data-region="middle-east">
            <div class="client-card">
              <img src="images/clients/aljaber.png" alt="Aljaber" loading="lazy" onerror="this.onerror=null;this.src='https://placehold.co/140x60/ffffff/0056b3?text=Aljaber&font=raleway';">
              <span class="client-name">Al Jaber Transport</span>
            </div>
          </div>
          <!-- Retaj Hotels -->
          <div class="client-grid-item" data-region="middle-east">
            <div class="client-card">
              <img src="images/clients/retaj.png" alt="Retaj Hotels" loading="lazy" onerror="this.onerror=null;this.src='https://placehold.co/140x60/ffffff/0056b3?text=Retaj+Hotels&font=merriweather';">
              <span class="client-name">Retaj Hotels</span>
            </div>
          </div>
          <!-- Belhasa -->
          <div class="client-grid-item" data-region="middle-east">
            <div class="client-card">
              <img src="images/clients/belhasa.png" alt="Belhasa" loading="lazy" onerror="this.onerror=null;this.src='https://placehold.co/140x60/ffffff/0056b3?text=Belhasa&font=oswald';">
              <span class="client-name">Belhasa Engineering</span>
            </div>
          </div>
          <!-- BK Gulf -->
          <div class="client-grid-item" data-region="middle-east">
             <div class="client-card">
               <img src="images/clients/bkgulf.png" alt="BK Gulf LLC" loading="lazy" onerror="this.onerror=null;this.src='https://placehold.co/140x60/ffffff/0056b3?text=BK+Gulf&font=open-sans';">
               <span class="client-name">BK Gulf LLC</span>
             </div>
          </div>
          <!-- Top Glove -->
          <div class="client-grid-item" data-region="southeast-asia">
            <div class="client-card">
              <img src="images/clients/topglove.png" alt="Top Glove" loading="lazy" onerror="this.onerror=null;this.src='https://placehold.co/140x60/ffffff/0056b3?text=Top+Glove&font=open-sans';">
              <span class="client-name">Top Glove</span>
            </div>
          </div>
          <!-- Felcra -->
          <div class="client-grid-item" data-region="southeast-asia">
             <div class="client-card">
              <img src="images/clients/felcra.png" alt="Felcra" loading="lazy" onerror="this.onerror=null;this.src='https://placehold.co/140x60/ffffff/0056b3?text=Felcra&font=roboto';">
              <span class="client-name">Felcra Urus Estet</span>
             </div>
          </div>
          <!-- Sumer -->
          <div class="client-grid-item" data-region="middle-east">
             <div class="client-card">
              <img src="images/clients/sumer.png" alt="Sumer" loading="lazy" onerror="this.onerror=null;this.src='https://placehold.co/140x60/ffffff/0056b3?text=Sumer&font=roboto';">
              <span class="client-name">Sumer Contracting</span>
             </div>
          </div>
          <!-- Sanitart -->
          <div class="client-grid-item" data-region="southeast-asia">
             <div class="client-card">
              <img src="images/clients/sanitart.png" alt="Sanitart" loading="lazy" onerror="this.onerror=null;this.src='https://placehold.co/140x60/ffffff/0056b3?text=Sanitart&font=roboto';">
              <span class="client-name">Sanitart Systems</span>
             </div>
          </div>
        </div>
      </div>
    </section>


    <!-- Become a Client CTA -->
    <section aria-labelledby="become-client-heading">
      <div class="container">
        <div class="two-column">
          <div class="column-content" data-aos="fade-right">
            <h2 id="become-client-heading">Become a Client</h2>
            <p>Join the growing list of companies that trust TransAsia for their workforce needs. Fill out the form and
              our team will get in touch within 24 hours.</p>
            <ul style="list-style: none; padding: 0; margin: 24px 0;">
              <li style="padding: 12px 0;">
                <i class="fas fa-check-circle" style="color: var(--accent-green); margin-right: 12px;"></i>
                Dedicated account manager
              </li>
              <li style="padding: 12px 0;">
                <i class="fas fa-check-circle" style="color: var(--accent-green); margin-right: 12px;"></i>
                Customized recruitment solutions
              </li>
              <li style="padding: 12px 0;">
                <i class="fas fa-check-circle" style="color: var(--accent-green); margin-right: 12px;"></i>
                24/7 support throughout the process
              </li>
              <li style="padding: 12px 0;">
                <i class="fas fa-check-circle" style="color: var(--accent-green); margin-right: 12px;"></i>
                Post-placement follow-up
              </li>
            </ul>
          </div>
          <div class="column-image" data-aos="fade-left">
            <div class="contact-form">
              <form action="https://formspree.io/f/YOUR_FORM_ID" method="POST" data-validate>
                <div class="form-group">
                  <label for="company-name">Company Name *</label>
                  <input type="text" id="company-name" name="company_name" required>
                </div>
                <div class="form-group">
                  <label for="contact-person">Contact Person *</label>
                  <input type="text" id="contact-person" name="contact_person" required>
                </div>
                <div class="form-group">
                  <label for="email">Email Address *</label>
                  <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                  <label for="industry">Industry *</label>
                  <select id="industry" name="industry" required>
                    <option value="">Select Industry</option>
                    <option value="construction">Construction</option>
                    <option value="oil-gas">Oil & Gas</option>
                    <option value="healthcare">Healthcare</option>
                    <option value="hospitality">Hospitality</option>
                    <option value="manufacturing">Manufacturing</option>
                    <option value="other">Other</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="requirements">Workforce Requirements</label>
                  <textarea id="requirements" name="requirements"
                    placeholder="Tell us about your workforce needs..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Submit Inquiry</button>
              </form>
            </div>
          </div>
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
