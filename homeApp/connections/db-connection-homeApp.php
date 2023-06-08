<?php 

    session_start();

    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "homeapp";

    $conn = mysqli_connect($host, $user, $password, $database);

    if(mysqli_connect_errno()) {
        die("Failed" . mysqli_connect_error());
    }

?>