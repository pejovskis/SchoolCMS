<?php 
      session_start();
    require '../engine/super-new-user-register.php';
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

  <div class="container-fluid w-100 vh-100 d-flex justify-content-center align-items-center">
      
      <div class="container d-flex flex-column justify-content-center align-content-center p-5 rounded-5 bg-light menu-div">

        <div class="container d-flex justify-content-center mb-5">
          <h1>Add New Teacher</h1> 
        </div>
        
        <div class="container w-100 d-flex flex-column row-gap-4 align-items-center">
            <form method="post"> 
                <div class="mb-3">
                  <label for="email" class="form-label">Email address</label>
                  <input name="email" type="email" class="form-control">
                  <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="container-fluid d-flex justify-content-around mt-5">
                  <a class="btn btn-lg btn-danger" href="../sites/super-m-menu.php">abbrechen</a>
                  <input class="btn btn-lg btn-primary" name="submit" type="submit" value="Add Teacher">
                </div>                
              </form>
        </div>

      </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>


