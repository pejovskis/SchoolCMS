<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $category = $_POST['category'];

require 'db-conn-aufgabe.php';

//insert new -kategorie- into the db
$query = "INSERT INTO category (name) VALUES (?)";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 's', $category);

try {
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('New Category added successfully!')</script>";
      }
} catch(Throwable $e) {
    echo "<script>alert('Error uploading the Category!')</script>";
}
  mysqli_close($conn);
}
?>