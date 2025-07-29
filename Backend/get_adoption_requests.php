<?php
require_once '../includes/db.php';
require_once 'user-auth.php';

$userId = $_SESSION['user_id'];

$query = "SELECT ar.*, p.name AS pet_name
          FROM adoption_requests ar
          LEFT JOIN cats p ON ar.pet_id = p.id
          WHERE ar.user_id = ?
          ORDER BY ar.timestamp DESC";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$adoptionRequests = [];

while ($row = $result->fetch_assoc()) {
    $adoptionRequests[] = $row;
}

// Example: Return JSON for use with AJAX or frontend display
header('Content-Type: application/json');
echo json_encode($adoptionRequests);

$stmt->close();
$conn->close();
?>