<?php
session_start();

// Check if the user is not logged in or is not an admin
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] || $_SESSION['email'] != 'superadmin@sa.com') {
  // Redirect the user to the login page or some other unauthorized page
  header('Location: unauthorized.php');
  exit;
}

?>