<?php
require_once '../db.php';

$result = $conn->query("SELECT * FROM volunteers ORDER BY submitted_at DESC");

echo "<h2>Volunteer Applications</h2>";
echo "<table border='1' cellpadding='8'>";
echo "<tr><th>Name</th><th>Email</th><th>Phone</th><th>Interests</th><th>Submitted</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) . "</td>";
    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
    echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
    echo "<td>" . htmlspecialchars($row['interests']) . "</td>";
    echo "<td>" . $row['submitted_at'] . "</td>";
    echo "</tr>";
}

echo "</table>";
$conn->close();
?>
