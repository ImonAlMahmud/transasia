<?php require_once 'includes/init.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php 
    $page_title = "Contact Us | " . $site_name . " - International Recruitment Agency";
    $meta_desc = "Contact TransAsia Integrate Service Ltd. Get in touch for workforce solutions, partnership inquiries, or career opportunities. Offices in Bangladesh, UAE, and Nepal.";
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
    $active_page = 'contact'; 
    include 'includes/header.php'; 
  ?>

  <main>
    <!-- Page Header -->
    <section class="page-header" aria-label="Page header">
      <div class="page-header-bg" style="background-image: url('<?php echo get_setting('contact_header_bg', 'images/contact-header.jpg'); ?>');"></div>
      <div class="page-header-overlay"></div>
      <div class="container">
        <h1 data-aos="fade-up">Contact Us</h1>
        <nav class="breadcrumb" aria-label="Breadcrumb" data-aos="fade-up" data-aos-delay="100">
          <a href="index.php">Home</a>
          <i class="fas fa-chevron-right"></i>
          <span>Contact</span>
        </nav>
      </div>
    </section>

    <!-- Contact Section -->
    <section aria-labelledby="contact-heading">
      <div class="container">
        <div class="section-header" data-aos="fade-up">
          <h2 id="contact-heading">Get In Touch</h2>
          <p>We're here to help and answer any questions you might have. Whether you're an employer looking for talent
            or a job seeker exploring opportunities, reach out to us.</p>
        </div>

        <?php if (isset($_GET['status'])): ?>
          <?php if ($_GET['status'] === 'success'): ?>
            <div style="background: #dcfce7; color: #166534; padding: 20px; border-radius: 12px; margin-bottom: 40px; border: 1px solid #bbf7d0; text-align: center; display: flex; flex-direction: column; align-items: center;" data-aos="fade-up">
              <i class="fas fa-check-circle" style="font-size: 24px; margin-bottom: 10px;"></i>
              <strong style="font-size: 18px; margin-bottom: 5px;">Message Sent Successfully!</strong>
              <p style="margin: 0; font-size: 15px;">Thank you for reaching out. Our team will get back to you shortly.</p>
            </div>
          <?php elseif ($_GET['status'] === 'error'): ?>
            <div style="background: #fee2e2; color: #991b1b; padding: 20px; border-radius: 12px; margin-bottom: 40px; border: 1px solid #fecaca; text-align: center; display: flex; flex-direction: column; align-items: center;" data-aos="fade-up">
              <i class="fas fa-exclamation-circle" style="font-size: 24px; margin-bottom: 10px;"></i>
              <strong style="font-size: 18px; margin-bottom: 5px;">Submission Failed</strong>
              <p style="margin: 0; font-size: 15px;"><?php echo htmlspecialchars($_GET['msg'] ?? 'An error occurred. Please try again later.'); ?></p>
            </div>
          <?php endif; ?>
        <?php endif; ?>

        <div class="two-column" style="align-items: flex-start;">
          <!-- Contact Form -->
          <div data-aos="fade-right">
            <div class="contact-form">
              <div class="form-toggle">
                <button class="toggle-btn active" data-type="employer">I am an Employer</button>
                <button class="toggle-btn" data-type="jobseeker">I am a Job Seeker</button>
              </div>

              <form id="contactForm" action="process_contact.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
                <div class="form-group">
                  <label for="name">Full Name *</label>
                  <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group company-field">
                  <label for="company">Company Name *</label>
                  <input type="text" id="company" name="company" required>
                </div>

                <div class="form-group">
                  <label for="email">Email Address *</label>
                  <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                  <label for="phone">Phone Number *</label>
                  <input type="tel" id="phone" name="phone" required>
                </div>

                <div class="form-group">
                  <label for="country">Country *</label>
                  <select id="country" name="country" required>
                    <option value="">Select Country</option>
                    <option value="Bangladesh">Bangladesh</option>
                    <option value="UAE">United Arab Emirates</option>
                    <option value="Saudi Arabia">Saudi Arabia</option>
                    <option value="Qatar">Qatar</option>
                    <option value="Kuwait">Kuwait</option>
                    <option value="Malaysia">Malaysia</option>
                    <option value="Singapore">Singapore</option>
                    <option value="Other">Other</option>
                  </select>
                </div>

                <!-- CV Upload Field (Hidden by default, shown for job seekers) -->
                <div class="form-group cv-field" style="display: none;">
                  <label for="cv">Upload CV (PDF only) *</label>
                  <div style="position: relative;">
                    <input type="file" id="cv" name="cv" accept=".pdf" style="padding-top: 10px;">
                    <small style="display: block; margin-top: 5px; color: #666;">Maximum size: 5MB</small>
                  </div>
                </div>

                <div class="form-group">
                  <label for="message">Message *</label>
                  <textarea id="message" name="message" placeholder="How can we help you?" required></textarea>
                </div>
                
                <input type="hidden" name="form_type" id="form-type-hidden" value="employer">
                <input type="hidden" name="subject" value="Website Inquiry">

                <button type="submit" class="btn btn-primary" style="width: 100%;">Send Message</button>
              </form>

              <script>
                document.addEventListener('DOMContentLoaded', function() {
                  const toggleBtns = document.querySelectorAll('.toggle-btn');
                  const formTypeHidden = document.getElementById('form-type-hidden');
                  const companyField = document.querySelector('.company-field');
                  const companyInput = document.getElementById('company');
                  const cvField = document.querySelector('.cv-field');
                  const cvInput = document.getElementById('cv');

                  toggleBtns.forEach(btn => {
                    btn.addEventListener('click', () => {
                      toggleBtns.forEach(b => b.classList.remove('active'));
                      btn.classList.add('active');
                      const type = btn.getAttribute('data-type');
                      formTypeHidden.value = type;

                      if (type === 'jobseeker') {
                        companyField.style.display = 'none';
                        companyInput.required = false;
                        cvField.style.display = 'block';
                        cvInput.required = true;
                      } else {
                        companyField.style.display = 'block';
                        companyInput.required = true;
                        cvField.style.display = 'none';
                        cvInput.required = false;
                      }
                    });
                  });
                });
              </script>
            </div>
          </div>

          <!-- Contact Info -->
          <div data-aos="fade-left">
            <div class="contact-info-card">
              <h3>Contact Information</h3>

              <?php if ($address = get_setting('site_address')): ?>
              <div class="contact-info-item">
                <i class="fas fa-map-marker-alt"></i>
                <div>
                  <h4>Bangladesh Office (Headquarters)</h4>
                  <p><?php echo htmlspecialchars($address); ?></p>
                </div>
              </div>
              <?php endif; ?>

              <?php if ($phone = get_setting('support_phone')): ?>
              <div class="contact-info-item">
                <i class="fas fa-phone"></i>
                <div>
                  <h4>Phone</h4>
                  <p><a href="tel:<?php echo htmlspecialchars($phone); ?>"><?php echo htmlspecialchars($phone); ?></a></p>
                </div>
              </div>
              <?php endif; ?>

              <?php if ($email = get_setting('primary_email')): ?>
              <div class="contact-info-item">
                <i class="fas fa-envelope"></i>
                <div>
                  <h4>Email</h4>
                  <p><a href="mailto:<?php echo htmlspecialchars($email); ?>"><?php echo htmlspecialchars($email); ?></a></p>
                </div>
              </div>
              <?php endif; ?>

              <?php if ($hours = get_setting('office_hours')): ?>
              <div class="contact-info-item">
                <i class="fas fa-clock"></i>
                <div>
                  <h4>Working Hours</h4>
                  <p><?php echo htmlspecialchars($hours); ?></p>
                </div>
              </div>
              <?php endif; ?>

              <?php if ($whatsapp = get_setting('whatsapp_number')): ?>
              <div class="contact-info-item">
                <i class="fab fa-whatsapp"></i>
                <div>
                  <h4>WhatsApp Business</h4>
                  <p><a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $whatsapp); ?>" target="_blank">Chat with us on WhatsApp</a></p>
                </div>
              </div>
              <?php endif; ?>

              <div class="map-container">
                <iframe
                  src="<?php echo get_setting('map_embed_url', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.328233234234!2d90.4242!3d23.8103!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjPCsDQ4JzM3LjEiTiA5MMKwMjUnMjcuMSJF!5e0!3m2!1sen!2sbd!4v1234567890'); ?>"
                  allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                  title="TransAsia Office Location">
                </iframe>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Global Offices -->
    <section class="bg-light" aria-labelledby="offices-heading">
      <div class="container">
        <div class="section-header" data-aos="fade-up">
          <h2 id="offices-heading">Our Global Offices</h2>
          <p>Serving clients and candidates across multiple continents</p>
        </div>
        <div class="value-cards">
          <div class="value-card" data-aos="fade-up" data-aos-delay="0">
            <div class="value-card-icon">
              <i class="fas fa-building"></i>
            </div>
            <h3>Bangladesh</h3>
            <p><strong>Headquarters</strong></p>
            <?php if ($address = get_setting('site_address')): ?>
              <p><?php echo htmlspecialchars($address); ?></p>
            <?php endif; ?>
            <?php if ($phone = get_setting('support_phone')): ?>
              <p style="margin-top: 16px;"><i class="fas fa-phone" style="margin-right: 8px;"></i> <?php echo htmlspecialchars($phone); ?></p>
            <?php endif; ?>
          </div>
          <div class="value-card" data-aos="fade-up" data-aos-delay="100">
            <div class="value-card-icon">
              <i class="fas fa-building"></i>
            </div>
            <h3>United Arab Emirates</h3>
            <p><strong>Dubai Office</strong></p>
            <p>2303, The Binary by Omniyat, Al Abraj Street, Business Bay, Dubai</p>
            <p style="margin-top: 16px;"><i class="fas fa-phone" style="margin-right: 8px;"></i> +971 X XXX XXXX</p>
          </div>
          <div class="value-card" data-aos="fade-up" data-aos-delay="200">
            <div class="value-card-icon">
              <i class="fas fa-building"></i>
            </div>
            <h3>Nepal</h3>
            <p><strong>Kathmandu Office</strong></p>
            <p>Shiva Mandir, Tokha 09, Gongabu 44600, Kathmandu, Bagmati</p>
            <p style="margin-top: 16px;"><i class="fas fa-phone" style="margin-right: 8px;"></i> +977 X XXXX XXXX</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Grievance Section -->
    <section aria-labelledby="grievance-heading">
      <div class="container">
        <div class="grievance-box" data-aos="fade-up">
          <h3 id="grievance-heading"><i class="fas fa-exclamation-triangle"></i> Submit a Complaint or Grievance</h3>
          <p>At TransAsia, we are committed to ethical recruitment practices and the welfare of all workers. If you have
            any complaints or concerns, we encourage you to report them.</p>
          <p><strong>Anonymous reporting option available.</strong> Your identity will be kept confidential if you
            choose to remain anonymous.</p>
          <p style="margin-bottom: 0;">
            <i class="fas fa-envelope" style="margin-right: 8px;"></i>
            Direct email: <a href="mailto:grievance@transasia.ltd">grievance@transasia.ltd</a>
          </p>
          <p style="margin-top: 8px; margin-bottom: 0;">
            <i class="fas fa-clock" style="margin-right: 8px;"></i>
            <strong>SLA:</strong> We respond to all grievances within 48 hours
          </p>
        </div>
      </div>
    </section>

    <!-- Quick Links -->
    <section class="bg-light" aria-labelledby="quicklinks-heading">
      <div class="container">
        <div class="section-header" data-aos="fade-up">
          <h2 id="quicklinks-heading">Quick Links</h2>
          <p>Additional resources and information</p>
        </div>
        <div class="value-cards" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 32px;">
          <?php 
          $quick_links_json = get_setting('quick_links', '[]');
          $quick_links = json_decode($quick_links_json, true) ?: [];
          
          if (empty($quick_links)): ?>
            <div style="grid-column: 1/-1; text-align: center; padding: 40px; background: #fff; border-radius: 12px; border: 1px dashed #ddd; color: #888;">
              <p style="margin: 0;">No quick links available at the moment.</p>
            </div>
          <?php else:
            foreach ($quick_links as $index => $link):
              $title = $link['title'] ?? 'Link';
              $desc = $link['desc'] ?? '';
              $url = $link['url'] ?? '#';
              $icon = $link['icon'] ?? 'fas fa-link';
              
              // Smart button text
              $btn_text = 'View Details';
              if (strpos(strtolower($url), '.pdf') !== false) {
                  $btn_text = 'Download Document';
              } elseif (strpos(strtolower($url), '.php') !== false || strpos($url, 'http') === 0) {
                  $btn_text = 'Visit Page';
              }
          ?>
          <div class="value-card" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
            <div class="value-card-icon">
              <i class="<?php echo htmlspecialchars($icon); ?>"></i>
            </div>
            <h3><?php echo htmlspecialchars($title); ?></h3>
            <p><?php echo htmlspecialchars($desc); ?></p>
            <a href="<?php echo htmlspecialchars($url); ?>" class="btn btn-outline-dark btn-sm mt-4"><?php echo $btn_text; ?></a>
          </div>
          <?php endforeach; endif; ?>
        </div>
      </div>
    </section>

    <!-- Footer CTA -->
    <section class="footer-cta" aria-label="Call to action">
      <div class="container">
        <div data-aos="fade-up">
          <h2>Let's Start a Conversation</h2>
          <p>We're ready to help you with your workforce needs</p>
          <?php if ($phone = get_setting('support_phone')): ?>
          <a href="tel:<?php echo htmlspecialchars($phone); ?>" class="btn btn-white"><i class="fas fa-phone" style="margin-right: 8px;"></i>
            Call Us Now</a>
          <?php endif; ?>
        </div>
      </div>
    </section>
  </main>

  <?php include 'includes/footer.php'; ?>
</body>
</html>
