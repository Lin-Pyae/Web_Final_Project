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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
     
:root {
    --primary-color: #007bff; /* Main blue color */
    --secondary-color: #6c757d; /* Grey */
    --light-color: #f8f9fa; /* Light grey background */
    --dark-color: #343a40; /* Dark for text */
    --hover-color: #0056b3; /* Hover effect */
}


#sidebar {
    background-color: var(--light-color);
    min-height: 100vh;
    padding: 20px;
    border-right: 1px solid var(--secondary-color);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); 
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

#sidebar .nav-link:hover, .nav-link.active {
    background-color: var(--primary-color);
    color: white;
    border-radius: 5px;
}


main {
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3); 
    padding: 20px;
    margin-top: 20px;
}


.border-bottom {
    border-color: var(--primary-color) !important;
}


h3 {
    color: var(--primary-color);
}

.profile-info p {
    font-size: 16px;
    color: var(--secondary-color);
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
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar toggle button for small screens -->
            <div class="sidebar-toggle">☰ Menu</div>

            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="position-sticky">
                    <h4 class="mt-3">User Panel</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="user_dashboard.php">
                                <i class="bi bi-house-door"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="edit_profile.php">
                                <i class="bi bi-person"></i> Edit Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact_admin.php">
                                <i class="bi bi-envelope"></i> Contact Admin
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="view_courses.php">
                                <i class="bi bi-envelope"></i> View Courses
                            </a>
                        </li> -->
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Welcome, <?php echo $user['username']; ?>!</h1>
                </div>

                <div class="row">
                    <div class="col-md-6 profile-info">
                        <h3>Profile Information</h3>
                        <p><strong>Username:</strong> <?php echo $user['username']; ?></p>
                        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
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
</body>
</html>


<?php include('../includes/footer.php'); ?>
