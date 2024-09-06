<?php
include('../includes/db.php');
include('../includes/header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role_id = 2; // Default to 'user' role

    // Check if the username or email already exists
    $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='alert alert-danger'>Username or Email already exists. Please choose another.</div>";
    } else {
        // Insert the new user if no duplicates found
        $sql = "INSERT INTO users (username, email, password, role_id) VALUES ('$username', '$email', '$password', $role_id)";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>Registration successful!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
        }
    }
}
?>
<style>
    /* Register Box Styling */
    .register-box {
        background-color: #D3D3D3;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Noticeable shadow */
        max-width: 500px;
        margin: auto;
        padding: 20px;
    }

    /* Form Input */
    .register-box .form-control {
        border: 1px solid #ced4da;
        border-radius: 5px;
        padding: 10px;
        font-size: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* Light shadow for inputs */
    }

    /* Button Styling */
    .register-box .btn-primary {
        background-color: #337af4;
        color: white;
        padding: 8px 16px;
        font-size: 16px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 123, 255, 0.3); /* Button shadow */
        transition: background-color 0.3s, box-shadow 0.3s;
    }

    .register-box .btn-primary:hover {
        background-color: #042264;
        box-shadow: 0 4px 8px rgba(0, 123, 255, 0.4); /* Increased shadow on hover */
    }
</style>
<div class="container my-5">
    <h2 class="text-center mb-4">Register</h2>
    <div class="register-box p-4">
        <form action="register.php" method="POST">
            <div class="form-group mb-4">
                <label for="username">Username</label>
                <input type="text" class="form-control shadow-sm" id="username" name="username" required>
            </div>
            <div class="form-group mb-4">
                <label for="email">Email</label>
                <input type="email" class="form-control shadow-sm" id="email" name="email" required>
            </div>
            <div class="form-group mb-4">
                <label for="password">Password</label>
                <input type="password" class="form-control shadow-sm" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary shadow">Register</button>
        </form>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
