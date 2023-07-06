<?php
require '../engine/db-conn-aufgabe.php';

if (isset($_GET['id'])) {
    $exerciseId = $_GET['id'];

    // Fetch data for $row from the database
    $query = "SELECT * FROM aufgabe WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $exerciseId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($_SESSION['id'] === $row['added_by'] || $_SESSION['status_level'] > 2) {
            echo '<form method="POST">
                <button class="btn btn-danger" name="delete" type="submit"> DELETE </button>
             </form>';
        }
    }
}

if (isset($_POST['delete'])) {
    $exerciseId = $_GET['id'];

    // Perform the delete operation
    $query = "DELETE FROM aufgabe WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $exerciseId);
    $stmt->execute();

    // Check if the delete operation was successful
    if ($stmt->affected_rows > 0) {
        // Delete successful
        echo "<script>alert('Exercise deleted successfully!') </script>";
        echo '<script>window.setTimeout(function() { window.location.href = "../sites/exercises.php"; }, 100);</script>';
    } else {
        // Delete failed
        echo "Failed to delete row.";
    }
}

$conn->close();
?>
