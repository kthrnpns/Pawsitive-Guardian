<?php
require_once '../includes/db.php';
require_once '../admin/includes/admin-auth.php';

$requestId = $_POST['request_id'];
$newStatus = $_POST['status'];

$stmt = $conn->prepare("UPDATE adoption_requests SET status = ? WHERE id = ?");
$stmt->bind_param("si", $newStatus, $requestId);
$stmt->execute();

// Optionally log this admin action
$adminId = $_SESSION['user_id'];
$actionType = "update_adoption_request";
$desc = "Changed request ID $requestId to status '$newStatus'";
$logStmt = $conn->prepare("INSERT INTO admin_logs (admin_id, action_type, description) VALUES (?, ?, ?)");
$logStmt->bind_param("iss", $adminId, $actionType, $desc);
$logStmt->execute();