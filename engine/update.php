<?php

require 'db-conn-aufgabe.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $beschreibung = $_POST['beschreibung'];
    $hinweis = $_POST['hinweis'];
    $fach = $_POST['fach'];
    $kategorie = $_POST['kategorie'];

    // Perform the database update operation
    // Replace 'your_table_name', 'column1', 'column2', and 'your_connection' with your actual table and column names, and database connection variable
    $query = "UPDATE aufgabe SET name=?, beschreibung=?, hinweis=?, fach=?, kategorie=? WHERE id=" . $id;

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sssss', $name, $beschreibung, $hinweis, $fach, $kategorie);
    
    try {
        if (mysqli_stmt_execute($stmt)) {
            echo '<script>alert("Update successful!");</script>';
            echo '<script>window.setTimeout(function() { window.location.href = "../sites/exercises.php"; }, 100);</script>';
        }
    } catch (Exception $e) {
        echo '<script>alert("Update failed!");</script>';
    }
    
}
