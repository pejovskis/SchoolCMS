<?php
session_start();
  require "../engine/check-";
  require "../engine/bm-add-user.php";
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BM Log In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/fe-style-1.css">
  </head>
  <body>

  <div class="container-fluid w-100 vh-100 d-flex justify-content-center align-items-center">
      
      <div class="container d-flex flex-column justify-content-center align-content-center p-5 rounded-5 bg-light menu-div bg-opacity-25">

        <div class="container d-flex justify-content-center mb-5 bg-opacity-25">
          <h1 class="display-4">BM Add User</h1> 
        </div>
        
        <div class="container w-100 d-flex flex-column row-gap-4 align-items-center">
            <form method="post">
                <div class="container shadow-lg p-5 border rounded-5 bg-light">
                <div class="mb-3 p-3">
                    <label for="email" class="form-label">Email address</label>
                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <small>This login is private. There are no real email addresses used in the process, and it's only for test purposes.</small>
                </div>
                <div class="mb-3 p-3">
                    <label for="password" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mb-3 p-3">
                    <label for="status" class="form-label">Status</label>
                    <div>
                    <input type="radio" name="status" value="teacher">
                    <label for="teacher">Teacher</label>
                    </div>
                    <div>
                    <input type="radio" name="status" value="student">
                    <label for="student">Student</label>
                    </div>
                    <div>
                    <input type="radio" name="status" value="admin">
                    <label for="admin">Admin</label>
                    </div>
                </div>
                <div class="container-fluid d-flex justify-content-around mt-5">
                    <a class="btn btn-lg btn-danger shadow-lg" href="../index.php">Cancel</a>
                    <button type="submit" class="btn btn-lg btn-primary shadow-lg">Log In</button>
                </div>
                </div>
                <div></div>
            </form>
            </div>


      </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="../js/script.js"></script>
  </body>
</html>