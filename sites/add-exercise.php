<?php
  session_start();
  require '../engine/check-login.php';
  include '../engine/check-super-user.php';
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dozenten Aufgaben Einfuegen</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/fe-style-1.css">
</head>

<body>

  <div class="container-fluid vh-100 w-100 d-flex flex-column justify-content-center align-items-center">
    <div class="container w-75 bg-light p-5 rounded-5">
    <h1 class="text-center mb-5"> Add Exercise </h1>
      <form method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="aufgabe-name">Excercise Name</label>
          <input name="aufgabe-name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name here">
          <label for="beschreibung">Description</label>
          <textarea name="beschreibung" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter description here"></textarea>
          <label for="hinweis">Hint</label>
          <input name="hinweis" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Hint here">
          <div class="form-group">
            <label for="fach">Subject</label>
            <select name="fach" class="form-control" id="exampleFormControlSelect1">
              <option>Select Subject</option>
              <?php
              require '../engine/add-exercise-pull-subject.php';
              ?>
            </select>
          </div>
          <?php
          if (superCheck()) {
            echo '<div class="form-group">
          <label for="new-fach">New Subject</label>
          <input name="new-fach" type="text" class="form-control"
            placeholder="Create New Subject">
        </div>';
          }
          ?>

          <div class="form-group">
            <label for="kategorie">Category</label>
            <select name="kategorie" class="form-control" id="exampleFormControlSelect1">
              <option>Select Category</option>
              <?php
              require '../engine/add-exercise-pull-category.php';
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="new-kategorie">New Kategorie</label>
            <input name="new-kategorie" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="New Category">
          </div>
          <div class="form-group">
            <label for="excercise-file">Upload ONLY PDF Files !</label>
            <input name="excercise-file" type="file" class="form-control">
          </div>
          <div class="form-check">
          </div>
          <div class="container m-0 d-flex justify-content-around">
            <a class="btn btn-danger w-25" href="teacher-m-menu.php" style="text-decoration: none; color: white;"> cancel </a>
            <button name="submit" type="submit" class="btn btn-primary w-25">upload</button>
            <?php 
          require '../engine/add-exercise-content.php';
          ?>
          </div>
        </div>
        
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src="../js/script.js"></script>
</body>

</html>