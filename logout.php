<?php
require_once 'includes/session-manager.php';

// Clear remember me cookie if set
if (isset($_COOKIE['remember_token'])) {
    setcookie('remember_token', '', time() - 3600, '/');
    
    // Also clear from database
    require_once 'includes/db-connect.php';
    global $conn;
    
    $stmt = $conn->prepare("UPDATE users SET remember_token = NULL, token_expiry = NULL WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
}

// Logout user
logout_user();

// Redirect to login page
header("Location: login.php");
exit();
?>