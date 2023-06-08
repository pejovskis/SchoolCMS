<?php
// Define Users database credentials
$host = "localhost";
$user = "root";
$password = "";
$database = "users";

// Connect to the database
$conn = mysqli_connect($host, $user, $password, $database);

// Check for errors
if (mysqli_connect_errno()) {
    die("Failed to connect to the database: " . mysqli_connect_error());
}
?>