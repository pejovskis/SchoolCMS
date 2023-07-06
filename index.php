<?php
 session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teacher Main Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/fe-style-1.css">
  </head>
  <body>
        
    <div class="container-fluid w-100 vh-100 d-flex justify-content-center align-items-center">
      
      <div class="container-fluid d-flex flex-column justify-content-center align-content-center p-5 rounded-5 bg-dark menu-div">

        <div class="container d-flex justify-content-center mb-5">
          <h1 class="text-white">Menu</h1> 
          <hr>
        </div>
        
        <div class="container-fluid w-100 d-flex flex-column row-gap-4 align-items-center">
          <a href="sites/login-menu.php" class="btn btn-lg bg-warning rounded-5 text-dark w-100 shadow-lg">Log In</a>
          <a href="sites/user-manual.php" class="btn btn-lg bg-primary rounded-5 text-white w-100 shadow-lg">Help</a>
        </div>

      </div>

    </div>

        

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="../js/script.js"></script>
  </body>
</html>