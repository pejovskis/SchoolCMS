<?php

//Check if authorized user is logged in
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] || $_SESSION['email'] != 'superadmin@sa.com') {
  //failed results:
  header('Location: unauthorized.php');
  exit;
}

?>