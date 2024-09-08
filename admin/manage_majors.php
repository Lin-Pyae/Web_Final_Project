<?php
include('../includes/db.php');
include('../includes/header.php');
session_start();

// Check if the user is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header("Location: ../auth/login.php");
    exit();
}

// Fetch major data
$major_sql = "SELECT * FROM majors";
$majors_result = $conn->query($major_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Majors</title>
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
        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
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
                            <a class="nav-link" href="dashboard.php">
                                <i class="fas fa-home"></i> Dashboard
                            </a>
                            <a class="nav-link" href="view_messages.php">
                                <i class="fas fa-envelope"></i> View Messages
                            </a>
                            <a class="nav-link active" href="manage_majors.php">
                                <i class="fas fa-book"></i> Manage Majors
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Manage Majors</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <a href="add_major.php" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus"></i> Add New Major
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Major Name</th>
                                        <!-- <th>Description</th> -->
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($major = $majors_result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?= $major['id'] ?></td>
                                            <td><?= $major['major_name'] ?></td>
                                            <!-- <td><?= $major['description'] ?></td> -->
                                            <td>
                                                <a href="edit_major.php?id=<?= $major['id'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                                <a href="delete_major.php?id=<?= $major['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this major?')"><i class="fas fa-trash-alt"></i> Delete</a>
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
</body>
</html>
