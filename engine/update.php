<?php
require 'db-conn-aufgabe.php';
require 'functions.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted form data
    $id = $_POST['id'];
    $name = $_POST['aufgabe-name'];
    $beschreibung = $_POST['beschreibung'];
    $hinweis = $_POST['hinweis'];
    $fach = $_POST['fach'];
    $kategorie = $_POST['kategorie'];

    // Perform the database update operation
    $query = "UPDATE aufgabe SET name=?, beschreibung=?, hinweis=?, fach=?, kategorie=? WHERE id=?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sssssi', $name, $beschreibung, $hinweis, $fach, $kategorie, $id);

    try {
        if ($stmt->execute()) {
            // Check if a file was uploaded
            if (isset($_FILES['excercise-file']) && $_FILES['excercise-file']['error'] === UPLOAD_ERR_OK) {
                // Retrieve the file details
                $exercise_file_name = $_FILES['excercise-file']['name'];
                $exercise_file_tmp = $_FILES['excercise-file']['tmp_name'];
                
                // Read file content
                $exercise_file_data = file_get_contents($exercise_file_tmp);
                
                // Update the pdf_file column in the database
                $update_query = "UPDATE aufgabe SET pdf_file=? WHERE id=?";
                $update_stmt = mysqli_prepare($conn, $update_query);
                mysqli_stmt_bind_param($update_stmt, 'si', $exercise_file_data, $id);
                $update_stmt->execute();
            }

            // Redirect after successful update
            echo '<script>alert("Exercise updated successfully!");</script>';
            echo '<script>window.location.href = "../sites/exercises.php";</script>';
        }
    } catch (Exception $e) {
        echo '<script>alert("Update failed! ' . $e->getMessage() . '");</script>';
    }
}

mysqli_close($conn);
