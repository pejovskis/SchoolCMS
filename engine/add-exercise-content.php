<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Process form submission
  $aufgabe_name = $_POST['aufgabe-name'];
  $beschreibung = $_POST['beschreibung'];
  $hinweis = $_POST['hinweis'];
  $fach = $_POST['fach'];
  $kategorie = $_POST['kategorie'];
  $new_kategorie = $_POST['new-kategorie'];
  $new_fach = $_POST['new-fach'];
  //date
  $current_date = date('Y-m-d');
 

  if ($new_kategorie) {
    // Insert new category into the category table
    $query = "INSERT INTO category (name) VALUES (?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $new_kategorie);
    mysqli_stmt_execute($stmt);

    // Get the inserted category name
    $kategorie = $new_kategorie;
  }

  if ($new_fach) {
    // Insert new fach into the fach table
    $query = "INSERT INTO fach (name) VALUES (?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $new_fach);
    mysqli_stmt_execute($stmt);

    // Get the inserted fach name
    $fach = $new_fach;
  }

  try {
     // Insert new exercise into the aufgabe table
  $query = "INSERT INTO aufgabe (name, beschreibung, hinweis, fach, kategorie, add_date) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, 'ssssss', $aufgabe_name, $beschreibung, $hinweis, $fach, $kategorie, $current_date);

  if (mysqli_stmt_execute($stmt)) {
    echo "New exercise added successfully!";
  } else {
    echo "Error uploading the exercise";
  }
  mysqli_close($conn);

  } catch (Exception $e) {
    echo "FAILED";
  }

 
}
?>