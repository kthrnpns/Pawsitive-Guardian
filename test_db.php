<?php
require_once 'includes/db-connect.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully to database: " . DB_NAME;
}
?>
test_db.php