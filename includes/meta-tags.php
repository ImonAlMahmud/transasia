<?php
/**
 * SEO & Social Meta Tags Handler
 */

// Default values
$site_name = get_setting('site_name', 'TransAsia Integrate Service Ltd');
$default_desc = "TransAsia Integrate Service Ltd - Bangladesh's trusted government-licensed recruitment agency. Connecting global employers with skilled manpower.";
$current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$og_title = $page_title ?? "$site_name - International Recruitment";
$og_desc = $meta_desc ?? $default_desc;
$og_image = $page_image ?? "images/logo.png"; // Fallback to logo

// Ensure absolute path for images
if (!filter_var($og_image, FILTER_VALIDATE_URL)) {
    $base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/transasia/";
    $og_image = $base_url . $og_image;
}
?>

<!-- Primary Meta Tags -->
<title><?php echo htmlspecialchars($og_title); ?></title>
<meta name="title" content="<?php echo htmlspecialchars($og_title); ?>">
<meta name="description" content="<?php echo htmlspecialchars($og_desc); ?>">
<link rel="canonical" href="<?php echo htmlspecialchars($current_url); ?>">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo htmlspecialchars($current_url); ?>">
<meta property="og:title" content="<?php echo htmlspecialchars($og_title); ?>">
<meta property="og:description" content="<?php echo htmlspecialchars($og_desc); ?>">
<meta property="og:image" content="<?php echo htmlspecialchars($og_image); ?>">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="<?php echo htmlspecialchars($current_url); ?>">
<meta property="twitter:title" content="<?php echo htmlspecialchars($og_title); ?>">
<meta property="twitter:description" content="<?php echo htmlspecialchars($og_desc); ?>">
<meta property="twitter:image" content="<?php echo htmlspecialchars($og_image); ?>">

<!-- Schema.org JSON-LD -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "<?php echo addslashes($site_name); ?>",
  "image": "<?php echo $og_image; ?>",
  "@id": "<?php echo $current_url; ?>",
  "url": "<?php echo $current_url; ?>",
  "telephone": "<?php echo get_setting('site_phone', '+8801811332204'); ?>",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "<?php echo addslashes(get_setting('site_address', '2185/A, Block-I (Extension), Bashundhara C/A, Madani Avenue, Dhaka-1229')); ?>",
    "addressLocality": "Dhaka",
    "postalCode": "1229",
    "addressCountry": "BD"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": 23.8243,
    "longitude": 90.4265
  },
  "openingHoursSpecification": {
    "@type": "OpeningHoursSpecification",
    "dayOfWeek": [
      "Saturday",
      "Sunday",
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday"
    ],
    "opens": "09:00",
    "closes": "18:00"
  }
}
</script>
