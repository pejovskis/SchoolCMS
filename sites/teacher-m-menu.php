<?php
session_start();
require '../engine/check-login.php';
include '../engine/btn-logout.php';
include '../engine/check-super-user.php';
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Teacher Main Menu</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/fe-style-1.css">
</head>

<body>

  <div class="container-fluid w-100 vh-100 d-flex justify-content-center align-items-center text-white">
    <div class="container-fluid d-flex flex-column justify-content-center align-content-center p-5 rounded-5 bg-dark menu-div">
      <div class="container d-flex flex-column justify-content-center align-items-center mb-5">
        <?php
          $status_level = $_SESSION['status_level'];
          $status = '';
          switch($status_level){
            case 1:
              $status = 'student';
              break;
            case 2:
              $status = 'teacher';
              break;
            case 9:
              $status = 'God';
              break;
          }
          echo '<h1 class="bg-dark text-white p-3 rounded-5">Teacher Main Menu</h1>' . '<h2> Logged in as: </h2>' . '<h3>' . $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] . '</h3> <p style="font-weight: bold; font-size: 1.3rem;"> - ' . $status . ' - </p>';
        ?>
      </div>
      <div class="container-fluid w-100 d-flex flex-column row-gap-4 align-items-center">
        <?php
        if (superCheck()) {
          echo '<a class="btn btn-lg bg-warning rounded-5 text-dark w-100 shadow-lg" href="../sites/super-m-menu.php">Super User</a>';
        }
        ?>
        <a href="../sites/exercises.php" class="btn btn-lg bg-primary rounded-5 text-white w-100 shadow-lg" href="">Show Exercises</a>
        <a href="../sites/add-exercise.php" class="btn btn-lg bg-success rounded-5 text-white w-100 shadow-lg" href="">Add Exercises</a>
        <a href="../sites/user-manual.php" class="btn btn-lg bg-primary rounded-5 text-white w-100 shadow-lg" href="">Help</a>
        <a href="../sites/about.php" class="btn btn-lg bg-primary rounded-5 text-white w-100 shadow-lg" href="">About</a>
        <form class="w-100" method="POST">
            <button class="btn btn-lg btn-danger w-100 shadow-lg rounded-5" name="logout">Log out</button>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src="../js/script.js"></script>

</body>

</html>