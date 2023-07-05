<?php

require 'check-super-login.php';

require 'db-conn-userss.php';

if ((isset($_POST['email']) && 
    isset($_POST['password']) && 
    isset($_POST['first-name']) && 
    isset($_POST['last-name']) && 
    isset($_POST['status-level']) )) {
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $first_name = $_POST['first-name'];
        $last_name = $_POST['last-name'];
        $status_level = $_POST['status-level'];

        //Check for empty fields
        if (empty($email) || empty($password) || empty($first_name) || empty($last_name) || empty($status_level)) {
            echo '<script>alert("Please fill in all required fields.")</script>';
            exit;
        }

        //Insert the new user in -users- sql
        $query = "INSERT INTO userss (email, password, first_name, last_name, status_level) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssss", $email, $password, $first_name, $last_name, $status_level);

        if (mysqli_stmt_execute($stmt)) {
            echo '<script>alert("New user registered successfully")</script>';
        } else {
            echo '<script>alert("Error registering new user")</script>';
        }
}

// Close the db connection
mysqli_close($conn);
?>