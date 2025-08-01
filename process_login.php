<?php
require_once __DIR__ . '/includes/db-connect.php';
require_once __DIR__ . '/includes/session-manager.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify CSRF token first
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $_SESSION['login_errors'] = ["Security token invalid. Please try again."];
        header("Location: login.php");
        exit();
    }

    // Input validation
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);

    $errors = [];

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required";
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    }

    // Login attempt throttling
    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 0;
        $_SESSION['last_attempt_time'] = time();
    }

    // Reset attempts if more than 5 minutes have passed
    if (time() - $_SESSION['last_attempt_time'] > 300) {
        $_SESSION['login_attempts'] = 0;
    }

    if ($_SESSION['login_attempts'] >= 5) {
        $errors[] = "Too many attempts. Please try again later.";
    }

    if (empty($errors)) {
        try {
            $stmt = $conn->prepare("SELECT id, password, is_admin FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();
                
                if (password_verify($password, $user['password'])) {
                    login_user($user['id'], $user['is_admin']);
                    $_SESSION['login_attempts'] = 0; // Reset on success

                    if ($remember) {
                        $token = bin2hex(random_bytes(32));
                        $expiry = date('Y-m-d H:i:s', time() + 30 * 24 * 60 * 60);
                        
                        $update_stmt = $conn->prepare("UPDATE users SET remember_token = ?, token_expiry = ? WHERE id = ?");
                        $update_stmt->bind_param("ssi", $token, $expiry, $user['id']);
                        $update_stmt->execute();
                        
                        setcookie('remember_token', $token, [
                            'expires' => time() + 30 * 24 * 60 * 60,
                            'path' => '/',
                            'secure' => isset($_SERVER['HTTPS']),
                            'httponly' => true,
                            'samesite' => 'Strict'
                        ]);
                    }

                    header("Location: dashboard_users.php");
                    exit();
                }
            }

            // Increment failed attempts
            $_SESSION['login_attempts']++;
            $_SESSION['last_attempt_time'] = time();
            $errors[] = "Invalid email or password";

        } catch (Exception $e) {
            error_log("Login error: " . $e->getMessage());
            $errors[] = "System error. Please try again later.";
        }
    }

    $_SESSION['login_errors'] = $errors;
    header("Location: login.php");
    exit();
}

header("Location: login.php");
exit();