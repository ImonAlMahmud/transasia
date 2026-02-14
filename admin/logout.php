<?php
/**
 * Secure Logout Handler
 */
require_once 'includes/auth.php';
require_once 'includes/db.php';
require_once 'includes/functions.php';

// Verify user is logged in
if (!is_logged_in()) {
    header('Location: ../login.php');
    exit;
}

// CSRF Protection (optional but recommended)
if (isset($_GET['csrf_token'])) {
    if (!validate_csrf_token($_GET['csrf_token'])) {
        die('Security check failed. Please try again.');
    }
}

// Log the logout activity before destroying session
$username = $_SESSION['admin_user'] ?? 'Unknown';
$admin_id = $_SESSION['admin_id'] ?? null;
log_activity('Logout', 'Admin logged out from the system');

// Destroy the session
session_unset();
session_destroy();

// Regenerate session ID for security
session_start();
session_regenerate_id(true);

// Redirect to login page with success message
header('Location: ../login.php?msg=logout_success');
exit;
