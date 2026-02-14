<?php
/**
 * Authentication Helper
 */
if (session_status() === PHP_SESSION_NONE) {
    // Harden session cookies
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    ini_set('session.cookie_samesite', 'Lax');
    
    // In production with HTTPS, you should also set:
    // ini_set('session.cookie_secure', 1);
    
    session_start();
}

/**
 * Check if user is logged in
 */
function is_logged_in() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

/**
 * Require login for a page
 */
function require_login() {
    if (!is_logged_in()) {
        header('Location: ../login.php');
        exit;
    }
}
?>
