<?php 
require_once 'includes/init.php'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
      $page_title = "Recruitment Process | " . $site_name;
      $meta_desc = "Our systematic recruitment process ensures verified and skilled talent for your organization. From requisition to final deployment.";
      include 'includes/meta-tags.php'; 
    ?>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Styles -->
    <link rel="stylesheet" href="css/styles.css">

    <style>
        /* Compact Workflow Grid Styles - Version 2 */
        .workflow-section {
            padding: 80px 0;
            background-color: var(--bg-light);
            background-image: radial-gradient(circle at 10% 20%, rgba(0, 86, 179, 0.02) 0%, transparent 20%),
                              radial-gradient(circle at 90% 80%, rgba(40, 167, 69, 0.02) 0%, transparent 20%);
        }

        .workflow-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-top: 50px;
        }

        .step-item {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
            height: 100%;
        }

        .step-item.show {
            opacity: 1;
            transform: translateY(0);
        }

        .step-content {
            padding: 30px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(255, 255, 255, 1);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        /* Subtle Accent Border */
        .step-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-blue), var(--secondary-blue));
            opacity: 0.1;
            transition: opacity 0.3s ease;
            border-radius: 16px 16px 0 0;
        }

        .step-content:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
            background: var(--white);
        }

        .step-content:hover::before {
            opacity: 1;
        }

        .step-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            gap: 15px;
            padding-right: 80px; /* Space for step badge */
        }

        .step-icon-container {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 20px;
            box-shadow: 0 8px 16px rgba(0, 86, 179, 0.15);
            flex-shrink: 0;
            transition: transform 0.3s ease;
        }

        /* All items use primary brand color */
        .step-icon-container {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            box-shadow: 0 8px 16px rgba(0, 86, 179, 0.15);
        }

        .step-content:hover .step-icon-container {
            transform: scale(1.1) rotate(5deg);
        }

        .step-number {
            position: absolute;
            top: 22px;
            right: 15px;
            background: var(--primary-blue);
            color: var(--white);
            font-family: 'Inter', sans-serif;
            font-size: 0.65rem;
            font-weight: 800;
            padding: 4px 10px;
            border-radius: 30px;
            box-shadow: 0 4px 10px rgba(0, 86, 179, 0.15);
            z-index: 5;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        /* Standardize all badges to brand color */
        .step-item .step-number {
            background: var(--primary-blue);
            box-shadow: 0 4px 10px rgba(0, 86, 179, 0.15);
        }

        .step-content h3 {
            margin: 0;
            color: var(--text-dark);
            font-size: 1.25rem;
            font-weight: 700;
            line-height: 1.3;
        }

        .step-content p {
            margin: 0;
            font-size: 0.95rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* Responsive breakpoints */
        @media screen and (max-width: 991px) {
            .workflow-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media screen and (max-width: 600px) {
            .workflow-grid {
                grid-template-columns: 1fr;
            }
            .workflow-section {
                padding: 60px 0;
            }
        }

        /* Recruitment Documents Section Styles */
        .docs-section {
            padding: 80px 0;
            background: var(--white);
            position: relative;
        }

        .docs-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
            margin-top: 40px;
        }

        .country-card {
            display: block;
            background: var(--bg-light);
            padding: 25px;
            border-radius: 16px;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.23, 1, 0.32, 1);
            border: 1px solid rgba(0, 0, 0, 0.03);
            position: relative;
            overflow: hidden;
        }

        .country-card:hover {
            background: var(--white);
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0, 86, 179, 0.08);
            border-color: rgba(0, 86, 179, 0.1);
        }

        .flag-wrapper {
            width: 80px;
            height: 50px;
            margin: 0 auto 15px;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .country-card:hover .flag-wrapper {
            transform: scale(1.1);
        }

        .flag-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .country-card h4 {
            margin: 0;
            color: var(--text-dark);
            font-size: 1.1rem;
            font-weight: 700;
            transition: color 0.3s ease;
        }

        .country-card:hover h4 {
            color: var(--primary-blue);
        }

        .doc-link-icon {
            margin-top: 10px;
            color: var(--primary-blue);
            font-size: 0.9rem;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }

        .country-card:hover .doc-link-icon {
            opacity: 1;
            transform: translateY(0);
        }

        @media screen and (max-width: 991px) {
            .docs-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media screen and (max-width: 500px) {
            .docs-grid {
                grid-template-columns: 1fr;
            }
            .docs-section {
                padding: 60px 0;
            }
        }
    </style>
</head>

<body>
    <?php 
        $active_page = 'recruitment'; 
        include 'includes/header.php'; 
    ?>

<main>
    <section class="hero" style="min-height: 40vh; padding-top: 120px;">
        <div class="hero-bg" style="background-image: url('<?php echo get_setting('process_header_bg', 'images/hero-recruitment.jpg'); ?>');"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 data-aos="fade-up">Recruitment Journey</h1>
            <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="100">Our Systematic Approach to Global Talent Sourcing</p>
        </div>
    </section>

    <section class="workflow-section">
        <div class="container">
            <div class="section-header" data-aos="fade-up" style="margin-bottom: 30px;">
                <h2>The Excellence Process</h2>
                <p>A streamlined, efficient path connecting global employers with high-potential talent.</p>
            </div>

            <div class="workflow-grid">
                <!-- Step 1 -->
                <div class="step-item">
                    <div class="step-content">
                        <span class="step-number">Step 01</span>
                        <div class="step-header">
                            <div class="step-icon-container">
                                <i class="fas fa-file-import"></i>
                            </div>
                            <h3>Received Requirement</h3>
                        </div>
                        <p>Formal manpower requests and demand letters from international employers initiate our sourcing journey.</p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="step-item">
                    <div class="step-content">
                        <span class="step-number">Step 02</span>
                        <div class="step-header">
                            <div class="step-icon-container">
                                <i class="fas fa-microscope"></i>
                            </div>
                            <h3>Requirement Analysis</h3>
                        </div>
                        <p>A deep dive into job roles and cultural fit to define the ideal candidate profile for our clients.</p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="step-item">
                    <div class="step-content">
                        <span class="step-number">Step 03</span>
                        <div class="step-header">
                            <div class="step-icon-container">
                                <i class="fas fa-bullhorn"></i>
                            </div>
                            <h3>Advertise Vacancy</h3>
                        </div>
                        <p>Multi-channel advertising across job boards and our internal community to attract top-tier talent.</p>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="step-item">
                    <div class="step-content">
                        <span class="step-number">Step 04</span>
                        <div class="step-header">
                            <div class="step-icon-container">
                                <i class="fas fa-users-viewfinder"></i>
                            </div>
                            <h3>Shortlist Talent</h3>
                        </div>
                        <p>Leveraging AI screening and databases to identify the most eligible and high-potential candidates.</p>
                    </div>
                </div>

                <!-- Step 5 -->
                <div class="step-item">
                    <div class="step-content">
                        <span class="step-number">Step 05</span>
                        <div class="step-header">
                            <div class="step-icon-container">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <h3>Evaluation</h3>
                        </div>
                        <p>Technical assessments and behavioral interviews conducted by industry-specific evaluation panels.</p>
                    </div>
                </div>

                <!-- Step 6 -->
                <div class="step-item">
                    <div class="step-content">
                        <span class="step-number">Step 06</span>
                        <div class="step-header">
                            <div class="step-icon-container">
                                <i class="fas fa-file-signature"></i>
                            </div>
                            <h3>Employer Approval</h3>
                        </div>
                        <p>Verified candidate dossiers are submitted for final selection and employer sign-off.</p>
                    </div>
                </div>

                <!-- Step 7 -->
                <div class="step-item">
                    <div class="step-content">
                        <span class="step-number">Step 07</span>
                        <div class="step-header">
                            <div class="step-icon-container">
                                <i class="fas fa-heartbeat"></i>
                            </div>
                            <h3>Medical Screening</h3>
                        </div>
                        <p>Mandatory health examinations and fitness certifications at accredited medical facilitates.</p>
                    </div>
                </div>

                <!-- Step 8 -->
                <div class="step-item">
                    <div class="step-content">
                        <span class="step-number">Step 08</span>
                        <div class="step-header">
                            <div class="step-icon-container">
                                <i class="fas fa-passport"></i>
                            </div>
                            <h3>Visa Formalities</h3>
                        </div>
                        <p>Expert handling of visa applications and administrative paperwork for entry permits.</p>
                    </div>
                </div>

                <!-- Step 9 -->
                <div class="step-item">
                    <div class="step-content">
                        <span class="step-number">Step 09</span>
                        <div class="step-header">
                            <div class="step-icon-container">
                                <i class="fas fa-certificate"></i>
                            </div>
                            <h3>BMET Clearance</h3>
                        </div>
                        <p>Securing regulatory emigration clearances and government approvals for legal deployment.</p>
                    </div>
                </div>

                <!-- Step 10 -->
                <div class="step-item">
                    <div class="step-content">
                        <span class="step-number">Step 10</span>
                        <div class="step-header">
                            <div class="step-icon-container">
                                <i class="fas fa-chalkboard-user"></i>
                            </div>
                            <h3>Orientation</h3>
                        </div>
                        <p>Essential briefings on destination culture, labor laws, and job-site responsibilities.</p>
                    </div>
                </div>

                <!-- Step 11 -->
                <div class="step-item">
                    <div class="step-content">
                        <span class="step-number">Step 11</span>
                        <div class="step-header">
                            <div class="step-icon-container">
                                <i class="fas fa-plane-departure"></i>
                            </div>
                            <h3>Logistics</h3>
                        </div>
                        <p>Coordination of flight itineraries and final arrival briefings for smooth transit.</p>
                    </div>
                </div>

                <!-- Step 12 -->
                <div class="step-item">
                    <div class="step-content">
                        <span class="step-number">Step 12</span>
                        <div class="step-header">
                            <div class="step-icon-container">
                                <i class="fas fa-star"></i>
                            </div>
                            <h3>Feedback</h3>
                        </div>
                        <p>Post-deployment monitoring to ensure long-term success for both client and candidate.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Recruitment Documents Section -->
    <section class="docs-section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2>Recruitment Documents</h2>
                <p>Access essential recruitment paperwork and regulatory forms by country.</p>
            </div>

            <div class="docs-grid">
                <!-- Saudi Arabia -->
                <a href="https://drive.google.com/drive/folders/1Uu83dgchFAoBfmAhXmbjlUH_yIklPTDM?usp=sharing" class="country-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="flag-wrapper">
                        <img src="https://flagcdn.com/w160/sa.png" alt="Saudi Arabia Flag">
                    </div>
                    <h4>Saudi Arabia</h4>
                    <div class="doc-link-icon">
                        <span>Download Documents <i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>

                <!-- Malaysia -->
                <a href="https://drive.google.com/drive/folders/1iBKNfGTIq1R1p75SmelGlVApY0Tawnmt?usp=sharing" class="country-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="flag-wrapper">
                        <img src="https://flagcdn.com/w160/my.png" alt="Malaysia Flag">
                    </div>
                    <h4>Malaysia</h4>
                    <div class="doc-link-icon">
                        <span>Download Documents <i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>

                <!-- United Arab Emirates -->
                <a href="https://drive.google.com/drive/folders/1PTXQb-e7Qc4rNIj5PXCgMBfkNnft9TyC?usp=sharing" class="country-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="flag-wrapper">
                        <img src="https://flagcdn.com/w160/ae.png" alt="UAE Flag">
                    </div>
                    <h4>United Arab Emirates</h4>
                    <div class="doc-link-icon">
                        <span>Download Documents <i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>

                <!-- Qatar -->
                <a href="https://drive.google.com/drive/folders/1RGPaywdy9rbDG-X4iAdyuA1NWcie_Y3z?usp=sharing" class="country-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="flag-wrapper">
                        <img src="https://flagcdn.com/w160/qa.png" alt="Qatar Flag">
                    </div>
                    <h4>Qatar</h4>
                    <div class="doc-link-icon">
                        <span>Download Documents <i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>
            </div>
        </div>
    </section>
</main>

<script>
    // Intersection Observer for scroll animation
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('show');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.step-item').forEach(item => {
        observer.observe(item);
    });
</script>

<?php include 'includes/footer.php'; ?>
</body>
</html>