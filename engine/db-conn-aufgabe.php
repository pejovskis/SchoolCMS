<?php

// Perform Aufgabe DB insert
$host = "localhost";
$user = "root";
$password = "";
$database = "aufgaben";

$conn = mysqli_connect($host, $user, $password, $database);

if (mysqli_connect_errno()) {
  die("Failed to connect to the Database" . mysqli_connect_errno());
}

?>