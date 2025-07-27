<?php
session_start();

// Check if user is logged in
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

// Redirect if not logged in
function require_login() {
    if (!is_logged_in()) {
        header("Location: login.php");
        exit();
    }
}

// Check if user is admin
function is_admin() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
}

// Redirect if not admin
function require_admin() {
    require_login();
    if (!is_admin()) {
        header("Location: dashboard.php");
        exit();
    }
}

// Login function
function login_user($user_id, $email, $role = 'user') {
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_email'] = $email;
    $_SESSION['user_role'] = $role;
}

// Logout function
function logout_user() {
    session_unset();
    session_destroy();
}
?>