<?php
include('../includes/db.php');
include('../includes/header.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 2) {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user information
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

// Fetch major registration information
$sql = "SELECT majors.major_name, registrations.year FROM registrations 
        JOIN majors ON registrations.major_id = majors.id 
        WHERE registrations.user_id = $user_id";
$major_result = $conn->query($sql);
$major = $major_result->fetch_assoc();
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

        .profile-info {
            background-color: #D3D3D3;
            border-radius: 10px;
            box-shadow: 0 4px 15px var(--shadow-color);
            padding: 20px;
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
            <!-- Toggle Sidebar Button -->
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
                        <li class="nav-item">
                            <a class="nav-link" href="register_major.php">
                                <i class="bi bi-book"></i> Register Major
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h1>
                </div>

                <div class="row">
                    <div class="col-md-6 profile-info">
                        <h3>Profile Information</h3>
                        <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                    </div>
                </div>

                <!-- Display Registered Major -->
                <div class="row">
                    <div class="col-md-12">
                        <h3>Registered Major</h3>
                        <?php if ($major) { ?>
                            <p><strong>Major:</strong> <?php echo htmlspecialchars($major['major_name']); ?></p>
                            <p><strong>Year:</strong> <?php echo htmlspecialchars($major['year']); ?></p>
                        <?php } else { ?>
                            <p>You have not registered for a major yet.</p>
                        <?php } ?>
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
