<?php
require_once 'includes/init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF Protection
    $csrf_token = $_POST['csrf_token'] ?? '';
    if (!validate_csrf_token($csrf_token)) {
        header("Location: contact.php?status=error&msg=Security check failed. Please refresh the page.");
        exit;
    }

    $name = $_POST['name'] ?? '';
    $company = $_POST['company'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $country = $_POST['country'] ?? '';
    $form_type = $_POST['form_type'] ?? 'employer';
    $subject = $_POST['subject'] ?? 'New Website Inquiry';
    $message = $_POST['message'] ?? '';

    $cv_path = null;

    // 1. Handle CV Upload for Job Seekers
    if ($form_type === 'jobseeker' && isset($_FILES['cv']) && $_FILES['cv']['error'] !== UPLOAD_ERR_NO_FILE) {
        $file = $_FILES['cv'];
        $allowed_ext = ['pdf'];
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];

        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (!in_array($file_ext, $allowed_ext)) {
            header("Location: contact.php?status=error&msg=Only PDF files are allowed for CV upload.");
            exit;
        }

        if ($file_error !== UPLOAD_ERR_OK) {
            header("Location: contact.php?status=error&msg=Error uploading file.");
            exit;
        }

        if ($file_size > 5 * 1024 * 1024) { // 5MB limit
            header("Location: contact.php?status=error&msg=CV file size exceeds 5MB limit.");
            exit;
        }

        $upload_dir = 'uploads/cvs/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $new_file_name = uniqid('cv_', true) . '.' . $file_ext;
        $destination = $upload_dir . $new_file_name;

        if (move_uploaded_file($file_tmp, $destination)) {
            $cv_path = $destination;
        } else {
            header("Location: contact.php?status=error&msg=Failed to save uploaded CV.");
            exit;
        }
    }

    if (empty($name) || empty($email) || empty($message)) {
        header("Location: contact.php?status=error&msg=Missing required fields");
        exit;
    }

    try {
        // 1. Store in Database
        $stmt = $pdo->prepare("INSERT INTO inquiries (name, company, email, phone, country, subject, message, cv_path) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $company, $email, $phone, $country, $subject, $message, $cv_path]);

        // 2. Prepare Email Notification for Admin
        $admin_email = get_setting('primary_email', 'info@transasia.ltd');
        $site_name = get_setting('site_name', 'TransAsia');
        
        $email_subject = "[$site_name] New Inquiry from $name";
        $email_body = "
            <html>
            <head><title>New Contact Inquiry</title></head>
            <body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
                <div style='max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 10px;'>
                    <h2 style='color: #0056b3; border-bottom: 2px solid #0056b3; padding-bottom: 10px;'>New Website Inquiry</h2>
                    <p><strong>Type:</strong> " . ucfirst($form_type) . "</p>
                    <p><strong>Name:</strong> $name</p>
                    <p><strong>Email:</strong> $email</p>
                    <p><strong>Phone:</strong> $phone</p>
                    <p><strong>Company:</strong> $company</p>
                    <p><strong>Country:</strong> " . ucfirst($country) . "</p>
                    <p><strong>Subject:</strong> $subject</p>
                    <div style='background: #f9f9f9; padding: 15px; border-radius: 5px; margin-top: 15px;'>
                        <strong>Message:</strong><br>
                        " . nl2br(htmlspecialchars($message)) . "
                    </div>
                    <p style='font-size: 12px; color: #777; margin-top: 30px; border-top: 1px solid #eee; padding-top: 10px;'>
                        This message was sent from the contact form on $site_name.
                    </p>
                </div>
            </body>
            </html>
        ";

        // 3. Send Email
        send_email($admin_email, $email_subject, $email_body);

        // Redirect with success
        header("Location: contact.php?status=success");
        exit;

    } catch (Exception $e) {
        header("Location: contact.php?status=error&msg=" . urlencode($e->getMessage()));
        exit;
    }
} else {
    header("Location: contact.php");
    exit;
}
