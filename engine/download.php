<?php
require 'db-conn-exercises.php';

//Get the exercise ID from the query string
$exerciseId = $_GET['id'];

$query = "SELECT name, pdf_file FROM exercise WHERE id = " . $exerciseId;
$result = mysqli_query($conn, $query);

//Download the file if it exists
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
  echo '<script>
    const response = confirm("Do you like to download ' . $exercise_name . '?");
    if (response) {
        window.location.href = "' . $pdfData . '";
    } else {
        window.location.href = "../sites/exercises.pdf";
    }
</script>';
} else {
  echo '<script>alert("Exercise not found.")</script>';
}

mysqli_close($conn);
