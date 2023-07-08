<?php
session_start();
require '../engine/functions.php';
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SEM Log In</title>
  <link rel="stylesheet" href="/css/stylenew.css">
</head>

<body>
  <div class="div-bg">
    <div class="div-menu">
      <div class="div-title">
        <p>Log In</p>
      </div>
      <form method="post">
        <div class="div-elements">
          <div class="">
            <label for="email" class="">Email address</label>
            <input name="email" type="email">
          </div>
          <div class="">
            <label for="password" class="form-label">Password</label>
            <input name="password" type="password">
          </div>
        </div>
        <div class="div-cancon">
          <a class="btn-cancel" href="../index.php">cancel</a>
          <button type="submit" class="btn-confirm">Log In</button>
        </div>
        <?php
        userLogIn();
        ?>
      </form>
    </div>
  </div>
</body>

</html>