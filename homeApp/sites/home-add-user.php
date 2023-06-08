<?php

    //require ""; -- Super User To be Loged In
    require "../connections/db-connection-homeApp.php";

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>homeApp Add Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
  </head>
  <body>



    <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
        
      <div class="container d-flex bg-light p-5 w-500px rounded-5 justify-content-center align-items-center">

        <form>
          <div class="mb-3 d-flex flex-column justify-content-center align-items-center">
            <label for="account" class="form-label">Account</label>
            <input type="text" class="form-control" name="account">
          </div>
          <div class="mb-3 d-flex flex-column justify-content-center align-items-center">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password">
          </div>
          <div class="d-flex justify-content-around">
            <a class="btn btn-danger" href="home-main-menu">back</a>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
          <?php 
            require '../engine/add-user.php';
          ?>
        </form>

      </div>

    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>