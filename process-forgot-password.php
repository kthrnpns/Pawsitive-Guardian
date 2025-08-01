<?php
require_once 'includes/db-connect.php';
require_once 'includes/session-manager.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitize_input($_POST['email'], $conn);
    
    // Check if email exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $token = bin2hex(random_bytes(32));
        $expiry = date('Y-m-d H:i:s', time() + 60 * 60); // 1 hour expiry
        
        // Store token in database
        $stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_expiry = ? WHERE id = ?");
        $stmt->bind_param("ssi", $token, $expiry, $user['id']);
        $stmt->execute();
        
        // In a real application, you would send an email with the reset link
        $reset_link = "http://yourdomain.com/reset-password.php?token=$token";
        
        // For now, we'll just store it in session to display
        $_SESSION['password_message'] = "Password reset link has been sent to your email. For demo purposes: <a href='$reset_link'>$reset_link</a>";
    } else {
        $_SESSION['password_message'] = "If that email exists in our system, we've sent a password reset link.";
    }
    
    header("Location: forgot-password.php");
    exit();
} else {
    header("Location: forgot-password.php");
    exit();
}
?>