<?php
session_start();
require 'engine/functions.php';
redirectLoggedUser();
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>School Exercises Manager</title>
  <link rel="stylesheet" href="/css/stylenew.css">
</head>

<body>
  <div class="div-bg">
    <div class="div-menu">
      <div class="div-title">
        <p class="">SEM Main Menu
        <p>
      </div>
      <div class="div-buttons">
        <a href="sites/login-menu.php" class="btn-menu">Log In</a>
        <a href="sites/user-manual.php" class="btn-menu">Help</a>
        <a href="sites/about.php" class="btn-menu">About</a>
      </div>
    </div>
  </div>
</body>

</html>