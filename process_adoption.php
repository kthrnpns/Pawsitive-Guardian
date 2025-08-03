<?php
require_once 'includes/db-connect.php';
require_once 'includes/session-manager.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: adoption.php");
    exit();
}

// Process form data
$catId = $_POST['cat_id'] ?? 0;
$adopterName = $_POST['full_name'] ?? '';
$adopterEmail = $_POST['email'] ?? '';
$adopterPhone = $_POST['mobile'] ?? '';
$adopterAddress = $_POST['address'] ?? '';
$adopterOccupation = $_POST['occupation'] ?? '';
$neuterDate = $_POST['neuter_date'] ?? null;
$lastVaccineDate = $_POST['last_vaccine_date'] ?? null;
$otherVaccines = $_POST['other_vaccines'] ?? 'no';
$vaccineTypes = $_POST['vaccine_types'] ?? '';

// Handle signature upload
$signaturePath = '';
if (isset($_FILES['signature']) && $_FILES['signature']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'uploads/signatures/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    
    $extension = pathinfo($_FILES['signature']['name'], PATHINFO_EXTENSION);
    $filename = uniqid('signature_') . '.' . $extension;
    $destination = $uploadDir . $filename;
    
    if (move_uploaded_file($_FILES['signature']['tmp_name'], $destination)) {
        $signaturePath = $destination;
    }
}

// Get cat details
$stmt = $conn->prepare("SELECT NAME, COLOR, GENDER FROM cats WHERE id = ?");
$stmt->bind_param("i", $catId);
$stmt->execute();
$result = $stmt->get_result();
$cat = $result->fetch_assoc();

if (!$cat) {
    $_SESSION['error'] = "Invalid cat selected for adoption";
    header("Location: adoption.php");
    exit();
}

// Insert into database
$stmt = $conn->prepare("
    INSERT INTO adoption_agreements (
        cat_id, adopter_name, adopter_email, adopter_phone, adopter_address, 
        adopter_occupation, pet_name, pet_color, pet_gender, neuter_date, 
        last_vaccine_date, other_vaccines, vaccine_types, signature_path, adoption_date
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, CURDATE())
");

$stmt->bind_param(
    "isssssssssssss", 
    $catId, $adopterName, $adopterEmail, $adopterPhone, $adopterAddress,
    $adopterOccupation, $cat['NAME'], $cat['COLOR'], $cat['GENDER'], $neuterDate,
    $lastVaccineDate, $otherVaccines, $vaccineTypes, $signaturePath
);

if ($stmt->execute()) {
    // Update cat status
    $conn->query("UPDATE cats SET ADOPTION = 'Pending Adoption' WHERE id = $catId");
    
    $_SESSION['success'] = "Adoption application submitted successfully!";
    header("Location: adoption-success.php");
} else {
    $_SESSION['error'] = "Error submitting adoption application: " . $conn->error;
    header("Location: adoption-form.php?cat_id=$catId");
}

$stmt->close();
$conn->close();
exit();