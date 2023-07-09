<?php
session_start();
require '../engine/functions.php';
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SEM User Register</title>
  <link rel="stylesheet" href="/css/stylenew.css">
</head>

<body>

  <div class="div-bg">
    <div class="div-menu">
      <div class="div-title">
        <p>Add New User<p>
      </div>
      <div class="div-buttons">
        <form method="post" enctype="multipart/form-data">
          <div class="div-elements">
            <div class="">
              <label for="email">Email address</label>
              <input name="email" type="email">
            </div>
            <div>
              <label for="password">Password</label>
              <input name="password" type="password">
            </div>
            <div>
              <label for="first-name">First Name</label>
              <input name="first-name" type="text">
            </div>
            <div>
              <label for="last-name">Last Name</label>
              <input name="last-name" type="text">
            </div>
            <div>
              <label for="profile-image">Profile Image</label>
              <input name="profile-image" type="file">
            </div>
            <div>
              <label for="status-level">Status Level</label>
              <input name="status-level" type="number">
            </div>
            <div>
                1. Student;<br>
                2. Teacher; <br>
                9. Super Admin</div>
            </div>
            <div class="div-cancon">
              <a class="btn-cancel" href="../sites/main-menu.php">cancel</a>
              <button class="btn-confirm" name="submit" type="submit" value="add User">Add User</button>
            </div>
            <?php 
              addNewUser();
            ?>
          </div>
          
        </form>
      </div>
    </div>
  </div>

</body>

</html>