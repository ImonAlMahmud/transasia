<?php
$page_title = 'Admin Users';
$active_admin_page = 'users';
require_once 'includes/admin-header.php';

// Handle Actions
$success_msg = '';
$error_msg = '';

if (isset($_GET['action'])) {
    $id = $_GET['id'] ?? null;
    $action = $_GET['action'];
    $token = $_GET['csrf_token'] ?? '';

    if ($action === 'delete' && $id) {
        if (!validate_csrf_token($token)) {
            die('Security check failed.');
        }
        
        // Prevent deleting yourself
        if ($id == $_SESSION['admin_id']) {
            $error_msg = 'You cannot delete your own account.';
        } else {
            $stmt = $pdo->prepare("DELETE FROM admins WHERE id = ?");
            $stmt->execute([$id]);
            log_activity('Delete User', 'Deleted admin account ID: ' . $id);
            $success_msg = 'User deleted successfully.';
        }
    }
}

// Handle Edit/Add POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $csrf_token = $_POST['csrf_token'] ?? '';
    if (!validate_csrf_token($csrf_token)) {
        die('Security check failed.');
    }
    
    $action = $_POST['action'];
    $id = $_POST['user_id'] ?? null;
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    
    if ($action === 'add_user') {
        if (empty($username) || empty($email) || empty($new_password)) {
            $error_msg = 'All fields are required for new users.';
        } else {
            try {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO admins (username, email, password) VALUES (?, ?, ?)");
                $stmt->execute([$username, $email, $hashed_password]);
                log_activity('Add User', 'Created new admin account: ' . $username);
                $success_msg = 'New admin user created successfully.';
            } catch (Exception $e) {
                $error_msg = 'Error creating user: ' . $e->getMessage();
            }
        }
    } elseif ($action === 'edit_user' && $id) {
        try {
            if (!empty($new_password)) {
                // Update with new password
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("UPDATE admins SET username = ?, email = ?, password = ? WHERE id = ?");
                $stmt->execute([$username, $email, $hashed_password, $id]);
            } else {
                // Update without changing password
                $stmt = $pdo->prepare("UPDATE admins SET username = ?, email = ? WHERE id = ?");
                $stmt->execute([$username, $email, $id]);
            }
            log_activity('Edit User', 'Updated admin account ID: ' . $id);
            $success_msg = 'User updated successfully.';
        } catch (Exception $e) {
            $error_msg = 'Error updating user: ' . $e->getMessage();
        }
    }
}

// Fetch all admins
$stmt = $pdo->query("SELECT * FROM admins ORDER BY created_at DESC");
$admins = $stmt->fetchAll();
?>

<style>
    .admin-table th { background: #f8f9fa; color: #333; font-weight: 700; text-transform: uppercase; font-size: 12px; letter-spacing: 0.5px; padding: 15px; }
    .admin-table td { padding: 15px; vertical-align: middle; border-bottom: 1px solid #eee; }
    .badge { padding: 5px 10px; border-radius: 4px; font-size: 11px; font-weight: 600; text-transform: uppercase; }
    .badge-admin { background: #e0e7ff; color: #4338ca; }
    .btn-action { width: 32px; height: 32px; border-radius: 6px; border: 1px solid #ddd; background: #fff; color: #555; display: inline-flex; align-items: center; justify-content: center; transition: all 0.2s; cursor: pointer; text-decoration: none; margin-right: 5px; }
    .btn-action:hover { background: #f0f0f0; border-color: #bbb; color: #000; }
    .btn-delete:hover { background: #fee2e2; border-color: #fecaca; color: #dc3545; }
    .btn-edit:hover { background: #dbeafe; border-color: #bfdbfe; color: #1d4ed8; }
    
    /* Modal Styles */
    .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); overflow-y: auto; }
    .modal-content { background-color: #fefefe; margin: 5% auto; padding: 0; border: none; width: 500px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); overflow: hidden; position: relative; animation: modalSlide 0.3s ease-out; }
    @keyframes modalSlide { from { transform: translateY(-30px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
    .modal-header { padding: 20px 25px; background: #f8f9fa; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
    .modal-header h3 { margin: 0; font-size: 18px; color: #333; }
    .modal-close { font-size: 24px; color: #aaa; cursor: pointer; transition: color 0.2s; }
    .modal-close:hover { color: #333; }
    .modal-body { padding: 25px; }
    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; font-size: 13px; color: #555; font-weight: 600; margin-bottom: 8px; }
    .form-group input { width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; }
    .modal-footer { padding: 15px 25px; background: #f8f9fa; border-top: 1px solid #eee; text-align: right; display: flex; gap: 10px; justify-content: flex-end; }
    .avatar { width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 14px; }
</style>

<div class="content-card">
    <div class="card-header">
        <h2>Administrator Accounts <span style="font-size: 14px; font-weight: 400; color: #888; margin-left: 10px;">(<?php echo count($admins); ?> Total)</span></h2>
        <button class="btn btn-primary btn-sm" onclick="showAddModal()"><i class="fas fa-user-plus"></i> Add Admin</button>
    </div>
    
    <?php if ($success_msg): ?>
        <div style="background: #d4edda; color: #155724; padding: 12px 20px; border-radius: 8px; margin: 20px 20px 0; border: 1px solid #c3e6cb; font-size: 14px;">
            <i class="fas fa-check-circle" style="margin-right: 8px;"></i> <?php echo htmlspecialchars($success_msg); ?>
        </div>
    <?php endif; ?>
    
    <?php if ($error_msg): ?>
        <div style="background: #f8d7da; color: #721c24; padding: 12px 20px; border-radius: 8px; margin: 20px 20px 0; border: 1px solid #f5c6cb; font-size: 14px;">
            <i class="fas fa-exclamation-circle" style="margin-right: 8px;"></i> <?php echo htmlspecialchars($error_msg); ?>
        </div>
    <?php endif; ?>
    
    <table class="admin-table">
        <thead>
            <tr>
                <th>User</th>
                <th>Email Address</th>
                <th>Role</th>
                <th>Joined Date</th>
                <th style="text-align: right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($admins)): ?>
            <tr>
                <td colspan="5" style="text-align: center; padding: 80px; color: var(--text-muted);">
                    <i class="fas fa-users fa-4x" style="margin-bottom: 20px; display: block; opacity: 0.2;"></i>
                    No administrators found.
                </td>
            </tr>
            <?php endif; ?>
            <?php foreach ($admins as $user): ?>
            <tr>
                <td>
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div class="avatar"><?php echo strtoupper(substr($user['username'], 0, 2)); ?></div>
                        <div>
                            <div style="font-weight: 600; color: #333;"><?php echo htmlspecialchars($user['username']); ?></div>
                            <?php if ($user['id'] == $_SESSION['admin_id']): ?>
                            <small style="color: #10b981; font-weight: 600;"><i class="fas fa-check-circle" style="font-size: 10px;"></i> You</small>
                            <?php endif; ?>
                        </div>
                    </div>
                </td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td><span class="badge badge-admin">Super Admin</span></td>
                <td><?php echo date('M d, Y', strtotime($user['created_at'])); ?></td>
                <td style="text-align: right; white-space: nowrap;">
                    <button class="btn-action btn-edit" title="Edit User" onclick='showEditModal(<?php echo htmlspecialchars(json_encode($user), ENT_QUOTES, 'UTF-8'); ?>)'>
                        <i class="fas fa-edit"></i>
                    </button>
                    
                    <?php if ($user['id'] != $_SESSION['admin_id']): ?>
                    <a href="users.php?action=delete&id=<?php echo $user['id']; ?>&csrf_token=<?php echo generate_csrf_token(); ?>" 
                       class="btn-action btn-delete" 
                       title="Delete Account"
                       onclick="return confirm('Are you sure you want to delete this admin account? This action cannot be undone.');">
                        <i class="fas fa-trash"></i>
                    </a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="content-card" style="margin-top: 30px; padding: 30px;">
    <h3 style="margin-bottom: 15px;"><i class="fas fa-shield-alt" style="color: #2563eb; margin-right: 10px;"></i> Security Notice</h3>
    <p style="color: var(--text-muted); font-size: 14px; line-height: 1.6;">Only Super Admins can add or remove other administrators. All administrative actions are logged for security purposes. Ensure all users use strong, unique passwords.</p>
</div>

<!-- Add/Edit User Modal -->
<div id="userModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modalTitle">Add Administrator</h3>
            <span class="modal-close" onclick="closeModal()">&times;</span>
        </div>
        <form method="POST" id="userForm">
            <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
            <input type="hidden" name="action" id="formAction" value="add_user">
            <input type="hidden" name="user_id" id="userId" value="">
            
            <div class="modal-body">
                <div class="form-group">
                    <label>Username *</label>
                    <input type="text" name="username" id="username" required>
                </div>
                <div class="form-group">
                    <label>Email Address *</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="form-group">
                    <label id="passwordLabel">Password *</label>
                    <input type="password" name="new_password" id="new_password">
                    <small style="color: #888; font-size: 12px; display: block; margin-top: 5px;" id="passwordHint">Leave blank to keep current password</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal()" style="padding: 10px 20px; background: #6c757d; color: #fff; border: none; border-radius: 6px; cursor: pointer; font-weight: 600;">Cancel</button>
                <button type="submit" class="btn btn-primary" style="padding: 10px 20px; background: #2563eb; color: #fff; border: none; border-radius: 6px; cursor: pointer; font-weight: 600;"><i class="fas fa-save" style="margin-right: 5px;"></i> Save User</button>
            </div>
        </form>
    </div>
</div>

<script>
    function showAddModal() {
        document.getElementById('modalTitle').textContent = 'Add Administrator';
        document.getElementById('formAction').value = 'add_user';
        document.getElementById('userId').value = '';
        document.getElementById('username').value = '';
        document.getElementById('email').value = '';
        document.getElementById('new_password').value = '';
        document.getElementById('new_password').required = true;
        document.getElementById('passwordLabel').textContent = 'Password *';
        document.getElementById('passwordHint').style.display = 'none';
        document.getElementById('userModal').style.display = 'block';
    }
    
    function showEditModal(user) {
        document.getElementById('modalTitle').textContent = 'Edit Administrator';
        document.getElementById('formAction').value = 'edit_user';
        document.getElementById('userId').value = user.id;
        document.getElementById('username').value = user.username;
        document.getElementById('email').value = user.email;
        document.getElementById('new_password').value = '';
        document.getElementById('new_password').required = false;
        document.getElementById('passwordLabel').textContent = 'New Password (Optional)';
        document.getElementById('passwordHint').style.display = 'block';
        document.getElementById('userModal').style.display = 'block';
    }
    
    function closeModal() {
        document.getElementById('userModal').style.display = 'none';
    }
    
    // Close modal on outside click
    window.onclick = function(event) {
        let modal = document.getElementById('userModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

<?php include 'includes/admin-footer.php'; ?>
