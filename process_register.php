<?php
require_once __DIR__ . '/includes/db-connect.php';
require_once __DIR__ . '/includes/session-manager.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify CSRF token first
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $_SESSION['register_errors'] = ["Security token invalid. Please try again."];
        header("Location: " . (isset($_POST['admin_key']) ? 'admin_register.php' : 'register.php'));
        exit();
    }

    // Input filtering and validation
    $firstName = trim(filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING));
    $lastName = trim(filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING));
    $email = strtolower(trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)));
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';
    $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING));
    $address = trim(filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING));
    $adminNotes = trim(filter_input(INPUT_POST, 'adminNotes', FILTER_SANITIZE_STRING));
    $creator_id = $_POST['creator_id'] ?? null;
    
    $is_admin = 0;
    $errors = [];

    // Admin registration validation
    if (isset($_POST['admin_key'])) {
        // Verify admin token from session (not hardcoded)
        if (!isset($_SESSION['admin_reg_token']) || 
            !isset($_SESSION['admin_reg_token_expiry']) ||
            $_POST['admin_key'] !== $_SESSION['admin_reg_token'] ||
            time() > $_SESSION['admin_reg_token_expiry']) {
            $errors[] = "Admin registration token invalid or expired";
        } else {
            $is_admin = 1;
            // Stronger password requirements for admin
            if (strlen($password) < 12) $errors[] = "Admin password must be at least 12 characters";
            if (!preg_match("/[A-Z]/", $password)) $errors[] = "Password needs at least one uppercase letter";
            if (!preg_match("/[a-z]/", $password)) $errors[] = "Password needs at least one lowercase letter";
            if (!preg_match("/[0-9]/", $password)) $errors[] = "Password needs at least one number";
            if (!preg_match("/[^A-Za-z0-9]/", $password)) $errors[] = "Password needs at least one special character";
        }
    }

    // Common validation
    if (empty($firstName) || !preg_match('/^[A-Za-z \'-]{2,50}$/', $firstName)) {
        $errors[] = "Valid first name (2-50 letters) required";
    }
    if (empty($lastName) || !preg_match('/^[A-Za-z \'-]{2,50}$/', $lastName)) {
        $errors[] = "Valid last name (2-50 letters) required";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email address required";
    }
    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < ($is_admin ? 12 : 8)) {
        $errors[] = "Password must be at least ".($is_admin ? 12 : 8)." characters";
    }
    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match";
    }

    if (empty($errors)) {
        try {
            $conn->begin_transaction();
            
            // Check if email exists
            $check_stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $check_stmt->bind_param("s", $email);
            $check_stmt->execute();
            $result = $check_stmt->get_result();
            
            if ($result->num_rows > 0) {
                $errors[] = "Email already exists";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                
                // Modified to include admin_notes and creator_id
                $insert_stmt = $conn->prepare("INSERT INTO users 
                    (first_name, last_name, email, password, phone, address, is_admin, admin_notes, created_by) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $insert_stmt->bind_param("ssssssisi", $firstName, $lastName, $email, $hashedPassword, 
                                       $phone, $address, $is_admin, $adminNotes, $creator_id);
                
                if ($insert_stmt->execute()) {
                    $user_id = $insert_stmt->insert_id;
                    
                    if ($is_admin) {
                        // Log admin creation
                        $log_stmt = $conn->prepare("INSERT INTO admin_logs 
                            (admin_id, action, target_user_id, details) 
                            VALUES (?, ?, ?, ?)");
                        $details = "Created by admin ID: $creator_id";
                        $log_stmt->bind_param("isis", $_SESSION['user_id'], "create_admin", $user_id, $details);
                        $log_stmt->execute();
                        
                        // Clear the one-time token
                        unset($_SESSION['admin_reg_token']);
                        unset($_SESSION['admin_reg_token_expiry']);
                        
                        $conn->commit();
                        $_SESSION['register_success'] = "Admin account created successfully";
                        header("Location: admin_dashboard.php");
                    } else {
                        $conn->commit();
                        login_user($user_id);
                        header("Location: profile.php");
                    }
                    exit();
                } else {
                    $errors[] = "Registration failed. Please try again.";
                }
            }
        } catch (Exception $e) {
            $conn->rollback();
            error_log("Registration error: " . $e->getMessage());
            $errors[] = "System error. Please try again later.";
        }
    }

    $_SESSION['register_errors'] = $errors;
    header("Location: " . (isset($_POST['admin_key']) ? 'admin_register.php' : 'register.php'));
    exit();
}

header("Location: register.php");
exit();