<?php 
  session_start();
  require '../engine/check-super-login.php';
  include '../engine/add-category.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/fe-style-1.css">
  </head>
  <body>

  <div class="container-fluid w-100 vh-100 d-flex justify-content-center align-items-center text-white">
      
        <div class="container d-flex flex-column justify-content-center align-content-center p-5 rounded-5 bg-dark menu-div">
  
          <div class="container d-flex justify-content-center mb-5">
            <h1>Add Category</h1> 
          </div>
          
          <div class="container w-100 d-flex flex-column row-gap-4 align-items-center">
              <form method="post" class="w-100"> 
                  <div class="mb-3">
                    <label for="category" class="form-label">New Category: </label>
                    <input name="category" type="text" class="form-control">
                  </div>
                  <div class="container-fluid d-flex justify-content-around mt-5">
                  <a class="btn btn-lg btn-danger" href="../sites/super-m-menu.php">abbrechen</a>
                    <button type="submit" class="btn btn-lg btn-primary">add</button>
                  </div>   
                </form>
          </div>
  
        </div>
  
      </div>
      
  </div>

  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>


