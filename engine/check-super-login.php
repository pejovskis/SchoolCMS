<?php

//Check if authorized user is logged in
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] || $_SESSION['status_level'] != 9) {
  //failed results:
  header('Location: unauthorized.php');
  exit;
}

?>