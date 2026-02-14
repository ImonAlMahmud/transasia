<?php
$page_title = 'Global Offices';
$active_admin_page = 'offices';
require_once 'includes/admin-header.php';

// Handle Actions
$success_msg = '';
$error_msg = '';

// Delete Office
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $csrf_token = $_GET['csrf_token'] ?? '';
    if (!validate_csrf_token($csrf_token)) {
        die('Security check failed.');
    }
    
    $id = intval($_GET['id']);
    $stmt = $pdo->prepare("DELETE FROM global_offices WHERE id = ?");
    $stmt->execute([$id]);
    log_activity('Delete Office', 'Deleted global office ID: ' . $id);
    $success_msg = 'Office deleted successfully.';
}

// Add/Edit Office (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf_token = $_POST['csrf_token'] ?? '';
    if (!validate_csrf_token($csrf_token)) {
        die('Security check failed.');
    }
    
    $action = $_POST['action'] ?? '';
    $id = $_POST['office_id'] ?? null;
    $office_name = $_POST['office_name'] ?? '';
    $address = $_POST['address'] ?? '';
    $icon = $_POST['icon'] ?? 'fas fa-building';
    $display_order = intval($_POST['display_order'] ?? 0);
    $is_active = isset($_POST['is_active']) ? 1 : 0;
    
    if ($action === 'add_office') {
        try {
            $stmt = $pdo->prepare("INSERT INTO global_offices (office_name, address, icon, display_order, is_active) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$office_name, $address, $icon, $display_order, $is_active]);
            log_activity('Add Office', 'Created new office: ' . $office_name);
            $success_msg = 'Office added successfully.';
        } catch (Exception $e) {
            $error_msg = 'Error adding office: ' . $e->getMessage();
        }
    } elseif ($action === 'edit_office' && $id) {
        try {
            $stmt = $pdo->prepare("UPDATE global_offices SET office_name = ?, address = ?, icon = ?, display_order = ?, is_active = ? WHERE id = ?");
            $stmt->execute([$office_name, $address, $icon, $display_order, $is_active, $id]);
            log_activity('Edit Office', 'Updated office ID: ' . $id);
            $success_msg = 'Office updated successfully.';
        } catch (Exception $e) {
            $error_msg = 'Error updating office: ' . $e->getMessage();
        }
    }
}

// Fetch all offices
$stmt = $pdo->query("SELECT * FROM global_offices ORDER BY display_order ASC");
$offices = $stmt->fetchAll();
?>

<style>
    .office-card { background: #f8f9fa; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0; }
    .badge-active { background: #d4edda; color: #155724; padding: 4px 10px; border-radius: 4px; font-size: 11px; font-weight: 600; }
    .badge-inactive { background: #f8d7da; color: #721c24; padding: 4px 10px; border-radius: 4px; font-size: 11px; font-weight: 600; }
</style>

<div class="content-card">
    <div class="card-header">
        <h2>Global Offices <span style="font-size: 14px; font-weight: 400; color: #888; margin-left: 10px;">(<?php echo count($offices); ?> Total)</span></h2>
        <button class="btn btn-primary btn-sm" onclick="showAddModal()"><i class="fas fa-plus"></i> Add Office</button>
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
    
    <div style="padding: 30px;">
        <?php if (empty($offices)): ?>
            <div style="text-align: center; padding: 80px; color: var(--text-muted);">
                <i class="fas fa-building fa-4x" style="margin-bottom: 20px; display: block; opacity: 0.2;"></i>
                No offices found. Start by adding one!
            </div>
        <?php else: ?>
            <div style="display: grid; gap: 20px;">
                <?php foreach ($offices as $office): ?>
                <div class="office-card">
                    <div style="display: flex; justify-content: space-between; align-items: start;">
                        <div style="flex-grow: 1;">
                            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                                <div style="width: 40px; height: 40px; border-radius: 50%; background: #0056b3; color: white; display: flex; align-items: center; justify-content: center;">
                                    <i class="<?php echo htmlspecialchars($office['icon']); ?>"></i>
                                </div>
                                <div>
                                    <h3 style="margin: 0; font-size: 18px; color: #333;"><?php echo htmlspecialchars($office['office_name']); ?></h3>
                                    <span class="<?php echo $office['is_active'] ? 'badge-active' : 'badge-inactive'; ?>">
                                        <?php echo $office['is_active'] ? 'Active' : 'Inactive'; ?>
                                    </span>
                                </div>
                            </div>
                            <p style="margin: 0; color: #666; line-height: 1.6;"><?php echo htmlspecialchars($office['address']); ?></p>
                            <small style="color: #888; display: block; margin-top: 8px;">Display Order: <?php echo $office['display_order']; ?></small>
                        </div>
                        <div style="display: flex; gap: 10px; margin-left: 20px;">
                            <button class="btn-action btn-edit" title="Edit Office" onclick='showEditModal(<?php echo htmlspecialchars(json_encode($office), ENT_QUOTES, 'UTF-8'); ?>)'>
                                <i class="fas fa-edit"></i>
                            </button>
                            <a href="?action=delete&id=<?php echo $office['id']; ?>&csrf_token=<?php echo generate_csrf_token(); ?>" 
                               class="btn-action btn-delete" 
                               title="Delete Office"
                               onclick="return confirm('Are you sure you want to delete this office?');">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Add/Edit Office Modal -->
<div id="officeModal" class="modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); overflow-y: auto;">
    <div class="modal-content" style="background-color: #fefefe; margin: 5% auto; padding: 0; border: none; width: 500px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); overflow: hidden;">
        <div class="modal-header" style="padding: 20px 25px; background: #f8f9fa; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">
            <h3 id="modalTitle" style="margin: 0; font-size: 18px; color: #333;">Add Office</h3>
            <span class="modal-close" onclick="closeModal()" style="font-size: 24px; color: #aaa; cursor: pointer;">&times;</span>
        </div>
        <form method="POST" id="officeForm">
            <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
            <input type="hidden" name="action" id="formAction" value="add_office">
            <input type="hidden" name="office_id" id="officeId" value="">
            
            <div class="modal-body" style="padding: 25px;">
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-size: 13px; color: #555; font-weight: 600; margin-bottom: 8px;">Office Name *</label>
                    <input type="text" name="office_name" id="officeName" required style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px;">
                </div>
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-size: 13px; color: #555; font-weight: 600; margin-bottom: 8px;">Address *</label>
                    <textarea name="address" id="officeAddress" required style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; min-height: 80px;"></textarea>
                </div>
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-size: 13px; color: #555; font-weight: 600; margin-bottom: 8px;">Icon (FontAwesome Class)</label>
                    <input type="text" name="icon" id="officeIcon" value="fas fa-building" style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px;">
                    <small style="color: #888; font-size: 12px; display: block; margin-top: 5px;">e.g., fas fa-building, fas fa-map-marker-alt</small>
                </div>
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-size: 13px; color: #555; font-weight: 600; margin-bottom: 8px;">Display Order</label>
                    <input type="number" name="display_order" id="displayOrder" value="0" style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px;">
                </div>
                <div style="margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                    <input type="checkbox" name="is_active" id="isActive" checked style="width: 18px; height: 18px;">
                    <label for="isActive" style="font-weight: 600; font-size: 15px; cursor: pointer; margin: 0;">Active</label>
                </div>
            </div>
            <div class="modal-footer" style="padding: 15px 25px; background: #f8f9fa; border-top: 1px solid #eee; text-align: right; display: flex; gap: 10px; justify-content: flex-end;">
                <button type="button" class="btn btn-secondary" onclick="closeModal()" style="padding: 10px 20px; background: #6c757d; color: #fff; border: none; border-radius: 6px; cursor: pointer; font-weight: 600;">Cancel</button>
                <button type="submit" class="btn btn-primary" style="padding: 10px 20px; background: #2563eb; color: #fff; border: none; border-radius: 6px; cursor: pointer; font-weight: 600;"><i class="fas fa-save" style="margin-right: 5px;"></i> Save Office</button>
            </div>
        </form>
    </div>
</div>

<script>
    function showAddModal() {
        document.getElementById('modalTitle').textContent = 'Add Office';
        document.getElementById('formAction').value = 'add_office';
        document.getElementById('officeId').value = '';
        document.getElementById('officeName').value = '';
        document.getElementById('officeAddress').value = '';
        document.getElementById('officeIcon').value = 'fas fa-building';
        document.getElementById('displayOrder').value = '0';
        document.getElementById('isActive').checked = true;
        document.getElementById('officeModal').style.display = 'block';
    }
    
    function showEditModal(office) {
        document.getElementById('modalTitle').textContent = 'Edit Office';
        document.getElementById('formAction').value = 'edit_office';
        document.getElementById('officeId').value = office.id;
        document.getElementById('officeName').value = office.office_name;
        document.getElementById('officeAddress').value = office.address;
        document.getElementById('officeIcon').value = office.icon;
        document.getElementById('displayOrder').value = office.display_order;
        document.getElementById('isActive').checked = office.is_active == 1;
        document.getElementById('officeModal').style.display = 'block';
    }
    
    function closeModal() {
        document.getElementById('officeModal').style.display = 'none';
    }
    
    window.onclick = function(event) {
        let modal = document.getElementById('officeModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

<?php include 'includes/admin-footer.php'; ?>
