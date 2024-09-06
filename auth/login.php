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
            var_dump(password_verify($password, $user['password']));
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
<style>
    /* Login Box Styling */
.login-box {
    background-color: #D3D3D3;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Noticeable shadow */
    max-width: 500px;
    margin: auto;
    padding: 20px;
}

/* Form Input */
.login-box .form-control {
    border: 1px solid #ced4da;
    border-radius: 5px;
    padding: 10px;
    font-size: 16px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* Light shadow for inputs */
}

/* Button Styling */
.login-box .btn-primary {
    background-color: #337af4;
    color: white;
    padding: 8px 16px;
    font-size: 16px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 123, 255, 0.3); /* Button shadow */
    transition: background-color 0.3s, box-shadow 0.3s;
}

.login-box .btn-primary:hover {
    background-color: #042264;
    box-shadow: 0 4px 8px rgba(0, 123, 255, 0.4); /* Slightly increased shadow on hover */
}

</style>
<div class="container my-5">
<h2 class="text-center mb-4">Log in</h2>
    <div class="login-box p-4">
        <form action="login.php" method="POST">
            <div class="form-group mb-4">
                <label for="username">Username</label>
                <input type="text" class="form-control shadow-sm" id="username" name="username" required>
            </div>
            <div class="form-group mb-4">
                <label for="password">Password</label>
                <input type="password" class="form-control shadow-sm" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary shadow">Login</button>
        </form>
    </div>
</div>


<?php include('../includes/footer.php'); ?>