<?php
/**
 * Global Helper Functions
 */

/**
 * Fetch a specific site setting by key
 */
function get_setting($key, $default = '') {
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT setting_value FROM site_settings WHERE setting_key = ?");
        $stmt->execute([$key]);
        $value = $stmt->fetchColumn();
        return $value !== false ? $value : $default;
    } catch (Exception $e) {
        return $default;
    }
}

/**
 * Log administrative activity
 */
function log_activity($action, $description = '') {
    global $pdo;
    
    $admin_id = $_SESSION['admin_id'] ?? null;
    $ip_address = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
    
    try {
        $stmt = $pdo->prepare("INSERT INTO activity_logs (admin_id, action, description, ip_address) VALUES (?, ?, ?, ?)");
        $stmt->execute([$admin_id, $action, $description, $ip_address]);
    } catch (Exception $e) {
        // If table doesn't exist, try to create it and retry once
        if ($e->getCode() == '42S02') {
            try {
                $pdo->exec("CREATE TABLE IF NOT EXISTS activity_logs (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    admin_id INT,
                    action VARCHAR(100) NOT NULL,
                    description TEXT,
                    ip_address VARCHAR(45),
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    FOREIGN KEY (admin_id) REFERENCES admins(id) ON DELETE SET NULL
                )");
                // Retry insertion
                $stmt = $pdo->prepare("INSERT INTO activity_logs (admin_id, action, description, ip_address) VALUES (?, ?, ?, ?)");
                $stmt->execute([$admin_id, $action, $description, $ip_address]);
            } catch (Exception $e2) {
                // Silently fail if still failing
            }
        }
    }
}

/**
 * Send email using stored SMTP settings
 */
function send_email($to, $subject, $body) {
    $smtp_host = get_setting('smtp_host');
    $smtp_port = get_setting('smtp_port');
    $smtp_from_email = get_setting('smtp_from_email', 'noreply@transasia.ltd');
    $smtp_from_name = get_setting('smtp_from_name', 'TransAsia System');

    // Headers for HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: ' . $smtp_from_name . ' <' . $smtp_from_email . '>' . "\r\n";

    // Fallback to native mail() function
    // PHP's mail() uses the server's configured mail transport which might be local Sendmail/Postfix
    // Our SMTP settings are stored in DB for future library integration (like PHPMailer).
    return @mail($to, $subject, $body, $headers);
}
/**
 * Generate a CSRF token and store it in session
 */
function generate_csrf_token() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Validate a CSRF token from a request
 */
function validate_csrf_token($token) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($_SESSION['csrf_token']) || empty($token)) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}
?>
