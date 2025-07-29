<?php
// /Backend/admin_get_all_donations.php
require_once '../includes/db.php';

$query = "SELECT d.*, u.name AS user_name FROM donations d
          JOIN users u ON d.user_id = u.id
          ORDER BY d.timestamp DESC";

$result = $conn->query($query);
$donations = [];
while ($row = $result->fetch_assoc()) {
    $donations[] = $row;
}

header('Content-Type: application/json');
echo json_encode($donations);
?>