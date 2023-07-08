<?php
session_start();
require '../engine/functions.php';
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SEM Add New Exercise</title>
  <link rel="stylesheet" href="/css/stylenew.css">
</head>

<body>

  <div class="div-bg">
    <div class="div-menu">
      <div class="div-title">
        <p> Add Exercise </p>
      </div>
      <div class="div-buttons">
          <form method="post" enctype="multipart/form-data">
            <div class="div-login">
              <label for="aufgabe-name">Excercise Name</label>
              <input name="aufgabe-name" type="text" placeholder="Enter Name here">
              <label for="beschreibung">Description</label>
              <textarea name="beschreibung" type="text" placeholder="Enter description here"></textarea>
              <label for="hinweis">Hint</label>
              <input name="hinweis" type="text" placeholder="Enter Hint here">
              <div class="form-group">
                <label for="fach">Subject</label>
                <select name="fach">
                  <option>Select Subject</option>
                  <?php
                  $fachOptions = [];
                  pullSubjectFromDb($fachOptions);
                  filterSubject();
                  ?>
                </select>
              </div>
              <?php
              if (superCheck()) {
                inputAddSubject();
              }
              ?>

              <div>
                <label for="kategorie">Category</label>
                <select name="kategorie">
                  <option>Select Category</option>
                  <?php
                  $kategorieOptions = [];
                  pullCategoryFromDb($kategorieOptions);
                  filterCategory();
                  ?>
                </select>
              </div>
              <div>
                <label for="new-kategorie">New Category</label>
                <input name="new-kategorie" type="text" placeholder="New Category">
              </div>
              <div>
                <label for="excercise-file">Upload ONLY PDF Files !</label>
                <input id="btn-upload-file" name="excercise-file" type="file">
              </div>
            </div>
            <div class="div-cancon">
                <a class="btn-cancel" href="main-menu.php"> cancel </a>
                <button name="submit" type="submit" class="btn-confirm">upload</button>
                <?php
                addExerciseContentToDb();
                ?>
              </div>
          </form>
      </div>

    </div>
  </div>

</body>

</html>