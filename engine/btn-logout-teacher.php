<?php

// Check if the user clicked on the logout button
if (isset($_POST['logout'])) {
  // Destroy the session
  session_destroy();
  // Redirect the user to the login page
  header('Location: ../../index.php');
  exit;
}

?>