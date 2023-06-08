<?php
use FFI\Exception;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Process form submission
  $fach = $_POST['fach'];

  require 'db-conn-aufgabe.php';

// Insert new category into the category table
$query = "INSERT INTO fach (name) VALUES (?)";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 's', $fach);

try {
    if (mysqli_stmt_execute($stmt)) {
        echo "New Fach added successfully!";
      } else {
        echo "Error uploading the Category";
      }
} catch(Throwable $e) {
    echo 'Failed.';
}

  

  mysqli_close($conn);
}
?>