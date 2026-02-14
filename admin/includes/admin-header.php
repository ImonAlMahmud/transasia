<?php
require_once '../includes/auth.php';
require_once '../includes/db.php';
require_once '../includes/functions.php';
require_login();

/**
 * $active_admin_page should be set before including this file
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'Dashboard'; ?> | <?php echo htmlspecialchars(get_setting('site_name', 'TransAsia')); ?> Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin-styles.css">
</head>
<body class="admin-page">
    
    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="sidebar-logo">
            <img src="../images/logo.png" alt="<?php echo htmlspecialchars(get_setting('site_name', 'TransAsia')); ?>" height="32">
            <span style="font-weight: 700; font-size: 18px; letter-spacing: 1px;">ADMIN</span>
        </div>
        
        <ul class="sidebar-nav">
            <li><a href="index.php" class="<?php echo ($active_admin_page == 'dashboard') ? 'active' : ''; ?>"><i class="fas fa-th-large"></i> Dashboard</a></li>
            <li><a href="inquiries.php" class="<?php echo ($active_admin_page == 'inquiries') ? 'active' : ''; ?>"><i class="fas fa-envelope"></i> Inquiries</a></li>
            <li><a href="pages.php" class="<?php echo ($active_admin_page == 'pages') ? 'active' : ''; ?>"><i class="fas fa-file-alt"></i> Pages</a></li>
            <li><a href="blogs.php" class="<?php echo ($active_admin_page == 'blogs') ? 'active' : ''; ?>"><i class="fas fa-blog"></i> Blogs</a></li>
            <li><a href="users.php" class="<?php echo ($active_admin_page == 'users') ? 'active' : ''; ?>"><i class="fas fa-users"></i> Users</a></li>
            <li><a href="settings.php" class="<?php echo ($active_admin_page == 'settings') ? 'active' : ''; ?>"><i class="fas fa-cog"></i> Settings</a></li>
            <li><a href="offices.php" class="<?php echo $active_admin_page === 'offices' ? 'active' : ''; ?>"><i class="fas fa-map-marked-alt"></i> Global Offices</a></li>
        </ul>
        
        <div class="sidebar-footer" style="padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.1);">
            <a href="logout.php?csrf_token=<?php echo generate_csrf_token(); ?>" style="color: #ef4444; display: flex; align-items: center; gap: 12px; text-decoration: none; font-weight: 500;">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="admin-main">
        <!-- Topbar -->
        <header class="admin-topbar">
            <div class="page-title">
                <h1><?php echo $page_title ?? 'Dashboard Overview'; ?></h1>
            </div>
            <div class="user-profile">
                <span style="color: var(--text-muted); font-size: 14px;">Welcome, <strong><?php echo htmlspecialchars($_SESSION['admin_user']); ?></strong></span>
                <div class="avatar"><?php echo strtoupper(substr($_SESSION['admin_user'], 0, 2)); ?></div>
            </div>
        </header>

        <!-- Content Area -->
        <div class="admin-content">
