<?php
// /Backend/admin_get_all_adoption_requests.php
require_once '../includes/db.php';

$query = "SELECT ar.*, u.name AS user_name, c.name AS cat_name 
          FROM adoption_requests ar
          JOIN users u ON ar.user_id = u.id
          JOIN cats c ON ar.pet_id = c.id
          ORDER BY ar.timestamp DESC";

$result = $conn->query($query);

$requests = [];
while ($row = $result->fetch_assoc()) {
    $requests[] = $row;
}

header('Content-Type: application/json');
echo json_encode($requests);
?>