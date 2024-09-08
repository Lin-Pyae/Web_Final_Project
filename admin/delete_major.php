<?php
include('../includes/db.php');
include('../includes/header.php');
session_start();

// Check if the user is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header("Location: ../auth/login.php");
    exit();
}

$major_id = $_GET['id'];

$sql = "DELETE FROM majors WHERE id = $major_id";
if ($conn->query($sql)) {
    header("Location: dashboard.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}
?>
