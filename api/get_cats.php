<?php
require_once '../includes/db-connect.php';
header('Content-Type: application/json');

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Get all filter parameters with proper array handling
$adoptionStatuses = isset($_GET['adoption']) ? (array)$_GET['adoption'] : [];
$genders = isset($_GET['gender']) ? (array)$_GET['gender'] : [];
$ages = isset($_GET['age']) ? (array)$_GET['age'] : [];
$colors = isset($_GET['color']) ? (array)$_GET['color'] : [];
$neuterStatuses = isset($_GET['neuter_status']) ? (array)$_GET['neuter_status'] : [];

// Map form values to database values
$adoptionMap = [
    'Available' => 'Available',
    'Pending Adoption' => 'Pending Adoption',
    'Foster Care' => 'Foster Care',
    'Not Available' => 'N/A' // Map form value to database value
];

$neuterMap = [
    'Neuter' => 'Neuter',
    'Spayed' => 'Spayed',
    'Unneuter' => 'Unneuter',
    'Unspayed' => 'Unspay' // Map form value to database value
];

// Prepare base query
$query = "SELECT * FROM cats WHERE 1=1";
$params = [];
$types = '';

// Adoption status filter
if (!empty($adoptionStatuses)) {
    $mappedStatuses = [];
    foreach ($adoptionStatuses as $status) {
        if (isset($adoptionMap[$status])) {
            $mappedStatuses[] = $adoptionMap[$status];
        }
    }
    
    if (!empty($mappedStatuses)) {
        $placeholders = implode(',', array_fill(0, count($mappedStatuses), '?'));
        $query .= " AND ADOPTION IN ($placeholders)";
        $params = array_merge($params, $mappedStatuses);
        $types .= str_repeat('s', count($mappedStatuses));
    }
}

// Gender filter
if (!empty($genders)) {
    $placeholders = implode(',', array_fill(0, count($genders), '?'));
    $query .= " AND GENDER IN ($placeholders)";
    $params = array_merge($params, $genders);
    $types .= str_repeat('s', count($genders));
}

// Age filter
if (!empty($ages)) {
    $placeholders = implode(',', array_fill(0, count($ages), '?'));
    $query .= " AND AGE IN ($placeholders)";
    $params = array_merge($params, $ages);
    $types .= str_repeat('s', count($ages));
}

// Color filter
if (!empty($colors)) {
    $placeholders = implode(',', array_fill(0, count($colors), '?'));
    $query .= " AND COLOR IN ($placeholders)";
    $params = array_merge($params, $colors);
    $types .= str_repeat('s', count($colors));
}

// Neuter status filter
if (!empty($neuterStatuses)) {
    $mappedNeuterStatuses = [];
    foreach ($neuterStatuses as $status) {
        if (isset($neuterMap[$status])) {
            $mappedNeuterStatuses[] = $neuterMap[$status];
        }
    }
    
    if (!empty($mappedNeuterStatuses)) {
        $placeholders = implode(',', array_fill(0, count($mappedNeuterStatuses), '?'));
        $query .= " AND `NEUTER STATUS` IN ($placeholders)";
        $params = array_merge($params, $mappedNeuterStatuses);
        $types .= str_repeat('s', count($mappedNeuterStatuses));
    }
}

// Add sorting
$query .= " ORDER BY 
    CASE 
        WHEN ADOPTION = 'Available' THEN 1
        WHEN ADOPTION = 'Pending Adoption' THEN 2
        WHEN ADOPTION = 'Foster Care' THEN 3
        ELSE 4
    END, NAME ASC";

// Prepare and execute
$stmt = $conn->prepare($query);
if ($params) {
    $stmt->bind_param($types, ...$params);
}

if (!$stmt->execute()) {
    http_response_code(500);
    echo json_encode(['error' => 'Database query failed: ' . $conn->error]);
    exit;
}

$result = $stmt->get_result();
$cats = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($cats);