<?php
include('../includes/db.php');
session_start();

// Check if the user is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header("Location: ../auth/login.php");
    exit();
}

// Set headers for CSV download
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=users_export.csv');

// Open output stream
$output = fopen('php://output', 'w');

// Output column headings
fputcsv($output, ['ID', 'Username', 'Email', 'Role', 'Status']);

// Fetch user data from the database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

while ($user = $result->fetch_assoc()) {
    fputcsv($output, [
        $user['id'],
        $user['username'],
        $user['email'],
        $user['role_id'] == 1 ? 'Admin' : 'User',
        $user['is_active'] ? 'Active' : 'Inactive'
    ]);
}

// Close output stream
fclose($output);
?>
