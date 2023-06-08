<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Process form submission
      $aufgabe_name = $_POST['aufgabe-name'];
      $beschreibung = $_POST['beschreibung'];
      $hinweis = $_POST['hinweis'];
      $fach = $_POST['fach'];
      $kategorie = $_POST['kategorie'];
      $new_kategorie = $_POST['new-kategorie'];

      require 'db-conn-aufgabe.php';

      if ($new_kategorie) {
        // Insert new kategorie into the database
        $query = "INSERT INTO aufgabe(name, beschreibung, hinweis, fach, kategorie) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'sssss', $aufgabe_name, $beschreibung, $hinweis, $fach, $new_kategorie);
      } else {
        // Use existing kategorie from the dropdown
        $query = "INSERT INTO aufgabe(name, beschreibung, hinweis, fach, kategorie) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'sssss', $aufgabe_name, $beschreibung, $hinweis, $fach, $kategorie);
      }

      if (mysqli_stmt_execute($stmt)) {
        echo "New exercise added successfully!";
      } else {
        echo "Error uploading the exercise";
      }

      mysqli_close($conn);
    }
  ?>