<?php
require_once 'includes/db-connect.php';
require_once 'includes/session-manager.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = sanitize_input($_POST['token'], $conn);
    $user_id = (int)$_POST['user_id'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    $errors = [];
    
    // Validate inputs
    if (empty($password)) $errors[] = "Password is required";
    if (strlen($password) < 8) $errors[] = "Password must be at least 8 characters";
    if ($password !== $confirm_password) $errors[] = "Passwords do not match";
    
    // Check token validity
    $stmt = $conn->prepare("SELECT id FROM users WHERE id = ? AND reset_token = ? AND reset_expiry > NOW()");
    $stmt->bind_param("is", $user_id, $token);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows !== 1) {
        $errors[] = "Invalid or expired token";
    }
    
    if (empty($errors)) {
        // Hash new password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Update password and clear reset token
        $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_expiry = NULL WHERE id = ?");
        $stmt->bind_param("si", $hashed_password, $user_id);
        
        if ($stmt->execute()) {
            $_SESSION['password_message'] = "Password updated successfully. You can now login with your new password.";
            header("Location: login.php");
            exit();
        } else {
            $errors[] = "Failed to update password. Please try again.";
        }
    }
    
    $_SESSION['reset_errors'] = $errors;
    header("Location: reset-password.php?token=$token");
    exit();
} else {
    header("Location: forgot-password.php");
    exit();
}
?>