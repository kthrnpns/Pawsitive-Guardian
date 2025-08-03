<?php
require_once '../includes/db-connect.php';
require_once 'includes/admin-auth.php';

$query = "SELECT al.*, u.first_name, u.last_name FROM admin_logs al 
          JOIN users u ON al.admin_id = u.id ORDER BY timestamp DESC LIMIT 50";
$result = $conn->query($query);

$logStmt = $pdo->prepare("
    INSERT INTO admin_logs (admin_id, action, target_user_id, created_at)
    VALUES (?, 'add_cat', NULL, NOW())
");
$logStmt->execute([$_SESSION['user_id']]);