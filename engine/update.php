<?php
require 'db-conn-exercises.php';
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $name = $_POST['exercise-name'];
        $description = $_POST['description'];
        $hint = $_POST['hint'];
        $subject = $_POST['subject'];
        $category = $_POST['category'];
        $current_date = date('Y-m-d');

        if(!empty($_POST['new-subject'])) {
            $newSubject = $_POST['new-subject'];
            $subject = $newSubject;
        }
        
        if(!empty($_POST['new-category'])) {
            $newCategory = $_POST['new-category'];
            $category = $newCategory;
        }

        $query = "UPDATE exercise SET name=?, description=?, hint=?, subject=?, category=?, add_date=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'sssssss', $name, $description, $hint, $subject, $category, $current_date, $id);

        try {
            if ($stmt->execute()) {
                //Check if a file was uploaded
                if (isset($_FILES['excercise-file']) && $_FILES['excercise-file']['error'] === UPLOAD_ERR_OK) {
                    // Retrieve the file details
                    $exercise_file_name = $_FILES['excercise-file']['name'];
                    $exercise_file_tmp = $_FILES['excercise-file']['tmp_name'];
                    //Read file content
                    $exercise_file_data = file_get_contents($exercise_file_tmp);
                    //Update the pdf_file column in DB
                    $update_query = "UPDATE exercise SET pdf_file=? WHERE id=?";
                    $update_stmt = mysqli_prepare($conn, $update_query);
                    mysqli_stmt_bind_param($update_stmt, 'si', $exercise_file_data, $id);
                    $update_stmt->execute();
                }

                //Redirect if successful update
                echo '<script>alert("Exercise updated successfully!");</script>';
                echo '<script>window.location.href = "../sites/exercises.php";</script>';
            }
        } catch (Exception $e) {
            echo '<script>alert("Update failed! ' . $e->getMessage() . '");</script>';
        }
        //Delete Exercise
    } else if (isset($_POST['delete'])) {
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
