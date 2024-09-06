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
/* Main color palette */
:root {
    --primary-color: #007bff; /* Main blue color */
    --secondary-color: #6c757d; /* Grey */
    --light-color: #f8f9fa; /* Light grey background */
    --dark-color: #343a40; /* Dark for text */
    --hover-color: #0056b3; /* Hover effect */
    --active-color: #0056b3; /* Active link color */
    --shadow-color: rgba(0, 0, 0, 0.2); /* Shadow effect */
}

/* Sidebar */
#sidebar {
    background-color: var(--light-color);
    min-height: 100vh;
    padding: 20px;
    border-right: 1px solid var(--secondary-color);
}

#sidebar h4 {
    color: var(--dark-color);
}

#sidebar .nav-link {
    color: var(--dark-color);
    margin: 10px 0;
    font-size: 18px;
    transition: background-color 0.3s, color 0.3s;
}

#sidebar .nav-link:hover {
    background-color: var(--primary-color);
    color: white;
    border-radius: 5px;
}

#sidebar .nav-link.active {
    background-color: var(--active-color);
    color: white;
    border-radius: 5px;
}
 /* Main content area */
 main {
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin-top: 20px;
}

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
    padding: 10px;s
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
    background-color: var(--hover-color);
    box-shadow: 0 4px 8px rgba(0, 123, 255, 0.4);
}
.sidebar-toggle {
    display: block;
    background-color: var(--primary-color);
    color: white;
    padding: 10px;
    text-align: center;
    cursor: pointer;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
}

    @media (max-width: 768px) {
        #sidebar {
            display: none;
        }

        main {
            margin-top: 0;
        }

    
        .sidebar-toggle {
            display: block;
        }
    }


    @media (min-width: 769px) {
        .sidebar-toggle {
            display: none;
        }
    }
</style>
<div class="container-fluid">
    <div class="row">
            <div class="sidebar-toggle">☰ Menu</div>
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="position-sticky">
                    <h4 class="mt-3">User Panel</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="user_dashboard.php">
                                <i class="bi bi-house-door"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="edit_profile.php">
                                <i class="bi bi-person"></i> Edit Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="contact_admin.php">
                                <i class="bi bi-envelope"></i> Contact Admin
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="view_courses.php">
                                <i class="bi bi-book"></i> View Courses
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Edit Profile</h1>
                </div>

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
            </main>
        </div>
    </div>
<script>
        // Sidebar toggle for small screens
        document.querySelector('.sidebar-toggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            if (sidebar.style.display === 'block') {
                sidebar.style.display = 'none';
            } else {
                sidebar.style.display = 'block';
            }
        });
    </script>

<?php include('../includes/footer.php'); ?>
