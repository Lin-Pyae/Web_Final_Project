<?php
include('../includes/db.php');
include('../includes/header.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 2) {
    header("Location: ../auth/login.php");
    exit();
}

// Fetch user information
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    
    if (!empty($new_password)) {
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        $sql = "UPDATE users SET email = '$email', password = '$hashed_password' WHERE id = $user_id";
    } else {
        $sql = "UPDATE users SET email = '$email' WHERE id = $user_id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Profile updated successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error updating profile: " . $conn->error . "</div>";
    }
}
?>
<style>
    
.edit-profile-box {
    background-color: #D3D3D3;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); 
    max-width: 600px;
    margin: auto;
    padding: 20px;
}


.edit-profile-box .form-control {
    border: 1px solid #ced4da;
    border-radius: 5px;
    padding: 10px;
    font-size: 16px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}


.edit-profile-box .btn-primary {
    background-color: #337af4;
    color: white;
    padding: 8px 16px;
    font-size: 16px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 123, 255, 0.3); 
    transition: background-color 0.3s, box-shadow 0.3s;
}

.edit-profile-box .btn-primary:hover {
    background-color: #84b0c5;
    box-shadow: 0 4px 8px rgba(0, 123, 255, 0.4);
}

</style>

<div class="container my-5">
    <h2 class="text-center mb-4">Edit Profile</h2>
    <div class="edit-profile-box p-4">
        <form action="edit_profile.php" method="POST">
            <div class="form-group mb-4">
                <label for="email">Email</label>
                <input type="email" class="form-control shadow-sm" id="email" name="email" value="<?php echo $user['email']; ?>" required>
            </div>
            <div class="form-group mb-4">
                <label for="new_password">New Password (Leave blank if not changing)</label>
                <input type="password" class="form-control shadow-sm" id="new_password" name="new_password">
            </div>
            <button type="submit" class="btn btn-primary shadow">Update Profile</button>
        </form>
    </div>
</div>


<?php include('../includes/footer.php'); ?>
