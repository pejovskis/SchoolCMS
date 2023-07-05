<?php
//logout-btn clicked
if (isset($_POST['logout'])) {
  session_destroy();
  //redirect to log in menu
  header('Location: ../../index.php');
  exit;
}
?>