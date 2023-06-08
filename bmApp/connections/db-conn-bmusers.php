<?php
    session_start();

    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "bmusers";

    $conn = mysqli_connect($host, $user, $password, $database);

    if(mysqli_connect_errno()){
        die("failed. Reason: " . mysqli_connect_error());
    }
?>