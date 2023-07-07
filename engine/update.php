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

    deleteExerciseContent($id);

    addExerciseContentToDb();
    
}
