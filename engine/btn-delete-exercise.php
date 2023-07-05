<?php
require '../engine/db-conn-aufgabe.php';

// Fetch data for $row from the database
// Replace the database query with your own code
$query = "SELECT * FROM aufgabe WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $exerciseId);
$exerciseId = $_GET['id']; // Assuming the exercise id is passed as a parameter
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if($_SESSION['id'] === $row['added_by'] || $_SESSION['status_level'] > 2) {
        echo '<button> DELETE </button>';
    }
}
?>