<?php
session_start();

require 'db-conn-userss.php';

//Form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT * FROM userss WHERE email=?";
 
    //SQL Injection protect
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    //Query Successfull
    if ($result) {
        // Check User Exists
        if (mysqli_num_rows($result) == 1) {
            //Fetch User Data
            $row = mysqli_fetch_assoc($result);
            //Check password correct
            if (password_verify($password, $row['password'])) {
                $_SESSION['email'] = $row['email'];
                $_SESSION['logged_in'] = true;
                //Enter to teacher's main menu
                header('Location: ../sites/teacher-m-menu.php');
                exit;
            } else {
                echo '<div class="info">Invalid password</div>';
            }
        } else {
            // User does not exist
            echo '<div class="info">User not found</div>';
        }
    } else {
        // Query Error
        echo '<div class="info">Error executing query</div>';
    }
}
?>
