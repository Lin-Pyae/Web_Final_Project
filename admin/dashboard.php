<?php
include('../includes/db.php');
include('../includes/header.php');
session_start();

// Check if the user is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header("Location: ../auth/login.php");
    exit();
}

// Determine the filter type
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

// Fetch user data based on filter
if ($filter === 'this_week') {
    $sql = "SELECT * FROM users WHERE created_at BETWEEN '$start_date' AND '$end_date'";
} else {
    $sql = "SELECT * FROM users";
}
$result = $conn->query($sql);

// Fetch major data
$major_sql = "SELECT * FROM majors";
$major_result = $conn->query($major_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="../assets/js/bootstrap.bundle.min.js" defer></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        #sidebar {
            background-color: #343a40;
            min-height: 100vh;
            color: white;
        }
        #sidebar .nav-link {
            color: white;
        }
        #sidebar .nav-link.active {
            background-color: #495057;
            color: white;
        }
        .btn-outline-secondary:hover {
            background-color: #6c757d;
            color: white;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
        .form-control {
            border-radius: 0.25rem;
        }
        .btn-group .btn {
            margin-right: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar">
                <div class="position-sticky">
                    <h4 class="mt-3 text-center">Admin Panel</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="admin_dashboard.php">
                                <i class="fas fa-home"></i> Dashboard
                            </a>
                            <a class="nav-link" href="view_messages.php">
                                <i class="fas fa-envelope"></i> View Messages
                            </a>
                            <a class="nav-link" href="manage_majors.php">
                                <i class="fas fa-book"></i> Manage Majors
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <a href="export_users.php?filter=<?= $filter ?>" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-download"></i> Export
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12">
                        <h2>Manage Users</h2>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="searchInput" placeholder="Search by username or email">
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="userTableBody">
                                    <?php while($user = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?= $user['id'] ?></td>
                                            <td><?= $user['username'] ?></td>
                                            <td><?= $user['email'] ?></td>
                                            <td><?= $user['role_id'] == 1 ? 'Admin' : 'User' ?></td>
                                            <td><?= $user['is_active'] ? 'Active' : 'Inactive' ?></td>
                                            <td>
                                                    <a href="edit_user.php?id=<?= $user['id'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                                <a href="delete_user.php?id=<?= $user['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')"><i class="fas fa-trash-alt"></i> Delete</a>
                                                <?php if($user['is_active']): ?>
                                                    <a href="toggle_user.php?id=<?= $user['id'] ?>&action=disable" class="btn btn-secondary btn-sm"><i class="fas fa-ban"></i> Disable</a>
                                                <?php else: ?>
                                                    <a href="toggle_user.php?id=<?= $user['id'] ?>&action=enable" class="btn btn-success btn-sm"><i class="fas fa-check"></i> Enable</a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Custom JS for filtering the table -->
    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#userTableBody tr');
            rows.forEach(row => {            
                let username = row.cells[1].textContent.toLowerCase();
                let email = row.cells[2].textContent.toLowerCase();
                if (username.includes(filter) || email.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
