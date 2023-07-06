<?php
//logout-btn clicked
if (isset($_POST['logout'])) {
  session_destroy();
  //redirect to log in menu
  echo '<script>alert(' . "User " . $_SESSION['name']  . " successfully logged out." . ')</script>';
  header('Location: ../../index.php');
  exit;
}
?>