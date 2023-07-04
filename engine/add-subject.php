<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //take -fach- from form
  $fach = $_POST['fach'];

  require 'db-conn-aufgabe.php';

//insert new -fach- into db
$query = "INSERT INTO fach (name) VALUES (?)";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 's', $fach);

//Throw out alert status
try {
  mysqli_stmt_execute($stmt);
  echo '<script>alert("Success!");</script>';
} catch(Throwable $e) {
  echo '<script>alert("Failed.");</script>';
}

mysqli_close($conn);
}

?>