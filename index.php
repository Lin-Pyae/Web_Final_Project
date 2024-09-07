<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assests/css/index.css">
</head>
<body>
    <!-- <nav class="navbar navbar-expand-lg fixed-top">
        <a class="navbar-brand" href="#">Student Registration</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <?php if(isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/LAP3/Final%20Project/auth/logout.php">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="auth/login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="auth/register.php">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav> -->

    <div class="container mt-4 content">
        <img src="assests/img/MIT-removebg-preview.png" alt="MIT">
        <h1 class="display-4">Welcome to Student Registration System!</h1>
        <p class="lead">This is a simple student registration system with admin and user roles.</p>
        <hr class="my-4">
        <p>To get started, please login or register.</p>
        <div class="button-container">
            <a class="btn btn-primary btn-lg" href="auth/login.php" role="button">Login</a>
            <a class="btn btn-secondary btn-lg" href="auth/register.php" role="button">Register</a>
        </div>
    </div>

    <footer class="footer mt-auto py-3">
        <div class="container">
            <span class="text">&copy; 2024 Student Registration System</span>
        </div>
    </footer>
</body>
</html>
