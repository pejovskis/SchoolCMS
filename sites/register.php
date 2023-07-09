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
        <p>Add New User
        <p>
      </div>
      <div class="div-buttons">
        <form method="post" enctype="multipart/form-data">
          <div class="div-elements">
            <div>
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
              <input style="height: 55px;" name="profile-image" type="file" accept="image/jpeg">
            </div>
            <div>
              <label>Student </label>
              <input type="radio" name="status-level" value="student" required>
              <label> Teacher </label>
              <input type="radio" name="status-level" value="teacher" required>
              <label>Super Admin</label>
              <input type="radio" name="status-level" value="super" required>
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