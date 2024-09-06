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

</style>
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



<?php include('../includes/footer.php'); ?>
