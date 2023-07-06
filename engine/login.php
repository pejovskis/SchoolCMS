<?php
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
                $_SESSION['id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['logged_in'] = true;
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['last_name'] = $row['last_name'];
                $_SESSION['status_level'] = $row['status_level'];
                $currUserLevel = intval($row['status_level']);

                switch($currUserLevel) {
                    case 1:
                        header('Location: ../sites/student-m-menu.php');
                        break;
                    case 2:
                        header('Location: ../sites/teacher-m-menu.php');
                        break;
                    case 9:
                        header('Location: ../sites/teacher-m-menu.php');
                        break;
                }
                exit;
            } else {
                echo '<script>alert("Invalid password")</script>';
            }
        } else {
            //User does not exist
            echo '<script>alert("User not found")</script>';
        }
    } else {
        //Query Error
        echo '<script>alert("Error executing query")</script>';
    }
}
?>
