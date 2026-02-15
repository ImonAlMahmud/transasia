<?php
/**
 * Shared Header Template
 * $active_page variable should be set before including this file
 */
require_once 'includes/db.php';
require_once 'includes/functions.php';

$site_name = get_setting('site_name', 'TransAsia Integrate Service Ltd');
?>
  <!-- Navigation -->
  <nav class="navbar" role="navigation" aria-label="Main navigation">
    <div class="container">
      <a href="index.php" class="logo" aria-label="<?php echo htmlspecialchars($site_name); ?> Home">
        <img src="images/logo.png" alt="<?php echo htmlspecialchars($site_name); ?> Logo" height="48">
      </a>
      
      <ul class="nav-menu">
        <li><a href="about.php" class="<?php echo ($active_page == 'about') ? 'active' : ''; ?>">About</a></li>
        <li><a href="services.php" class="<?php echo ($active_page == 'services') ? 'active' : ''; ?>">Services</a></li>
        <li><a href="recruitmentprocess.php" class="<?php echo ($active_page == 'recruitment') ? 'active' : ''; ?>">Recruitment Process</a></li>
        <li><a href="industries.php" class="<?php echo ($active_page == 'industries') ? 'active' : ''; ?>">Industries</a></li>
        <li><a href="clients.php" class="<?php echo ($active_page == 'clients') ? 'active' : ''; ?>">Clients</a></li>
      </ul>
      
      <a href="contact.php" class="btn btn-primary btn-sm">Contact Us</a>
      
      <button class="mobile-menu-btn" aria-label="Open menu" aria-expanded="false">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>
  </nav>
  
  <!-- Mobile Menu -->
  <div class="mobile-menu-overlay"></div>
  <div class="mobile-menu">
    <button class="mobile-menu-close" aria-label="Close menu">
      <i class="fas fa-times"></i>
    </button>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="about.php">About</a></li>
      <li><a href="services.php">Services</a></li>
      <li><a href="recruitmentprocess.php">Recruitment Process</a></li>
      <li><a href="industries.php">Industries</a></li>
      <li><a href="clients.php">Clients</a></li>
    </ul>
    <a href="contact.php" class="btn btn-primary">Contact Us</a>
  </div>
