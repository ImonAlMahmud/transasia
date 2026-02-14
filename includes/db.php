<?php
/**
 * Database Connection Helper
 */

$host = 'localhost';
$db   = 'transasia_db';
$user = 'root'; // Default XAMPP user
$pass = '';     // Default XAMPP password
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE  => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES    => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     // Production: log error securely and show generic message
     // Development: show detailed error for debugging
     if ($_SERVER['SERVER_NAME'] === 'localhost' || $_SERVER['SERVER_ADDR'] === '127.0.0.1') {
         // Development environment - show detailed error
         die("Database Connection Failed: " . $e->getMessage());
     } else {
         // Production environment - log and show generic message
         error_log("Database Connection Error: " . $e->getMessage());
         die("A database error occurred. Please contact the administrator.");
     }
}
?>
