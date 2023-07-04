<?php
use FFI\Exception;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Process form submission
  $category = $_POST['category'];

require 'db-conn-aufgabe.php';

// Insert new category into the category table
$query = "INSERT INTO category (name) VALUES (?)";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 's', $category);

try {
    if (mysqli_stmt_execute($stmt)) {
        echo "New Category added successfully!";
      } else {
        echo "Error uploading the Category";
      }
} catch(Throwable $e) {
    echo 'Failed.';
}

  

  mysqli_close($conn);
}

?>