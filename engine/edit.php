<?php
require 'db-conn-aufgabe.php';

// Check if the ID parameter is set in the URL
if (isset($_GET['id'])) {

  $id = $_GET['id'];
  $query = "SELECT * FROM aufgabe WHERE id =" . $id . ";";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);

  require '../sites/edit-form.php';
  
} else {
  echo "No ID parameter found.";
}

