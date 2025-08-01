<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// For admin pages, check is_admin flag
if (strpos($_SERVER['REQUEST_URI'], '/admin/') !== false && !$_SESSION['is_admin']) {
    header("Location: ../dashboard.php");
    exit();
}
?>