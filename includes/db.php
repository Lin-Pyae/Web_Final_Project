<?php
$servername = "localhost";
$username = "root"; // your database username
$password = "12345"; // your database password
$dbname = "student_registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>



