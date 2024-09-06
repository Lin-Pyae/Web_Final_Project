<?php
include('../includes/db.php');
include('../includes/header.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 2) {
    header("Location: ../auth/login.php");
    exit();
}

// Fetch courses (dummy data here; replace with actual course logic)
$courses = [
    ['id' => 1, 'name' => 'Web Development', 'description' => 'Learn HTML, CSS, JavaScript and PHP.'],
    ['id' => 2, 'name' => 'Data Science', 'description' => 'Learn Python, R, and machine learning concepts.'],
    // Add more courses as needed
];
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
.container-box {
    background-color: #D3D3D3;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); 
    padding: 30px;
    max-width: 800px;
    margin: auto;
}


h2 {
    font-weight: bold;
    color: #343a40;
    text-align: center;
    margin-bottom: 20px;
}


.list-group-item {
    background-color: #fff;
    border-radius: 10px;
    margin-bottom: 15px;
    border: 1px solid #e0e0e0;
    transition: transform 0.2s, box-shadow 0.2s;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); 
}

.list-group-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    background-color: #f1f1f1;
}

.list-group-item h5 {
    font-size: 18px;
    color: #007bff;
    font-weight: bold;
    margin-bottom: 10px;
}

.list-group-item p {
    font-size: 15px;
    color: #6c757d;
    margin-bottom: 0;
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
            <!-- Sidebar toggle button for small screens -->
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
                            <a class="nav-link active" href="view_courses.php">
                                <i class="bi bi-envelope"></i> View Courses
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">View Courses</h1>
                </div>

                <div class="container-box my-5 p-4">
                    <h2 class="text-center mb-4">Available Courses</h2>
                    <div class="list-group">
                        <?php foreach ($courses as $course): ?>
                            <a href="#" class="list-group-item list-group-item-action">
                                <h5 class="mb-1"><?php echo $course['name']; ?></h5>
                                <p class="mb-1"><?php echo $course['description']; ?></p>
                            </a>
                        <?php endforeach; ?>
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
