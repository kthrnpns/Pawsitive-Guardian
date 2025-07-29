<?php
session_start();
require_once 'db.php';

// Helper to sanitize input
function sanitize_input($data, $conn) {
    return mysqli_real_escape_string($conn, trim($data));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = sanitize_input($_POST['email'], $conn);
    $password = sanitize_input($_POST['password'], $conn);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Please enter a valid email.";
        header("Location: login.php");
        exit();
    }

    // Check if user exists
    $stmt = $conn->prepare("SELECT id, first_name, last_name, password_hash, is_admin FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($userId, $firstName, $lastName, $hashedPassword, $isAdmin);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            // Successful login
            $_SESSION['user_id'] = $userId;
            $_SESSION['name'] = $firstName . ' ' . $lastName;
            $_SESSION['is_admin'] = $isAdmin;

            $stmt->close();
            $conn->close();

            // Redirect based on role
            if ($isAdmin) {
                header("Location: admin/dashboard.php");
            } else {
                header("Location: dashboard.php");
            }
            exit();
        } else {
            $_SESSION['error'] = "Incorrect password.";
        }
    } else {
        $_SESSION['error'] = "No account found with that email.";
    }

    $stmt->close();
    $conn->close();
    header("Location: login.php"); // Redirect back to login on failure
    exit();
} else {
    $_SESSION['error'] = "Invalid request method.";
    header("Location: login.php");
    exit();
}
