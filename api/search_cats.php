<?php
require_once '../includes/db-connect.php';
header('Content-Type: application/json');

$searchTerm = $_GET['q'] ?? '';
if (empty($searchTerm)) {
    echo json_encode([]);
    exit;
}

// Get adoption status filters if provided
$adoptionStatuses = isset($_GET['adoption']) ? (array)$_GET['adoption'] : ['Available', 'Pending Adoption', 'Foster Care'];

// Prepare the search term
$searchTerm = '%' . $searchTerm . '%';

// Base query with adoption status filter
$query = "SELECT * FROM cats WHERE 
          (NAME LIKE ? OR COLOR LIKE ? OR `MEDICAL_NOTES` LIKE ?)";
$params = [$searchTerm, $searchTerm, $searchTerm];
$types = 'sss';

// Add adoption status filter if provided
if (!empty($adoptionStatuses)) {
    $placeholders = implode(',', array_fill(0, count($adoptionStatuses), '?'));
    $query .= " AND ADOPTION IN ($placeholders)";
    $params = array_merge($params, $adoptionStatuses);
    $types .= str_repeat('s', count($adoptionStatuses));
}

// Add sorting
$query .= " ORDER BY 
    CASE 
        WHEN ADOPTION = 'Available' THEN 1
        WHEN ADOPTION = 'Pending Adoption' THEN 2
        WHEN ADOPTION = 'Foster Care' THEN 3
        ELSE 4
    END, NAME ASC";

$stmt = $conn->prepare($query);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();
$cats = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($cats);