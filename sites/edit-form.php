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
            <div class="div-elements">
              <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
              <label for="name" type="text">Name:</label>
              <input type="text" name="exercise-name" value="<?php echo $row['name']; ?>">
              <label for="description">Description</label>
              <div class="div-textarea">
              <textarea id="add-exercise-description" type="text" name="description">
                <?php echo $row['description']; ?>
              </textarea>
              </div>
              <label for="hint">Hint</label>
              <input name="hint" type="text" value="<?php echo $row['hint']; ?>">
              <div class="field-required">
                <label for="subject">Subject</label>
                <p> <span class="red-asterisk" >&#42;</span> This field is required.</p>
                <select name="subject">
                  <?php
                  filterSubject();
                  ?>
                </select>
              </div>
              
              <?php
              if (superCheck()) {
                displayNewSubjectField();
              }
              ?>
              <div class="field-required">
                <label for="category">Category</label>
                <p> <span class="red-asterisk" >&#42;</span> This field is required.</p>
                <select name="category">
                  <?php
                  filterCategory();
                  ?>
                </select>
              </div>
              <?php
              displayNewCategoryField();
              ?>
              <div>
                <label for="excercise-file">Upload ONLY PDF Files !</label>
                <input name="excercise-file" type="file">
              </div>
            </div>
            <div class="div-cancon">
              <a class="btn-cancel" href="../sites/exercises.php"> cancel </a>
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