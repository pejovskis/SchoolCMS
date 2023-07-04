<?php
//logout-btn clicked
if (isset($_POST['logout'])) {
  session_destroy();
  //redirect to guest mode
  header('Location: ../../index.php');
  exit;
}
?>