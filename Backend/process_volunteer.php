<?php
session_start();
require_once 'db.php'; // assumes you have a working DB connection in this file

function sanitize($data, $conn) {
    return mysqli_real_escape_string($conn, trim($data));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = sanitize($_POST['firstName'], $conn);
    $lastName = sanitize($_POST['lastName'], $conn);
    $email = sanitize($_POST['email'], $conn);
    $phone = sanitize($_POST['phone'], $conn);
    $address = sanitize($_POST['address'], $conn);
    $skills = sanitize($_POST['skills'], $conn);
    $availability = sanitize($_POST['availability'], $conn);
    $reference = sanitize($_POST['reference'], $conn);

    // Combine checkbox values into comma-separated string
    $interests = isset($_POST['interest']) ? implode(", ", $_POST['interest']) : '';

    // Prepare SQL
    $stmt = $conn->prepare("INSERT INTO volunteers (
        first_name, last_name, email, phone, address, interests, skills, availability, reference_info
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param(
        "sssssssss",
        $firstName,
        $lastName,
        $email,
        $phone,
        $address,
        $interests,
        $skills,
        $availability,
        $reference
    );

    if ($stmt->execute()) {
        $_SESSION['success'] = "Thank you for applying to volunteer!";
        header("Location: volunteer.php?status=success");
    } else {
        $_SESSION['error'] = "There was a problem submitting your application.";
        header("Location: volunteer.php?status=error");
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: volunteer.php");
    exit();
}
