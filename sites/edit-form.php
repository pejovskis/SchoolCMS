<?php
session_start();
require '../engine/functions.php';
redirectCheckUserLogIn();
$exerciseId = $_GET['id'];
$row = getExerciseDetails($exerciseId); 
checkIfEditPosible($row);
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SEM Edit Exercise</title>
  <link rel="stylesheet" href="/css/stylenew.css">
</head>

<body>

  <div class="div-bg">
    <div class="div-menu">
      <div class="div-title">
        <p> Edit Exercise id:<?php echo $row['id']; ?> </p>
      </div>
      <div class="div-buttons">
        <form method="POST" action="update.php">
          <div class="form-group">
            <div class="div-login">
              <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
              <label for="name" type="text">Name:</label>
              <input type="text" name="aufgabe-name" value="<?php echo $row['name']; ?>">
              <label for="beschreibung">Description</label>
              <textarea type="text" name="beschreibung" placeholder="<?php echo $row['beschreibung']; ?>"></textarea>
              <label for="hinweis">Hint</label>
              <input name="hinweis" type="text" value="<?php echo $row['hinweis']; ?>">
              <label for="fach">Subject</label>
              <select name="fach">
                <option>Select Subject</option>
                <?php
                filterSubject();
                ?>
              </select>
              <?php
              if (superCheck()) {
                displayNewSubjectField();
              }
              ?>
              <label for="kategorie">Category</label>
              <select name="kategorie">
                <option>Select Category</option>
                <?php
                filterCategory();
                ?>
              </select>
              <?php
              displayNewCategoryField();
              ?>
              <div>
                <label for="excercise-file">Upload ONLY PDF Files !</label>
                <input name="excercise-file" type="file">
              </div>
            </div>
            <div class="div-cancon">
              <a class="btn-cancel" href="../sites/main-menu.php"> cancel </a>
              <button name="submit" type="submit" value="update" class="btn-confirm">save</button>
              <?php btnDeleteExercise(); ?>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

</body>

</html>