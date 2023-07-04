<?php

// Logout Button click
if (isset($_POST['logout'])) {
  session_destroy();
  header('Location: ../../index.php');
  exit;
}

?>