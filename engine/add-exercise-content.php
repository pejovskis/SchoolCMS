<?php

require '../engine/db-conn-aufgabe.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Process form submission
  $aufgabe_name = $_POST['aufgabe-name'];
  $beschreibung = $_POST['beschreibung'];
  $hinweis = $_POST['hinweis'];
  $fach = $_POST['fach'];
  $kategorie = $_POST['kategorie'];
  $new_kategorie = $_POST['new-kategorie'];
  $new_fach = $_POST['new-fach'];
  $current_date = date('Y-m-d');
 

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
  $query = "INSERT INTO aufgabe (name, beschreibung, hinweis, fach, kategorie, add_date) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, 'ssssss', $aufgabe_name, $beschreibung, $hinweis, $fach, $kategorie, $current_date);

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