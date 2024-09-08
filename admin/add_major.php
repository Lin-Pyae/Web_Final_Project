<?php
include('../includes/db.php');
include('../includes/header.php');
session_start();

// Check if the user is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header("Location: ../auth/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $major_name = $_POST['major_name'];

    $sql = "INSERT INTO majors (major_name) VALUES ('$major_name')";
    if ($conn->query($sql)) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Major</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Add Major</h1>
        <form method="post" action="add_major.php">
            <div class="mb-3">
                <label for="major_name" class="form-label">Major Name</label>
                <input type="text" class="form-control" id="major_name" name="major_name" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Major</button>
        </form>
    </div>
</body>
</html>
