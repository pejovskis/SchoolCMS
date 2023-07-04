<?php

require 'check-super-login.php';

require 'db-conn-userss.php';

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    //Insert the new user in -users- sql
    $query = "INSERT INTO userss (email, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $email, $password);

    if (mysqli_stmt_execute($stmt)) {
        echo '<h6>New user registered successfully</h6>';
    } else {
        echo '<h6>Error registering new user</h6>';
    }
}

// Close the db connection
mysqli_close($conn);
?>