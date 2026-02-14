<?php
require_once '../includes/auth.php';
require_once '../includes/db.php';
require_once '../includes/functions.php';
require_login();

// Fetch all inquiries
$stmt = $pdo->query("SELECT id, name, company, email, phone, country, subject, message, status, created_at FROM inquiries ORDER BY created_at DESC");
$inquiries = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($inquiries)) {
    die("No inquiries to export.");
}

// Log the activity
log_activity("Export Inquiries", "Downloaded all inquiries as CSV");

// Set headers for download
$filename = "inquiries_" . date('Y-m-d_H-i-s') . ".csv";
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=' . $filename);

// Create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// Set CSV header row
fputcsv($output, ['ID', 'Name', 'Company', 'Email', 'Phone', 'Country', 'Subject', 'Message', 'Status', 'Date']);

// Add data rows
foreach ($inquiries as $row) {
    fputcsv($output, $row);
}

fclose($output);
exit();
