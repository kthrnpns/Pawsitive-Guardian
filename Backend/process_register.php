<?php
session_start();
require_once 'db.php';

// Helper to sanitize input
function sanitize_input($data, $conn) {
    return mysqli_real_escape_string($conn, trim($data));
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize inputs
    $firstName = sanitize_input($_POST['firstName'], $conn);
    $lastName = sanitize_input($_POST['lastName'], $conn);
    $email = sanitize_input($_POST['email'], $conn);
    $password = sanitize_input($_POST['password'], $conn);
    $confirmPassword = sanitize_input($_POST['confirmPassword'], $conn);
    $phone = !empty($_POST['phone']) ? sanitize_input($_POST['phone'], $conn) : null;
    $address = !empty($_POST['address']) ? sanitize_input($_POST['address'], $conn) : null;

    // Validate essential fields
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
        header("Location: register.php");
        exit();
    }

    if (strlen($password) < 8) {
        $_SESSION['error'] = "Password must be at least 8 characters.";
        header("Location: register.php");
        exit();
    }

    if ($password !== $confirmPassword) {
        $_SESSION['error'] = "Passwords do not match.";
        header("Location: register.php");
        exit();
    }

    // Check if email already exists
    $checkStmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        $_SESSION['error'] = "Email is already registered.";
        header("Location: register.php");
        exit();
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user with split name fields
    $insertStmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password_hash, phone, address) VALUES (?, ?, ?, ?, ?, ?)");
    $insertStmt->bind_param("ssssss", $firstName, $lastName, $email, $hashedPassword, $phone, $address);

    if ($insertStmt->execute()) {
        $_SESSION['user_id'] = $insertStmt->insert_id;
        $_SESSION['name'] = $firstName . ' ' . $lastName;
        $_SESSION['is_admin'] = 0;

        // Clean up resources before redirect
        $checkStmt->close();
        $insertStmt->close();
        $conn->close();
        header("Location: index.php?register=success");
        exit();
    } else {
        // Clean up resources before redirect
        $checkStmt->close();
        $insertStmt->close();
        $conn->close();
        $_SESSION['error'] = "Registration failed: " . $insertStmt->error;
        header("Location: register.php");
        exit();
    }
} else {
    header("Location: register.php");
    exit();
}