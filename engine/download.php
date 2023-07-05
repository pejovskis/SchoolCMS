<?php
require 'db-conn-aufgabe.php';

//Get the exercise ID from the query string
$exerciseId = $_GET['id'];

//Retrieve the file data from the database based on the exercise ID
$query = "SELECT name, pdf_file FROM aufgabe WHERE id = " . $exerciseId;
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $pdfData = $row['pdf_file'];
  $exercise_name = $row['name'];

  // Set the appropriate headers for the file download
  header('Content-type: application/octet-stream');
  header("Content-type: application/pdf");
  header("Content-Disposition: attachment; filename=" . $exercise_name . ".pdf");
  while (ob_get_level()) {
      ob_end_clean();
  }
  echo $pdfData;
} else {
  echo "Exercise not found.";
}

// Close the database connection (optional)
mysqli_close($conn);

