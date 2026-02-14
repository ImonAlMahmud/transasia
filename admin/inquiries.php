<?php
$page_title = 'User Inquiries';
$active_admin_page = 'inquiries';
require_once 'includes/admin-header.php';

// Handle Actions
if (isset($_GET['action'])) {
    $id = $_GET['id'] ?? null;
    $action = $_GET['action'];
    $token = $_GET['csrf_token'] ?? '';

    if ($action === 'delete' && $id) {
        if (!validate_csrf_token($token)) {
            die('Security check failed.');
        }
        $stmt = $pdo->prepare("DELETE FROM inquiries WHERE id = ?");
        $stmt->execute([$id]);
        header("Location: inquiries.php?msg=Inquiry deleted successfully");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $id = $_POST['id'] ?? null;
    $action = $_POST['action'];
    $token = $_POST['csrf_token'] ?? '';

    if ($action === 'update_status' && $id) {
        if (!validate_csrf_token($token)) {
            die('Security check failed.');
        }
        $status = $_POST['status'] ?? 'Pending';
        $stmt = $pdo->prepare("UPDATE inquiries SET status = ? WHERE id = ?");
        $stmt->execute([$status, $id]);
        header("Location: inquiries.php?msg=Status updated successfully");
        exit;
    }
}

// Fetch all inquiries
$stmt = $pdo->query("SELECT * FROM inquiries ORDER BY created_at DESC");
$all_inquiries = $stmt->fetchAll();
?>

<style>
    .admin-table th { background: #f8f9fa; color: #333; font-weight: 700; text-transform: uppercase; font-size: 12px; letter-spacing: 0.5px; padding: 15px; }
    .admin-table td { padding: 15px; vertical-align: middle; border-bottom: 1px solid #eee; }
    .badge { padding: 5px 10px; border-radius: 4px; font-size: 11px; font-weight: 600; text-transform: uppercase; }
    .badge-pending { background: #fff3cd; color: #856404; }
    .badge-in-progress { background: #cce5ff; color: #004085; }
    .badge-completed { background: #d4edda; color: #155724; }
    .btn-action { width: 32px; height: 32px; border-radius: 6px; border: 1px solid #ddd; background: #fff; color: #555; display: inline-flex; align-items: center; justify-content: center; transition: all 0.2s; cursor: pointer; text-decoration: none; margin-right: 5px; }
    .btn-action:hover { background: #f0f0f0; border-color: #bbb; color: #000; }
    .btn-delete:hover { background: #fee2e2; border-color: #fecaca; color: #dc3545; }
    .btn-view:hover { background: #e0f2fe; border-color: #bae6fd; color: #0284c7; }
    
    /* Dropdown UI Improvements */
    .status-menu-btn { display: block; width: 100%; padding: 10px 15px; border: none; background: none; text-align: left; cursor: pointer; font-size: 13px; transition: background 0.2s; }
    .status-menu-btn:hover { background: #f8f9fa; }
    .status-menu-btn.active { font-weight: 700; background: #f0f7ff; }
    
    /* Fix Clipping */
    .content-card { overflow: visible !important; }
    .admin-table td { position: relative; } /* Ensure relative parent for clipping context */
    .status-dropdown-menu { z-index: 1000 !important; border-radius: 12px !important; box-shadow: 0 10px 40px rgba(0,0,0,0.2) !important; background: white !important; }
    
    /* Modal Styles */
    .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); overflow-y: auto; }
    .modal-content { background-color: #fefefe; margin: 5% auto; padding: 0; border: none; width: 600px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); overflow: hidden; position: relative; animation: modalSlide 0.3s ease-out; }
    @keyframes modalSlide { from { transform: translateY(-30px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
    .modal-header { padding: 20px 25px; background: #f8f9fa; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
    .modal-header h3 { margin: 0; font-size: 18px; color: #333; }
    .modal-close { font-size: 24px; color: #aaa; cursor: pointer; transition: color 0.2s; }
    .modal-close:hover { color: #333; }
    .modal-body { padding: 25px; }
    .detail-item { margin-bottom: 20px; }
    .detail-item label { display: block; font-size: 12px; color: #888; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 5px; font-weight: 600; }
    .detail-item div { font-size: 15px; color: #333; line-height: 1.5; }
    .modal-footer { padding: 15px 25px; background: #f8f9fa; border-top: 1px solid #eee; text-align: right; }
</style>

<div class="content-card">
    <div class="card-header">
        <h2>User Inquiries <span style="font-size: 14px; font-weight: 400; color: #888; margin-left: 10px;">(<?php echo count($all_inquiries); ?> Total)</span></h2>
        <div class="card-actions">
            <!-- <a href="export-inquiries.php" class="btn btn-outline-sm"><i class="fas fa-download"></i> Export CSV</a> -->
        </div>
    </div>
    
    <?php if (isset($_GET['msg'])): ?>
        <div style="background: #d4edda; color: #155724; padding: 12px 20px; border-radius: 8px; margin-bottom: 25px; border: 1px solid #c3e6cb; font-size: 14px;">
            <i class="fas fa-check-circle" style="margin-right: 8px;"></i> <?php echo htmlspecialchars($_GET['msg']); ?>
        </div>
    <?php endif; ?>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Sender</th>
                <th>Subject</th>
                <th>Status</th>
                <th style="text-align: right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($all_inquiries)): ?>
            <tr>
                <td colspan="5" style="text-align: center; padding: 80px; color: var(--text-muted);">
                    <i class="fas fa-inbox fa-4x" style="margin-bottom: 20px; display: block; opacity: 0.2;"></i>
                    No inquiries received yet.
                </td>
            </tr>
            <?php endif; ?>
            <?php foreach ($all_inquiries as $row): 
                $status_class = 'badge-pending';
                if ($row['status'] === 'In Progress') $status_class = 'badge-in-progress';
                if ($row['status'] === 'Completed') $status_class = 'badge-completed';
            ?>
            <tr>
                <td style="font-size: 13px; color: #666; width: 120px;">
                    <?php echo date('M d, Y', strtotime($row['created_at'])); ?><br>
                    <small style="color: #aaa;"><?php echo date('h:i A', strtotime($row['created_at'])); ?></small>
                </td>
                <td>
                    <div style="font-weight: 700; color: #333; margin-bottom: 2px;"><?php echo htmlspecialchars($row['name']); ?></div>
                    <div style="font-size: 12px; color: #888;"><?php echo htmlspecialchars($row['email']); ?></div>
                    <?php if (!empty($row['phone'])): ?>
                        <div style="font-size: 11px; color: #aaa; margin-top: 2px;"><i class="fas fa-phone-alt" style="font-size: 10px; margin-right: 4px;"></i> <?php echo htmlspecialchars($row['phone']); ?></div>
                    <?php endif; ?>
                </td>
                <td>
                    <div style="font-weight: 600; color: #444; max-width: 300px;"><?php echo htmlspecialchars($row['subject']); ?></div>
                    <div style="font-size: 12px; color: #999; margin-top: 4px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 300px;">
                        <?php echo htmlspecialchars($row['message']); ?>
                    </div>
                </td>
                <td>
                    <span class="badge <?php echo $status_class; ?>">
                        <?php echo $row['status'] ?: 'Pending'; ?>
                    </span>
                </td>
                <td style="text-align: right; white-space: nowrap;">
                    <?php if (!empty($row['cv_path'])): ?>
                        <a href="../<?php echo htmlspecialchars($row['cv_path']); ?>" class="btn-action" title="Download CV" target="_blank" style="color: #0ea5e9; border-color: #bae6fd; background: #f0f9ff;">
                            <i class="fas fa-file-pdf"></i>
                        </a>
                    <?php endif; ?>
                    
                    <button class="btn-action btn-view" title="View Details" onclick="showDetails(<?php echo htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8'); ?>)">
                        <i class="fas fa-eye"></i>
                    </button>
                    
                    <div style="display: inline-block; position: relative;" class="status-dropdown">
                        <button class="btn-action" title="Change Status" onclick="toggleStatusMenu(<?php echo $row['id']; ?>)">
                            <i class="fas fa-exchange-alt"></i>
                        </button>
                        <div id="status-menu-<?php echo $row['id']; ?>" class="status-dropdown-menu" style="display: none; position: absolute; right: 0; top: calc(100% + 5px); background: #fff; border-radius: 8px; border: 1px solid #eee; width: 160px; text-align: left; padding: 6px 0; overflow: hidden;">
                            <form method="POST" style="margin: 0;">
                                <input type="hidden" name="action" value="update_status">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
                                <button type="submit" name="status" value="Pending" class="status-menu-btn <?php echo ($row['status'] ?: 'Pending') == 'Pending' ? 'active' : ''; ?>" style="color: #856404;">
                                    <i class="fas fa-clock" style="width: 16px; margin-right: 8px; opacity: 0.7;"></i> Pending
                                </button>
                                <button type="submit" name="status" value="In Progress" class="status-menu-btn <?php echo $row['status'] == 'In Progress' ? 'active' : ''; ?>" style="color: #004085;">
                                    <i class="fas fa-spinner" style="width: 16px; margin-right: 8px; opacity: 0.7;"></i> In Progress
                                </button>
                                <button type="submit" name="status" value="Completed" class="status-menu-btn <?php echo $row['status'] == 'Completed' ? 'active' : ''; ?>" style="color: #155724;">
                                    <i class="fas fa-check-circle" style="width: 16px; margin-right: 8px; opacity: 0.7;"></i> Completed
                                </button>
                            </form>
                        </div>
                    </div>

                    <a href="inquiries.php?action=delete&id=<?php echo $row['id']; ?>&csrf_token=<?php echo generate_csrf_token(); ?>" 
                       class="btn-action btn-delete" 
                       title="Delete"
                       onclick="return confirm('Are you sure you want to delete this inquiry?');">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- View Modal -->
<div id="viewModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Inquiry Details</h3>
            <span class="modal-close" onclick="closeModal()">&times;</span>
        </div>
        <div class="modal-body" id="modalBody">
            <!-- Details loaded here -->
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeModal()" style="padding: 10px 20px; background: #6c757d; color: #fff; border: none; border-radius: 6px; cursor: pointer; font-weight: 600;">Close</button>
        </div>
    </div>
</div>

<script>
    function showDetails(data) {
        let body = document.getElementById('modalBody');
        body.innerHTML = `
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="detail-item">
                    <label>Full Name</label>
                    <div>${data.name || 'N/A'}</div>
                </div>
                <div class="detail-item">
                    <label>Company</label>
                    <div>${data.company || 'N/A'}</div>
                </div>
                <div class="detail-item">
                    <label>Email Address</label>
                    <div>${data.email || 'N/A'}</div>
                </div>
                <div class="detail-item">
                    <label>Phone Number</label>
                    <div>${data.phone || 'N/A'}</div>
                </div>
                <div class="detail-item">
                    <label>Country</label>
                    <div>${data.country || 'N/A'}</div>
                </div>
                <div class="detail-item">
                    <label>Submission Date</label>
                    <div>${new Date(data.created_at).toLocaleString()}</div>
                </div>
            </div>
            <div class="detail-item" style="margin-top: 10px; border-top: 1px solid #f0f0f0; padding-top: 20px;">
                <label>Subject</label>
                <div style="font-weight: 700; color: #000;">${data.subject || 'N/A'}</div>
            </div>
            ${data.cv_path ? `
            <div class="detail-item">
                <label>Attached CV</label>
                <div>
                    <a href="../${data.cv_path}" target="_blank" class="btn btn-outline-sm" style="display: inline-flex; align-items: center; gap: 8px; color: #ef4444; border-color: #fecaca; background: #fef2f2; padding: 8px 15px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 13px;">
                        <i class="fas fa-file-pdf"></i> Download Candidate CV
                    </a>
                </div>
            </div>
            ` : ''}
            <div class="detail-item">
                <label>Message</label>
                <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; white-space: pre-wrap; border: 1px solid #eee;">${data.message || 'N/A'}</div>
            </div>
        `;
        document.getElementById('viewModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('viewModal').style.display = 'none';
    }

    // Close modal on outside click
    window.onclick = function(event) {
        let modal = document.getElementById('viewModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    function toggleStatusMenu(id) {
        let menus = document.querySelectorAll('[id^="status-menu-"]');
        menus.forEach(m => {
            if (m.id !== 'status-menu-' + id) m.style.display = 'none';
        });
        
        let menu = document.getElementById('status-menu-' + id);
        if (menu.style.display === 'none') {
            menu.style.display = 'block';
            
            // Dynamic positioning: check if it overflows bottom
            let rect = menu.getBoundingClientRect();
            if (rect.bottom > window.innerHeight) {
                // Open upwards
                menu.style.top = 'auto';
                menu.style.bottom = 'calc(100% + 5px)';
            } else {
                // Open downwards
                menu.style.top = 'calc(100% + 5px)';
                menu.style.bottom = 'auto';
            }
        } else {
            menu.style.display = 'none';
        }
    }

    // Close dropdowns on outside click
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.status-dropdown')) {
            let menus = document.querySelectorAll('[id^="status-menu-"]');
            menus.forEach(m => m.style.display = 'none');
        }
    });
</script>

<?php include 'includes/admin-footer.php'; ?>
