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

<div class="container">
    <h2>Available Courses</h2>
    <div class="list-group">
        <?php foreach ($courses as $course): ?>
            <a href="#" class="list-group-item list-group-item-action">
                <h5 class="mb-1"><?php echo $course['name']; ?></h5>
                <p class="mb-1"><?php echo $course['description']; ?></p>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
