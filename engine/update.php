<?php
require 'db-conn-aufgabe.php';
require 'functions.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        // Update operation
        // Get the submitted form data
        $id = $_POST['id'];
        $name = $_POST['aufgabe-name'];
        $beschreibung = $_POST['beschreibung'];
        $hinweis = $_POST['hinweis'];
        $fach = $_POST['fach'];
        $kategorie = $_POST['kategorie'];
        $current_date = date('Y-m-d');

        // Perform the database update operation
        // Perform the database update operation
$query = "UPDATE aufgabe SET name=?, beschreibung=?, hinweis=?, fach=?, kategorie=?, add_date=? WHERE id=?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'sssssss', $name, $beschreibung, $hinweis, $fach, $kategorie, $current_date, $id);

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

    } else if (isset($_POST['delete'])) {
        // Check if the exercise ID is provided
        if (isset($_POST['id'])) {
            $exerciseId = $_POST['id'];

            deleteExerciseContent($exerciseId);
            echo '<script>alert("Exercise deleted successfully!");</script>';
            echo '<script>window.location.href = "../sites/exercises.php";</script>';
        } else {
            echo '<script>alert("Delete Failed!");</script>';
        }
    }
}

mysqli_close($conn);
