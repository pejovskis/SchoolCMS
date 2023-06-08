<?php

require 'check-super-login.php';

// Define database credentials
$host = "localhost";
$user = "root";
$password = "";
$database = "users";

// Connect to the database
$conn = mysqli_connect($host, $user, $password, $database);

// Check for errors
if (mysqli_connect_errno()) {
    die("Failed to connect to database: " . mysqli_connect_error());
}

// Check if the email and password values were passed as query parameters
if (isset($_POST['email']) && isset($_POST['password'])) {
    // Get the email and password values from the query parameters
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Construct the query to insert the new user into the database
    $query = "INSERT INTO users (email, password) VALUES (?, ?)";

    // Use a prepared statement to prevent SQL injection
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $email, $password);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        echo '<h6>New user registered successfully</h6>';
    } else {
        echo '<h6>Error registering new user</h6>';
    }
}

// Close the database connection
mysqli_close($conn);
?>