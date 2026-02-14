<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

$page_title = "404 - Page Not Found";
include 'includes/header.php';
?>

<div class="header-spacer" style="height: 100px;"></div>

<section class="error-404 py-20 bg-gray-50">
    <div class="container text-center max-w-2xl mx-auto px-4">
        <div class="error-content" data-aos="fade-up">
            <h1 class="text-9xl font-bold text-primary-blue opacity-20">404</h1>
            <div class="error-text -mt-12 mb-8">
                <h2 class="text-4xl font-bold mb-4">Page Not Found</h2>
                <p class="text-gray-600 text-lg leading-relaxed">
                    Oops! The page you are looking for doesn't exist or has been moved. 
                    Let's get you back on track.
                </p>
            </div>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="index.php" class="btn btn-primary px-8 py-3">
                    <i class="fas fa-home mr-2"></i> Back to Homepage
                </a>
                <a href="contact.php" class="btn btn-outline px-8 py-3">
                    <i class="fas fa-envelope mr-2"></i> Contact Support
                </a>
            </div>

            <div class="popular-links mt-16 pt-8 border-t border-gray-200">
                <h3 class="text-xl font-semibold mb-6">Popular Pages</h3>
                <div class="flex flex-wrap justify-center gap-6">
                    <a href="about.php" class="text-primary-blue hover:underline">About Us</a>
                    <a href="services.php" class="text-primary-blue hover:underline">Our Services</a>
                    <a href="industries.php" class="text-primary-blue hover:underline">Industries</a>
                    <a href="blogs.php" class="text-primary-blue hover:underline">Latest News</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
