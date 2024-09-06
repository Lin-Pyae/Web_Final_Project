<?php
include('../includes/db.php');
include('../includes/header.php');
session_start();

// Check if the user is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header("Location: ../auth/login.php");
    exit();
}

// Get user details for editing
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = $user_id";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $email = $_POST['email'];
    $role_id = $_POST['role_id'];
    $is_active = isset($_POST['is_active']) ? 1 : 0;

    // Update the user record
    $sql = "UPDATE users SET email = '$email', role_id = '$role_id', is_active = '$is_active' WHERE id = $user_id";
    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php"); // Redirect back to dashboard after updating
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f2f5;
        }
        .form-container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .form-container .btn-primary, .btn-secondary {
            width: 48%;
        }
        .form-container .btn-primary:hover {
            background-color: #0056b3;
        }
        .form-check-label {
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-container">
                    <h2>Edit User Information</h2>
                    <form method="POST" action="edit_user.php?id=<?= $user['id'] ?>">
                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">

                        <div class="form-group mb-3">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" name="email" value="<?= $user['email'] ?>" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="role_id">User Role</label>
                            <select class="form-control" name="role_id">
                                <option value="1" <?= $user['role_id'] == 1 ? 'selected' : '' ?>>Admin</option>
                                <option value="2" <?= $user['role_id'] == 2 ? 'selected' : '' ?>>Parent</option>
                                <option value="3" <?= $user['role_id'] == 3 ? 'selected' : '' ?>>Student</option>
                            </select>
                        </div>

                        <div class="form-group form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="is_active" <?= $user['is_active'] ? 'checked' : '' ?>>
                            <label class="form-check-label" for="is_active">
                                Active Account
                            </label>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Update User</button>
                            <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
