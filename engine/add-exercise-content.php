<?php

require '../engine/db-conn-aufgabe.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Process form submission
  $aufgabe_name = $_POST['aufgabe-name'];
  $beschreibung = $_POST['beschreibung'];
  $hinweis = $_POST['hinweis'];
  $fach = $_POST['fach'];
  $kategorie = $_POST['kategorie'];
  $new_kategorie = isset($_POST['new-kategorie']) ? $_POST['new-kategorie'] : null;
  $new_fach = isset($_POST['new-fach']) ? $_POST['new-fach'] : null;
  $current_date = date('Y-m-d');
  
  // Retrieve the file details
  $excercise_file_name = $_FILES['excercise-file']['name'];
  $excercise_file_tmp = $_FILES['excercise-file']['tmp_name'];

  $excercise_file_data = file_get_contents($excercise_file_tmp);

  $current_userId = intval($_SESSION['id']);
 

  //if new category is selected change the main var > $kategorie, 
  //because this one is inserted into the specific table into the db 
  //first and binded in the query later
  if ($new_kategorie) {
    $query = "INSERT INTO category (name) VALUES (?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $new_kategorie);
    mysqli_stmt_execute($stmt);
    $kategorie = $new_kategorie;
  }

  //Same for $fach as for $kategorie
  if ($new_fach) {
    $query = "INSERT INTO fach (name) VALUES (?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $new_fach);
    mysqli_stmt_execute($stmt);
    $fach = $new_fach;
  }

  try {
  //Insert the new exercise in the -aufgabe- table
  $query = "INSERT INTO aufgabe (name, beschreibung, hinweis, fach, kategorie, add_date, added_by, pdf_file) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, 'ssssssss', $aufgabe_name, $beschreibung, $hinweis, $fach, $kategorie, $current_date, $current_userId, $excercise_file_data);

  if (mysqli_stmt_execute($stmt)) {
    echo "<script>alert('New exercise added successfully!')</script>";
  } else {
    echo "<script>alert('Error uploading the exercise')</script>";
  }
  mysqli_close($conn);

  } catch (Exception $e) {
    echo "FAILED";
  }
 
}
?>