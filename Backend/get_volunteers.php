<?php
require_once '../includes/db.php';
require_once 'user-auth.php';

$userId = $_SESSION['user_id'];
$query = "SELECT * FROM volunteers WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$volunteers = [];
while ($row = $result->fetch_assoc()) {
    $volunteers[] = $row;
}
header('Content-Type: application/json');
echo json_encode($volunteers);
$stmt->close();
$conn->close();
?>
// Loop through results or return as JSON