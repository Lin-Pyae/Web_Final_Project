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
   
.contact-box {
    background-color: #D3D3D3;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);  
    max-width: 600px;
    margin: auto;
    padding: 20px;
}


h2 {
    font-size: 28px;
    color: var(--primary-color);
    font-weight: bold;
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
    background-color: #337af4;
    color: white;
    padding: 8px 16px; 
    font-size: 16px; 
    border-radius: 5px;
    transition: background-color 0.3s, box-shadow 0.3s;
    box-shadow: 0 2px 5px rgba(0, 123, 255, 0.3); 
    width: auto; 
}


.contact-box .btn-primary:hover {
    background-color: #84b0c5;
    box-shadow: 0 4px 8px rgba(0, 123, 255, 0.4); 
}


@media (max-width: 768px) {
    .contact-box {
        width: 90%;
        padding: 15px;
    }
}

</style>
<div class="container my-5">
    <h2 class="text-center mb-4">Contact Admin</h2>
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


<?php include('../includes/footer.php'); ?>
