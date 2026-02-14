<?php
require_once '../includes/auth.php';
require_once '../includes/db.php';
require_login();

// Fetch live statistics
$stats = [
    'total' => $pdo->query("SELECT COUNT(*) FROM inquiries")->fetchColumn(),
    'resolved' => $pdo->query("SELECT COUNT(*) FROM inquiries WHERE status = 'Completed'")->fetchColumn(),
    'pending' => $pdo->query("SELECT COUNT(*) FROM inquiries WHERE status = 'Pending'")->fetchColumn(),
];

// Fetch recent inquiries
$stmt = $pdo->query("SELECT * FROM inquiries ORDER BY created_at DESC LIMIT 5");
$inquiries = $stmt->fetchAll();
$page_title = 'Dashboard Overview';
$active_admin_page = 'dashboard';
include 'includes/admin-header.php';
?>

            <!-- Stats Widgets -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon blue">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Total Inquiries</h3>
                        <span class="value"><?php echo $stats['total']; ?></span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon green">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Resolved</h3>
                        <span class="value"><?php echo $stats['resolved']; ?></span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon orange">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Pending</h3>
                        <span class="value"><?php echo $stats['pending']; ?></span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon red">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Site Traffic</h3>
                        <span class="value">0</span>
                    </div>
                </div>
            </div>

            <!-- Recent Inquiries Table -->
            <div class="content-card">
                <div class="card-header">
                    <h2>Recent Inquiries</h2>
                    <a href="inquiries.php" style="font-size: 14px; color: var(--admin-primary); text-decoration: none; font-weight: 500;">View All</a>
                </div>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Sender</th>
                            <th>Subject</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($inquiries)): ?>
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 40px; color: var(--text-muted);">No inquiries found.</td>
                        </tr>
                        <?php endif; ?>
                        <?php foreach ($inquiries as $row): ?>
                        <tr>
                            <td>
                                <div style="font-weight: 500;"><?php echo htmlspecialchars($row['name']); ?></div>
                                <div style="font-size: 12px; color: var(--text-muted);"><?php echo htmlspecialchars($row['email']); ?></div>
                            </td>
                            <td><?php echo htmlspecialchars($row['subject']); ?></td>
                            <td><?php echo date('M d, Y', strtotime($row['created_at'])); ?></td>
                            <td>
                                <span class="badge <?php echo ($row['status'] == 'Completed') ? 'badge-success' : 'badge-pending'; ?>">
                                    <?php echo $row['status']; ?>
                                </span>
                            </td>
                            <td>
                                <button class="btn-action" title="View"><i class="fas fa-eye"></i></button>
                                <button class="btn-action" title="Delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Quick Actions -->
            <div style="margin-top: 40px;">
                <h2 style="font-size: 18px; margin-bottom: 20px;">Quick Actions</h2>
                <div style="display: flex; gap: 16px;">
                    <a href="../index.php" target="_blank" class="btn btn-outline-dark" style="text-decoration: none; padding: 12px 24px; border: 1px solid var(--border-color); border-radius: 8px; font-weight: 500; color: var(--text-main); display: flex; align-items: center; gap: 8px; background: white;">
                        <i class="fas fa-external-link-alt"></i> View Site
                    </a>
                    <button class="btn btn-primary" style="padding: 12px 24px; border: none; border-radius: 8px; font-weight: 500; background: var(--admin-primary); color: white; display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <i class="fas fa-plus"></i> New Page
                    </button>
                </div>
            </div>

<?php include 'includes/admin-footer.php'; ?>
