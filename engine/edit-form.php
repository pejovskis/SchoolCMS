<?php
session_start();
require '../engine/check-login.php';
require '../engine/btn-delete-exercise.php';
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Excercise</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/fe-style-1.css">
</head>

<body>

<div class="container-fluid vh-100 w-100 d-flex flex-column justify-content-center align-items-center">
    <div class="container w-75 bg-light p-5 rounded-5">
    <h1 class="text-center mb-5"> Edit Exercise id:<?php echo $row['id']; ?> </h1>
    <form method="POST" action="update.php">
        <div class="form-group">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="name" type="text">Name:</label>
        <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>">
        <label for="beschreibung">Description</label>
        <textarea class="form-control" type="text" name="beschreibung" placeholder="<?php echo $row['beschreibung']; ?>"></textarea>
          <label for="hinweis">Hint</label>
          <input name="hinweis" type="text" class="form-control" value="<?php echo $row['hinweis']; ?>"> 
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
          require 'check-super-user.php';
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
            <label for="excercise-file">Upload ONLY PDF Files !</label>
            <input name="excercise-file" type="file" class="form-control">
          </div>
          <div class="form-check">
          </div>
          <div class="container m-0 d-flex justify-content-around">
            <button class="btn btn-danger">
              <a href="../sites/teacher-m-menu.php" style="text-decoration: none; color: white;"> cancel </a>
            </button>
            <button name="submit" type="submit" class="btn btn-primary">save changes</button>
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