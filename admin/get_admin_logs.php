<?php
require_once '../includes/db-connect.php';
require_once 'includes/admin-auth.php';

$query = "SELECT al.*, u.first_name, u.last_name FROM admin_logs al 
          JOIN users u ON al.admin_id = u.id ORDER BY timestamp DESC LIMIT 50";
$result = $conn->query($query);

// Return data however you prefer (JSON, HTML block, etc.)