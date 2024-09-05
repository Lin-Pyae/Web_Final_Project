<?php
include('../includes/db.php');
include('../includes/header.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($user['is_active']) { // Check if the user is active
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role_id'] = $user['role_id'];
                
                // Redirect based on role
                if ($_SESSION['role_id'] == 1) {
                    header("Location: ../admin/dashboard.php");
                } else {
                    header("Location: ../user/user_dashboard.php");
                }
                exit();
            } else {
                echo "<div class='alert alert-danger'>Invalid credentials.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Your account is disabled. Please contact the admin.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>No user found.</div>";
    }
}
?>

<form action="login.php" method="POST">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>

<?php include('../includes/footer.php'); ?>