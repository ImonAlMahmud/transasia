  <!-- Footer -->
  <footer class="footer" role="contentinfo">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-about">
          <div class="footer-logo">
            <img src="images/logo.png" alt="<?php echo htmlspecialchars(get_setting('site_name')); ?> Logo" height="40">
          </div>
          <p><?php echo htmlspecialchars(get_setting('site_description')); ?></p>
          <div class="social-links">
            <?php if ($linkedin = get_setting('linkedin_url')): ?>
              <a href="<?php echo htmlspecialchars($linkedin); ?>" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            <?php endif; ?>
            <?php if ($facebook = get_setting('facebook_url')): ?>
              <a href="<?php echo htmlspecialchars($facebook); ?>" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            <?php endif; ?>
            <?php if ($whatsapp = get_setting('whatsapp_number')): ?>
              <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $whatsapp); ?>" target="_blank" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
            <?php endif; ?>
          </div>
        </div>
        <div class="footer-links-column">
          <h4>Quick Links</h4>
          <ul class="footer-links">
            <li><a href="about.php">About Us</a></li>
            <li><a href="services.php">Our Services</a></li>
            <li><a href="industries.php">Industries</a></li>
            <li><a href="clients.php">Clients</a></li>
            <li><a href="contact.php">Contact</a></li>
          </ul>
        </div>
        <div class="footer-links-column">
          <h4>Services</h4>
          <ul class="footer-links">
            <li><a href="services.php">Overseas Recruitment</a></li>
            <li><a href="services.php">Skill Assessment</a></li>
            <li><a href="services.php">Medical Screening</a></li>
            <li><a href="services.php">Documentation</a></li>
            <li><a href="services.php">Training</a></li>
          </ul>
        </div>
        <div class="footer-contact">
          <h4>Contact Info</h4>
          <?php if ($address = get_setting('site_address')): ?>
            <p><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($address); ?></p>
          <?php endif; ?>
          
          <?php if ($phone = get_setting('support_phone')): ?>
            <p><i class="fas fa-phone"></i> <a href="tel:<?php echo htmlspecialchars($phone); ?>"><?php echo htmlspecialchars($phone); ?></a></p>
          <?php endif; ?>
          
          <?php if ($email = get_setting('primary_email')): ?>
            <p><i class="fas fa-envelope"></i> <a href="mailto:<?php echo htmlspecialchars($email); ?>"><?php echo htmlspecialchars($email); ?></a></p>
          <?php endif; ?>
          
          <?php if ($hours = get_setting('office_hours')): ?>
            <p><i class="fas fa-clock"></i> <?php echo htmlspecialchars($hours); ?></p>
          <?php endif; ?>
        </div>
      </div>
      <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars(get_setting('site_name')); ?>. All rights reserved.</p>
        <div class="footer-bottom-links">
          <a href="#">Privacy Policy</a>
          <a href="#">Terms of Service</a>
          <a href="#">Recruitment Policy</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Back to Top with Progress -->
  <button class="back-to-top" aria-label="Back to top">
    <svg class="progress-ring" width="60" height="60">
      <circle class="progress-ring-circle" stroke="#e5e7eb" stroke-width="4" fill="transparent" r="25" cx="30" cy="30"/>
      <circle class="progress-ring-progress" stroke="#0056b3" stroke-width="4" fill="transparent" r="25" cx="30" cy="30"/>
    </svg>
    <i class="fas fa-arrow-up"></i>
  </button>

  <!-- Scripts -->
  <script src="js/main.js"></script>
