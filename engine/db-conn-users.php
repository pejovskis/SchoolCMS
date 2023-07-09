<?php
//connection data
$host = "localhost";
$user = "root";
$password = "";
$database = "users";

$conn = mysqli_connect($host, $user, $password, $database);

//check errors
if (mysqli_connect_errno()) {
    die("Failed to connect to the database: " . mysqli_connect_error());
}
