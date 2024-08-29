<?php
include('../includes/db.php');
session_start();

// Check if the user is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header("Location: ../auth/login.php");
    exit();
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    $sql = "DELETE FROM users WHERE id = $user_id";
    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php?msg=User deleted successfully");
    } else {
        echo "Error deleting user: " . $conn->error;
    }
}

$conn->close();
?>
