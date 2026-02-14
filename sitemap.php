<?php
header("Content-Type: application/xml; charset=utf-8");
require_once 'includes/db.php';
require_once 'includes/functions.php';

$base_url = "http://localhost/transasia/";

echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

// Static Pages
$static_pages = [
    '',
    'about.php',
    'services.php',
    'industries.php',
    'clients.php',
    'contact.php',
    'blogs.php',
    'recruitmentprocess.php'
];

foreach ($static_pages as $page) {
    echo '  <url>' . PHP_EOL;
    echo '    <loc>' . $base_url . $page . '</loc>' . PHP_EOL;
    echo '    <changefreq>weekly</changefreq>' . PHP_EOL;
    echo '    <priority>' . ($page === '' ? '1.0' : '0.8') . '</priority>' . PHP_EOL;
    echo '  </url>' . PHP_EOL;
}

// Sector Pages
$sectors = ['construction', 'engineering', 'facility', 'food', 'oilgas', 'transport'];
foreach ($sectors as $sector) {
    echo '  <url>' . PHP_EOL;
    echo '    <loc>' . $base_url . 'sector-' . $sector . '.php</loc>' . PHP_EOL;
    echo '    <changefreq>monthly</changefreq>' . PHP_EOL;
    echo '    <priority>0.7</priority>' . PHP_EOL;
    echo '  </url>' . PHP_EOL;
}

// Blog Posts
try {
    $stmt = $pdo->query("SELECT slug, updated_at FROM blogs WHERE status = 'Published' ORDER BY created_at DESC");
    while ($row = $stmt->fetch()) {
        echo '  <url>' . PHP_EOL;
        echo '    <loc>' . $base_url . 'blog-detail.php?slug=' . htmlspecialchars($row['slug']) . '</loc>' . PHP_EOL;
        echo '    <lastmod>' . date('Y-m-d', strtotime($row['updated_at'])) . '</lastmod>' . PHP_EOL;
        echo '    <changefreq>monthly</changefreq>' . PHP_EOL;
        echo '    <priority>0.6</priority>' . PHP_EOL;
        echo '  </url>' . PHP_EOL;
    }
} catch (Exception $e) {
    // Fail silently or log error
}

echo '</urlset>' . PHP_EOL;
