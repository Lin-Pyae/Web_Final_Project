<?php
include('../includes/db.php');
include('../includes/header.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 2) {
    header("Location: ../auth/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Insert message into the database
    $sql = "INSERT INTO messages (user_id, subject, message) VALUES ('$user_id', '$subject', '$message')";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Your message has been sent to the admin.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
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


.contact-box {
    background-color: #D3D3D3;
    border-radius: 10px;
    box-shadow: 0 4px 15px var(--shadow-color);  
    max-width: 600px;
    margin: auto;
    padding: 20px;
}

h2 {
    font-size: 28px;
    color: var(--primary-color);
    font-weight: bold;
    text-align: center;
}

.contact-box .form-control {
    border: 1px solid #ced4da;
    border-radius: 5px;
    padding: 10px;
    font-size: 16px;
}

.contact-box .form-control.shadow-sm {
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.contact-box .btn-primary {
    background-color: var(--primary-color);
    color: white;
    padding: 8px 16px;
    font-size: 16px;
    border-radius: 5px;
    transition: background-color 0.3s, box-shadow 0.3s;
    box-shadow: 0 2px 5px rgba(0, 123, 255, 0.3);
    width: auto;
}

.contact-box .btn-primary:hover {
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

<!-- Toggle Sidebar Button -->
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
                            <a class="nav-link" href="edit_profile.php">
                                <i class="bi bi-person"></i> Edit Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="contact_admin.php">
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
            <main class="col-md-9 ms-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Contact Admin</h1>
                </div>

                <div class="container my-5">
                    <div class="contact-box p-4">
                        <form action="contact_admin.php" method="POST">
                            <div class="form-group mb-4">
                                <label for="subject">Subject</label>
                                <input type="text" class="form-control shadow-sm" id="subject" name="subject" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="message">Message</label>
                                <textarea class="form-control shadow-sm" id="message" name="message" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary shadow">Send Message</button>
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
