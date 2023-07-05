<?php
require 'db-conn-aufgabe.php';

// Check if the ID parameter is set in the URL
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Fetch the row from the database based on the ID
  // Replace 'your_database_name' with the actual name of your database
  $query = "SELECT * FROM aufgabe WHERE id =" . $id . ";";
  // Prepare and execute the query using your database connection
  // Replace 'your_connection' with your actual database connection variable
  $result = mysqli_query($conn, $query);
  
  $row = mysqli_fetch_assoc($result);

  // Include the file containing the form code
  require 'edit-form.php';
} else {
  echo "No ID parameter found.";
}
?>
