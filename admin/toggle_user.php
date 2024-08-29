<?php
include('../includes/db.php');
session_start();

// Check if the user is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header("Location: ../auth/login.php");
    exit();
}

if (isset($_GET['id']) && isset($_GET['action'])) {
    $user_id = $_GET['id'];
    $action = $_GET['action'];

    if ($action === 'enable') {
        $sql = "UPDATE users SET is_active = 1 WHERE id = $user_id";
    } elseif ($action === 'disable') {
        $sql = "UPDATE users SET is_active = 0 WHERE id = $user_id";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php?msg=User status updated successfully");
    } else {
        echo "Error updating user status: " . $conn->error;
    }
}

$conn->close();
?>
