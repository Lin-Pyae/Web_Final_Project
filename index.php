<?php
include('includes/header.php');
session_start();
?>

<div class="jumbotron">
    <h1 class="display-4">Welcome to Student Registration System!</h1>
    <p class="lead">This is a simple student registration system with admin and user roles.</p>
    <hr class="my-4">
    <p>To get started, please login or register.</p>
    <a class="btn btn-primary btn-lg" href="auth/login.php" role="button">Login</a>
    <a class="btn btn-secondary btn-lg" href="auth/register.php" role="button">Register</a>
</div>

<?php include('includes/footer.php'); ?>
