<?php require_once 'includes/init.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php 
    $page_title = $site_name . " - International Recruitment | Government Licensed Manpower Agency Bangladesh";
    $meta_desc = "TransAsia Integrate Service Ltd - Bangladesh's premier government-licensed (RL-1472) international recruitment agency. ISO 9001:2015 certified. Connecting global employers with verified skilled talent.";
    include 'includes/meta-tags.php'; 
  ?>

  <!-- Favicon -->
  <link rel="icon" type="image/svg+xml" href="assets/favicon.svg">
  <link rel="apple-touch-icon" href="assets/apple-touch-icon.png">

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

  <!-- Schema.org JSON-LD -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "TransAsia Integrate Service Ltd",
    "alternateName": "TransAsia",
    "url": "https://transasia.ltd",
    "logo": "https://transasia.ltd/images/logo.png",
    "description": "Government-licensed international recruitment agency based in Bangladesh",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "2185/A, Block-I (Extension), Bashundhara C/A, Madani Avenue",
      "addressLocality": "Dhaka",
      "postalCode": "1229",
      "addressCountry": "BD"
    },
    "contactPoint": {
      "@type": "ContactPoint",
      <?php if ($phone = get_setting('support_phone')): ?>
      "telephone": "<?php echo htmlspecialchars($phone); ?>",
      <?php endif; ?>
      "contactType": "customer service",
      <?php if ($email = get_setting('primary_email')): ?>
      "email": "<?php echo htmlspecialchars($email); ?>"
      <?php endif; ?>
    },
    "sameAs": [
      "https://www.facebook.com/transasia",
      "https://www.linkedin.com/company/transasia"
    ]
  }
  </script>
</head>

<body>
  <?php 
    $active_page = 'home'; 
    include 'includes/header.php'; 
  ?>

  <main>
    <!-- Hero Section -->
    <!-- Hero Section -->
    <?php
    $show_hero_video = get_setting('company_video_in_hero') == '1';
    // Re-fetch video settings for Hero usage
    $hero_video_url = get_setting('company_video_url');
    $hero_video_autoplay = get_setting('company_video_autoplay') == '1';
    $hero_video_start = intval(get_setting('company_video_start_time', 0));
    $hero_video_thumb = get_setting('company_video_thumbnail');

    // Helper to generate embed URL (Simplified for hero)
    $hero_embed_src = '';
    $hero_autoplay_src = '';
    
    if ($show_hero_video && $hero_video_url) {
        if (strpos($hero_video_url, 'youtube.com') !== false || strpos($hero_video_url, 'youtu.be') !== false) {
            preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $hero_video_url, $matches);
            $yt_id = $matches[1] ?? '';
            if ($yt_id) {
                $params = [];
                if ($hero_video_start > 0) $params[] = 'start=' . $hero_video_start;
                $base = "https://www.youtube.com/embed/$yt_id?" . implode('&', $params);
                $hero_embed_src = $base;
                $hero_autoplay_src = $base . ($params ? '&' : '') . 'autoplay=1&mute=1';
            }
        } elseif (strpos($hero_video_url, 'vimeo.com') !== false) {
             preg_match('/vimeo\.com\/(\d+)/', $hero_video_url, $matches);
             $vid = $matches[1] ?? '';
             if ($vid) {
                  $fragment = ($hero_video_start > 0) ? "#t={$hero_video_start}s" : "";
                  $hero_embed_src = "https://player.vimeo.com/video/$vid$fragment";
                  $hero_autoplay_src = "https://player.vimeo.com/video/$vid?autoplay=1&muted=1" . $fragment;
             }
        } else {
             if (!empty($hero_video_url)) {
                 $hero_embed_src = $hero_video_url;
                 $sep = (strpos($hero_video_url, '?') === false) ? '?' : '&';
                 $hero_autoplay_src = $hero_video_url . $sep . 'autoplay=true';
             }
        }
    }
    ?>

    <section class="hero <?php echo $show_hero_video ? 'hero-with-video' : ''; ?>" aria-label="Hero">
      <div class="hero-bg" style="background-image: url('<?php echo get_setting('home_hero_bg', 'images/hero-bg.jpg'); ?>');"></div>
      <div class="hero-overlay"></div>
      
      <div class="container" style="position: relative; z-index: 2; height: 100%; display: flex; align-items: center;">
          <?php if ($show_hero_video): ?>
            <!-- Split Layout: Video Left, Text Right -->
            <div class="hero-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center; width: 100%;">
                
                <!-- Video Column (Left) -->
                <div class="hero-video-col" data-aos="fade-right">
                     <div class="video-container" id="hero-video-wrapper" style="border-radius: 20px; overflow: hidden; box-shadow: 0 20px 50px rgba(0,0,0,0.3); background: #000; aspect-ratio: 16/9; position: relative;">
                        <!-- Thumbnail Overlay -->
                        <?php if ($hero_video_thumb): ?>
                        <div id="hero-video-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 2; background-color: #000; transition: opacity 0.5s ease; cursor: pointer;">
                            <img src="<?php echo htmlspecialchars($hero_video_thumb); ?>" alt="Video Thumbnail" style="width: 100%; height: 100%; object-fit: cover; opacity: 0.8;">
                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 70px; height: 70px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(5px);">
                                <i class="fas fa-play" style="font-size: 24px; color: white; margin-left: 4px;"></i>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if ($hero_embed_src): ?>
                            <iframe id="hero-video-frame" 
                                    src="<?php echo htmlspecialchars($hero_embed_src); ?>" 
                                    data-autoplay-src="<?php echo htmlspecialchars($hero_autoplay_src); ?>"
                                    title="Company Overview" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                    allowfullscreen 
                                    style="width: 100%; height: 100%; position: relative; z-index: 1;">
                            </iframe>
                            <script>
                              document.addEventListener('DOMContentLoaded', function() {
                                  const heroFrame = document.getElementById('hero-video-frame');
                                  const heroWrapper = document.getElementById('hero-video-wrapper');
                                  const heroOverlay = document.getElementById('hero-video-overlay');
                                  
                                  // Click to play
                                  if (heroOverlay) {
                                      heroOverlay.addEventListener('click', function() {
                                          if (heroFrame) {
                                              const autoSrc = heroFrame.getAttribute('data-autoplay-src');
                                              heroFrame.src = autoSrc ? autoSrc : heroFrame.src + (heroFrame.src.indexOf('?')===-1?'?':'&')+'autoplay=1';
                                          }
                                          heroOverlay.style.opacity = '0';
                                          setTimeout(() => { heroOverlay.style.display = 'none'; }, 500);
                                      });
                                  }
                              });
                            </script>
                        <?php else: ?>
                            <div style="height: 100%; display: flex; align-items: center; justify-content: center; background: #222; color: #fff;">Video not configured</div>
                        <?php endif; ?>
                     </div>
                </div>

                <!-- Text Column (Right) -->
                <div class="hero-content text-left" data-aos="fade-left" style="text-align: left; padding-left: 20px;">
                    <h1 style="font-size: 3rem; line-height: 1.2; margin-bottom: 20px;">Bangladesh's Premier International Recruitment Partner</h1>
                    <p class="hero-subtitle" style="display: flex; flex-direction: column; gap: 10px; align-items: flex-start;">
                      <span><i class="fas fa-certificate"></i> Government Licensed (RL-1472)</span>
                      <span><i class="fas fa-award"></i> ISO 9001:2015 Certified</span>
                      <span><i class="fas fa-users"></i> Connecting Global Employers with Verified Skilled Talent</span>
                    </p>
                    <div class="hero-buttons" style="justify-content: flex-start; margin-top: 30px;">
                      <a href="contact.php" class="btn btn-primary">Contact Us</a>
                      <a href="services.php" class="btn btn-outline">Explore Services</a>
                    </div>
                </div>

            </div>
          <?php else: ?>
            <!-- Original Centered Layout -->
            <div class="hero-content" data-aos="fade-up" style="margin: 0 auto; text-align: center;">
                <h1>Bangladesh's Premier International Recruitment Partner</h1>
                <p class="hero-subtitle">
                  <span><i class="fas fa-certificate"></i> Government Licensed (RL-1472)</span>
                  <span class="divider"></span>
                  <span><i class="fas fa-award"></i> ISO 9001:2015 Certified</span>
                  <span class="divider"></span>
                  <span><i class="fas fa-users"></i> Connecting Global Employers with Verified Skilled Talent</span>
                </p>
                <div class="hero-buttons">
                  <a href="contact.php" class="btn btn-primary">Contact Us</a>
                  <a href="services.php" class="btn btn-outline">Explore Services</a>
                </div>
            </div>
          <?php endif; ?>
      </div>

      <div class="scroll-indicator">
        <i class="fas fa-chevron-down"></i>
      </div>
    </section>

    <!-- Trust Bar -->
    <section class="trust-bar" aria-label="Trust badges">
      <div class="container">
        <div class="trust-items">
          <div class="trust-item" data-aos="fade-up" data-aos-delay="0">
            <i class="fas fa-certificate"></i>
            <h4>License #1472</h4>
            <p>Government Approved</p>
          </div>
          <div class="trust-item" data-aos="fade-up" data-aos-delay="100">
            <i class="fas fa-award"></i>
            <h4>ISO 9001:2015</h4>
            <p>Quality Certified</p>
          </div>
          <div class="trust-item" data-aos="fade-up" data-aos-delay="200">
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h4>Google 5.0 Reviews</h4>
            <p>Client Satisfaction</p>
          </div>
          <div class="trust-item" data-aos="fade-up" data-aos-delay="300">
            <i class="fas fa-calendar-alt"></i>
            <h4>10+ Years</h4>
            <p>Industry Excellence</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Value Proposition -->
    <section class="value-proposition" aria-labelledby="value-heading">
      <div class="container">
        <div class="section-header" data-aos="fade-up">
          <h2 id="value-heading">Why Choose TransAsia</h2>
          <p>We deliver exceptional workforce solutions with integrity, efficiency, and unwavering commitment to quality
          </p>
        </div>
        <div class="value-cards">
          <div class="value-card" data-aos="fade-up" data-aos-delay="0">
            <div class="value-card-icon">
              <i class="fas fa-shield-alt"></i>
            </div>
            <h3>Rigorous Screening</h3>
            <p>Medical, technical, and background verification for every candidate ensures only the most qualified
              professionals reach your doorstep</p>
          </div>
          <div class="value-card" data-aos="fade-up" data-aos-delay="100">
            <div class="value-card-icon">
              <i class="fas fa-globe"></i>
            </div>
            <h3>Multi-Sector Coverage</h3>
            <p>Engineering, construction, hospitality, healthcare, and infrastructure specialists ready to meet diverse
              industry demands</p>
          </div>
          <div class="value-card" data-aos="fade-up" data-aos-delay="200">
            <div class="value-card-icon">
              <i class="fas fa-handshake"></i>
            </div>
            <h3>End-to-End Service</h3>
            <p>From sourcing to deployment—we handle documentation, visas, and travel logistics so you can focus on your
              business</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Company Overview Video Section -->
    <?php if (!$show_hero_video): ?>
    <section class="video-section" style="padding: 80px 0; background-color: var(--light-bg); position: relative; overflow: hidden;">
    <!-- ... (rest of the section content) ... -->
    <!-- Background Decor -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; opacity: 0.05; background-image: radial-gradient(var(--primary-blue) 1px, transparent 1px); background-size: 30px 30px;"></div>

    <div class="container" style="position: relative; z-index: 2;">
      <div class="section-header text-center" style="margin-bottom: 50px;">
        <span class="section-subtitle">Company Overview</span>
        <h2 class="section-title">See How We Connect Talent<br>With Opportunity</h2>
        <div class="section-line mx-auto"></div>
      </div>

      <?php
      $video_url = get_setting('company_video_url');
      $autoplay = get_setting('company_video_autoplay') == '1';
      $start_time = intval(get_setting('company_video_start_time', 0));
      $thumbnail = get_setting('company_video_thumbnail');
      
      // Logic for Viewport Autoplay
      $initial_src = '';
      $autoplay_src = '';
      
      if (strpos($video_url, 'youtube.com') !== false || strpos($video_url, 'youtu.be') !== false) {
          preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $video_url, $matches);
          $yt_id = $matches[1] ?? '';
          if ($yt_id) {
              $params = [];
              if ($start_time > 0) $params[] = 'start=' . $start_time;
              $base_url = "https://www.youtube.com/embed/$yt_id?" . implode('&', $params);
              
              $initial_src = $base_url;
              $autoplay_src = $base_url . ($params ? '&' : '') . 'autoplay=1&mute=1';
          }
      } elseif (strpos($video_url, 'vimeo.com') !== false) {
            preg_match('/vimeo\.com\/(\d+)/', $video_url, $matches);
            $vimeo_id = $matches[1] ?? '';
            if ($vimeo_id) {
                $fragment = ($start_time > 0) ? "#t={$start_time}s" : "";
                $initial_src = "https://player.vimeo.com/video/$vimeo_id$fragment";
                $autoplay_src = "https://player.vimeo.com/video/$vimeo_id?autoplay=1&muted=1" . $fragment;
            }
      } else {
            // Generic/Cloudflare
            if (!empty($video_url)) {
                $initial_src = $video_url;
                // Append autoplay param safely
                $separator = (strpos($video_url, '?') === false) ? '?' : '&';
                $autoplay_src = $video_url . $separator . 'autoplay=true';
            }
      }
      ?>

      <div class="video-container" id="company-video-wrapper" style="max-width: 900px; margin: 0 auto; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 50px rgba(0,0,0,0.15); background: #000; aspect-ratio: 16/9; position: relative;">
          
          <!-- Thumbnail Overlay -->
          <?php if ($thumbnail): ?>
          <div id="video-thumbnail-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 2; background-color: #000; transition: opacity 0.5s ease; cursor: pointer;">
              <img src="<?php echo htmlspecialchars($thumbnail); ?>" alt="Video Thumbnail" style="width: 100%; height: 100%; object-fit: cover; opacity: 0.8;">
              <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 80px; height: 80px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(5px);">
                  <i class="fas fa-play" style="font-size: 30px; color: white; margin-left: 5px;"></i>
              </div>
          </div>
          <?php endif; ?>

          <?php if ($initial_src): ?>
              <?php if ($autoplay): ?>
                  <!-- Autoplay enabled: Load initial source, then swap on scroll -->
                  <iframe id="company-video-frame" 
                          src="<?php echo htmlspecialchars($initial_src); ?>" 
                          data-autoplay-src="<?php echo htmlspecialchars($autoplay_src); ?>"
                          title="Company Overview" 
                          frameborder="0" 
                          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                          allowfullscreen 
                          style="width: 100%; height: 100%; position: relative; z-index: 1;">
                  </iframe>
                  <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const videoFrame = document.getElementById('company-video-frame');
                        const videoWrapper = document.getElementById('company-video-wrapper');
                        const thumbnailOverlay = document.getElementById('video-thumbnail-overlay');
                        
                        // Click to play handler (for immediate interaction)
                        if (thumbnailOverlay) {
                            thumbnailOverlay.addEventListener('click', function() {
                                if (videoFrame) {
                                    const autoplaySrc = videoFrame.getAttribute('data-autoplay-src');
                                    if (autoplaySrc) {
                                        videoFrame.src = autoplaySrc;
                                    } else {
                                        // If no autoplay src, ensure original src plays (append autoplay=1)
                                        let currentSrc = videoFrame.src;
                                        if (currentSrc.indexOf('autoplay') === -1) {
                                             videoFrame.src = currentSrc + (currentSrc.indexOf('?') === -1 ? '?' : '&') + 'autoplay=1';
                                        }
                                    }
                                }
                                thumbnailOverlay.style.opacity = '0';
                                setTimeout(() => { thumbnailOverlay.style.display = 'none'; }, 500);
                            });
                        }

                        // Viewport Autoplay Observer
                        if (videoFrame && videoWrapper && 'IntersectionObserver' in window) {
                            const observer = new IntersectionObserver((entries) => {
                                entries.forEach(entry => {
                                    if (entry.isIntersecting) {
                                        // Video is in view
                                        const autoplaySrc = videoFrame.getAttribute('data-autoplay-src');
                                        if (autoplaySrc && videoFrame.src !== autoplaySrc) {
                                            videoFrame.src = autoplaySrc;
                                            
                                            // Hide thumbnail
                                            if (thumbnailOverlay) {
                                                thumbnailOverlay.style.opacity = '0';
                                                setTimeout(() => { thumbnailOverlay.style.display = 'none'; }, 500);
                                            }
                                        }
                                    }
                                });
                            }, { threshold: 0.5 }); // Trigger when 50% visible
                            
                            observer.observe(videoWrapper);
                        }
                    });
                  </script>
              <?php else: ?>
                  <!-- Autoplay disabled: Just load standard iframe, thumbnail hides on click handled by wrapper/overlay logic if needed, or letting user click iframe through (if overlay hidden) -->
                  <iframe src="<?php echo htmlspecialchars($initial_src); ?>" 
                          title="Company Overview" 
                          frameborder="0" 
                          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                          allowfullscreen 
                          style="width: 100%; height: 100%; position: relative; z-index: 1;">
                  </iframe>
                  <?php if ($thumbnail): ?>
                      <script>
                          // Simple click to hide overlay for manual play
                          document.getElementById('video-thumbnail-overlay').addEventListener('click', function() {
                                this.style.opacity = '0';
                                setTimeout(() => { this.style.display = 'none'; }, 500);
                                // Trigger play on iframe if possible (might require postMessage or API)
                                // For generic iframes, we just hide overlay and let user click play on the iframe itself
                                // OR we reload iframe with autoplay
                                const iframe = document.querySelector('#company-video-wrapper iframe');
                                let src = iframe.src;
                                if (src.indexOf('autoplay') === -1) {
                                     iframe.src = src + (src.indexOf('?') === -1 ? '?' : '&') + 'autoplay=1';
                                }
                          });
                      </script>
                  <?php endif; ?>
              <?php endif; ?>
          <?php else: ?>
              <!-- Fallback / Placeholder State (No Video Configured) -->
              <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #1a1a1a; color: white; flex-direction: column; text-align: center;">
                 <i class="fas fa-film" style="font-size: 48px; opacity: 0.5; margin-bottom: 20px;"></i>
                 <p style="opacity: 0.7;">Video not configured yet.</p>
              </div>
          <?php endif; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>    <!-- Client Logo Marquee -->
    <section class="marquee-section" aria-labelledby="clients-heading">
      <div class="container">
        <div class="section-header" data-aos="fade-up">
          <h2 id="clients-heading">Trusted By Industry Leaders</h2>
          <p>Partnering with leading organizations across the Middle East and Southeast Asia</p>
        </div>
      </div>
      <div class="marquee-container" data-aos="fade-up">
        <div class="marquee-track">
          <!-- Luxbee -->
          <div class="client-card">
            <img src="images/clients/luxbee.png" alt="Luxbee" loading="lazy" onerror="this.onerror=null;this.src='https://placehold.co/140x60/ffffff/0056b3?text=Luxbee&font=montserrat';">
            <span class="client-name">Luxbee</span>
          </div>
          <!-- Ginco -->
          <div class="client-card">
            <img src="images/clients/ginco.png" alt="Ginco" loading="lazy" onerror="this.onerror=null;this.src='https://placehold.co/140x60/ffffff/0056b3?text=Ginco&font=roboto';">
            <span class="client-name">Ginco</span>
          </div>
          <!-- E-Cast -->
          <div class="client-card">
            <img src="images/clients/ecast.png" alt="E-Cast" loading="lazy" onerror="this.onerror=null;this.src='https://placehold.co/180x80/ffffff/dc3545?text=E-CAST&font=montserrat';">
            <span class="client-name">E-Cast</span>
          </div>
          <!-- Al Million -->
          <div class="client-card">
            <img src="images/clients/almillion.jpg" alt="Al Million services" loading="lazy" onerror="this.onerror=null;this.src='https://placehold.co/180x80/ffffff/28a745?text=Al+-+Million\nTransportation&font=roboto';">
            <span class="client-name">Al Million</span>
          </div>
          <!-- Retaj Hotels -->
          <div class="client-card">
            <img src="images/clients/retaj.png" alt="Retaj Hotels" loading="lazy" onerror="this.onerror=null;this.src='https://placehold.co/140x60/ffffff/0056b3?text=Retaj+Hotels&font=merriweather';">
            <span class="client-name">Retaj Hotels</span>
          </div>
          <!-- Belhasa -->
          <div class="client-card">
            <img src="images/clients/belhasa.png" alt="Belhasa" loading="lazy" onerror="this.onerror=null;this.src='https://placehold.co/140x60/ffffff/0056b3?text=Belhasa&font=oswald';">
            <span class="client-name">Belhasa</span>
          </div>
          <!-- Top Glove -->
          <div class="client-card">
            <img src="images/clients/topglove.png" alt="Top Glove" loading="lazy" onerror="this.onerror=null;this.src='https://placehold.co/140x60/ffffff/0056b3?text=Top+Glove&font=open-sans';">
            <span class="client-name">Top Glove</span>
          </div>
          <!-- Aljaber -->
          <div class="client-card">
            <img src="images/clients/aljaber.png" alt="Aljaber" loading="lazy" onerror="this.onerror=null;this.src='https://placehold.co/140x60/ffffff/0056b3?text=Aljaber&font=raleway';">
            <span class="client-name">Aljaber</span>
          </div>

          <!-- Duplicate for seamless loop -->
          <!-- Luxbee -->
          <div class="client-card">
            <img src="images/clients/luxbee.png" alt="Luxbee" loading="lazy" onerror="this.onerror=null;this.src='https://placehold.co/140x60/ffffff/0056b3?text=Luxbee&font=montserrat';">
            <span class="client-name">Luxbee</span>
          </div>
          <!-- Ginco -->
          <div class="client-card">
            <img src="images/clients/ginco.png" alt="Ginco" loading="lazy" onerror="this.onerror=null;this.src='https://placehold.co/140x60/ffffff/0056b3?text=Ginco&font=roboto';">
            <span class="client-name">Ginco</span>
          </div>
          <!-- E-Cast -->
          <div class="client-card">
            <img src="images/clients/ecast.png" alt="E-Cast" loading="lazy" onerror="this.onerror=null;this.src='https://placehold.co/180x80/ffffff/dc3545?text=E-CAST&font=montserrat';">
            <span class="client-name">E-Cast</span>
          </div>
          <!-- Al Million -->
          <div class="client-card">
            <img src="images/clients/almillion.jpg" alt="Al Million services" loading="lazy" onerror="this.onerror=null;this.src='https://placehold.co/180x80/ffffff/28a745?text=Al+-+Million\nTransportation&font=roboto';">
            <span class="client-name">Al Million</span>
          </div>
          <!-- Retaj Hotels -->
          <div class="client-card">
            <img src="images/clients/retaj.png" alt="Retaj Hotels" loading="lazy" onerror="this.onerror=null;this.src='https://placehold.co/140x60/ffffff/0056b3?text=Retaj+Hotels&font=merriweather';">
            <span class="client-name">Retaj Hotels</span>
          </div>
          <!-- Belhasa -->
          <div class="client-card">
            <img src="images/clients/belhasa.png" alt="Belhasa" loading="lazy" onerror="this.onerror=null;this.src='https://placehold.co/140x60/ffffff/0056b3?text=Belhasa&font=oswald';">
            <span class="client-name">Belhasa</span>
          </div>
          <!-- Top Glove -->
          <div class="client-card">
            <img src="images/clients/topglove.png" alt="Top Glove" loading="lazy" onerror="this.onerror=null;this.src='https://placehold.co/140x60/ffffff/0056b3?text=Top+Glove&font=open-sans';">
            <span class="client-name">Top Glove</span>
          </div>
          <!-- Aljaber -->
          <div class="client-card">
            <img src="images/clients/aljaber.png" alt="Aljaber" loading="lazy" onerror="this.onerror=null;this.src='https://placehold.co/140x60/ffffff/0056b3?text=Aljaber&font=raleway';">
            <span class="client-name">Aljaber</span>
          </div>
      </div>
    </section>

    <!-- Statistics Counter -->
    <section class="stats-section" aria-label="Statistics">
      <div class="container">
        <div class="stats-grid">
          <div class="stat-item" data-aos="fade-up" data-aos-delay="0">
            <div class="stat-number counter" data-target="5000" data-suffix="+">0</div>
            <div class="stat-label">Workers Placed</div>
          </div>
          <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
            <div class="stat-number counter" data-target="50" data-suffix="+">0</div>
            <div class="stat-label">Client Companies</div>
          </div>
          <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-number counter" data-target="12" data-suffix="">0</div>
            <div class="stat-label">Countries Served</div>
          </div>
          <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
            <div class="stat-number counter" data-target="10" data-suffix="+">0</div>
            <div class="stat-label">Years of Excellence</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Latest Insights -->
    <?php
    $stmt = $pdo->query("SELECT * FROM blogs WHERE status = 'Published' ORDER BY created_at DESC LIMIT 3");
    $latest_blogs = $stmt->fetchAll();
    
    if (!empty($latest_blogs)):
    ?>
    <section class="insights-section" aria-labelledby="insights-heading">
      <div class="container">
        <div class="section-header" data-aos="fade-up">
          <h2 id="insights-heading">Industry Updates</h2>
          <p>Stay informed with the latest trends and insights in international recruitment</p>
        </div>
        <div class="blog-grid">
          <?php foreach ($latest_blogs as $delay => $blog): ?>
          <article class="blog-card" data-aos="fade-up" data-aos-delay="<?php echo $delay * 100; ?>">
            <div class="blog-card-image">
              <img src="<?php echo $blog['image_url'] ?: 'images/blog-1.jpg'; ?>" alt="<?php echo htmlspecialchars($blog['title']); ?>" loading="lazy">
            </div>
            <div class="blog-card-content">
              <h3><?php echo htmlspecialchars($blog['title']); ?></h3>
              <p><?php echo htmlspecialchars($blog['excerpt']); ?></p>
              <a href="blog-detail.php?slug=<?php echo $blog['slug']; ?>" class="read-more">Read More <i class="fas fa-arrow-right"></i></a>
            </div>
          </article>
          <?php endforeach; ?>
        </div>
        <div class="text-center mt-5" data-aos="fade-up">
          <a href="blogs.php" class="btn btn-outline-dark">View All Articles</a>
        </div>
      </div>
    </section>
    <?php endif; ?>

    <!-- Footer CTA -->
    <section class="footer-cta" aria-label="Call to action">
      <div class="container">
        <div data-aos="fade-up">
          <h2>Ready to Build Your Workforce?</h2>
          <p>Partner with Bangladesh's most trusted recruitment agency</p>
          <a href="contact.php" class="btn btn-white">Contact Us</a>
          <div class="footer-cta-contact">
            <?php if ($phone = get_setting('support_phone')): ?>
              <a href="tel:<?php echo htmlspecialchars($phone); ?>"><i class="fas fa-phone"></i> <?php echo htmlspecialchars($phone); ?></a>
            <?php endif; ?>
            <?php if ($email = get_setting('primary_email')): ?>
              <a href="mailto:<?php echo htmlspecialchars($email); ?>"><i class="fas fa-envelope"></i> <?php echo htmlspecialchars($email); ?></a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php include 'includes/footer.php'; ?>
</body>
</html>
