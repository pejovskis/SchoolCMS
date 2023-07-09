<?php
session_start();
require '../engine/functions.php';
redirectCheckSuperUserLogIn();
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SEM User Overview</title>
  <link rel="stylesheet" href="/css/stylenew.css">
</head>

<body>

  <div class="div-bg">
    <div class="div-menu">
      <div class="div-title">
        <p>User Overview</p>
      </div>
      <div class="div-show-exercises">
          <?php
          btnBackToMainMenu();
          ?>
      </div>
      <div style="overflow-x: auto;">
      <table class="table-dark">
        <thead class="table-head">
          <tr class="table-row">
            <th scope="col">#id</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Email</th>
            <th scope="col">Status Level</th>
            <th scope="col">User Photo</th>
            <th scope="col">Edit User</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Include the updated code from show-exercises.php
          displayAllUsers();
          ?>
        </tbody>
      </table>
      </div>
    </div>
  </div>
</body>

</html>