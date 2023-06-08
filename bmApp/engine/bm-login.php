<?php
// Start a session to store user data
session_start();

require '../connections/db-conn-bmusers.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the submitted email and password
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Construct the query to retrieve the user from the database
    $query = "SELECT * FROM users WHERE email=?";
 
    // Use a prepared statement to prevent SQL injection
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    // Get the result of the query
    $result = mysqli_stmt_get_result($stmt);

    // Check if the query was successful
    if ($result) {
        // Check if the user exists in the database
        if (mysqli_num_rows($result) == 1) {
            // Fetch the user data from the result
            $row = mysqli_fetch_assoc($result);

            // Check if the password matches
            if (password_verify($password, $row['password'])) {
                // Password is correct
                $_SESSION['email'] = $row['email'];
                $_SESSION['logged_in'] = true;
                header('Location: ../sites/teacher-m-menu.php');
                exit;
            } else {
                // Password is incorrect
                echo '<div class="info">Invalid password</div>';
            }
        } else {
            // User does not exist
            echo '<div class="info">User not found</div>';
        }
    } else {
        // Query failed
        echo '<div class="info">Error executing query</div>';
    }
}
?>
