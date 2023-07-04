<?php
//Check if authorized user is logged in
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
  //false, result:
  header('Location: unauthorized.php');
  exit;
}

?>