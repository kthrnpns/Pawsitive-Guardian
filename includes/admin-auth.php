<?php
require_once __DIR__ . '/session-manager.php';

function require_admin() {
    if (!is_admin()) {
        header("Location: ../login.php");
        exit();
    }
}