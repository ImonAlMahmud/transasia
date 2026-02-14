<?php
/**
 * Export Activity Logs to CSV
 */
require_once 'includes/admin-header.php';

// CSRF Protection
$csrf_token = $_GET['csrf_token'] ?? '';
if (!validate_csrf_token($csrf_token)) {
    die('Security check failed.');
}

try {
    // Fetch all logs
    $stmt = $pdo->query("SELECT al.*, a.username FROM activity_logs al 
                         LEFT JOIN admins a ON al.admin_id = a.id 
                         ORDER BY al.created_at DESC");
    $logs = $stmt->fetchAll();
    
    // Set headers for CSV download
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=activity_logs_' . date('Y-m-d_His') . '.csv');
    
    // Open output stream
    $output = fopen('php://output', 'w');
    
    // Add BOM for UTF-8
    fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
    
    // Write CSV headers
    fputcsv($output, ['Date & Time', 'Admin Username', 'Action', 'Description', 'IP Address']);
    
    // Write data rows
    foreach ($logs as $log) {
        fputcsv($output, [
            date('Y-m-d H:i:s', strtotime($log['created_at'])),
            $log['username'] ?? 'System',
            $log['action'],
            $log['description'],
            $log['ip_address']
        ]);
    }
    
    fclose($output);
    exit;
    
} catch (Exception $e) {
    die('Error exporting logs: ' . $e->getMessage());
}
