<?php 
session_start();
    require '../engine/check-super-login.php';
    include '../engine/btn-logout-teacher.php';
    ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dozenten Main Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/fe-style-1.css">
  </head>
  <body>

    <div class="container-fluid w-100 vh-100 d-flex justify-content-center align-items-center">
      
        <div class="container-fluid d-flex flex-column justify-content-center align-content-center p-5 rounded-5 bg-light menu-div">
  
          <div class="container d-flex justify-content-center mb-5">
            <h1>God Mode</h1> 
          </div>
          
          <div class="container-fluid w-100 d-flex flex-column row-gap-4 align-items-center">
            <a href="../sites/register.php" class="btn btn-lg bg-success rounded-5 text-white w-100 shadow-lg" href="../sites/register.php">Add Teacher ( GM )</a>
            <a href="../sites/add-category.php" class="btn btn-lg bg-success rounded-5 text-white w-100 shadow-lg" href="../sites/add-category.php">Add Category ( GM )</a>
            <a href="../sites/add-subject.php" class="btn btn-lg bg-success rounded-5 text-white w-100 shadow-lg" href="../sites/add-fach.php">Add Subject ( GM )</a>
            <a href="../sites/exercises.php" class="btn btn-lg bg-primary rounded-5 text-white w-100 shadow-lg" href="../sites/exercises.php">Show Exercises</a>
            <a href="../sites/add-exercise.php" class="btn btn-lg bg-success rounded-5 text-white w-100 shadow-lg" href="../sites/add-exercise.php">Add Exercises</a>
            <a href="../sites/bedienungshilfe.php" class="btn btn-lg bg-primary rounded-5 text-white w-100 shadow-lg" href="../sites/bedienungshilfe.php">Help</a>
            <a href="../sites/teacher-m-menu.php" class="btn btn-lg bg-danger rounded-5 text-white w-100 shadow-lg" href="../sites/bedienungshilfe.php">back to main menu</a>
            <form method="POST">
              <button class="btn btn-lg btn-danger" name="logout">Log out</button>
            </form>
          </div>
  
        </div>
  
      </div>
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="../js/script.js"></script>
  </body>
</html>

