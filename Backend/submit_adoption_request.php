<?php
require_once '../includes/db.php';
session_start();

$userId = $_POST['user_id'];
$petId = $_POST['pet_id'];
$date = date('Y-m-d'); // You can also use created_at with CURRENT_TIMESTAMP in SQL

$status = 'pending';

$stmt = $conn->prepare("INSERT INTO adoption_requests (user_id, pet_id, status) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $userId, $petId, $status);

if ($stmt->execute()) {
    header("Location: ../adoption-success.php"); // Redirect after successful submission
    exit();
} else {
    echo "Error submitting request: " . $stmt->error;
}
?>
