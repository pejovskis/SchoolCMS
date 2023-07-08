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
              <label for="aufgabe-name">Exercise Name</label>
              <input name="aufgabe-name" type="text" placeholder="Enter Name here">
              <label for="beschreibung">Description</label>
              <textarea name="beschreibung" type="text" placeholder="Enter description here"></textarea>
              <label for="hinweis">Hint</label>
              <input name="hinweis" type="text" placeholder="Enter Hint here">
              <div class="form-group">
                <label for="fach">Subject</label>
                <select id="fach" name="fach">
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
                <select id="kategorie" name="kategorie" onchange="toggleSelect('new-kategorie', 'kategorie')">
                  <?php
                  $kategorieOptions = [];
                  pullCategoryFromDb($kategorieOptions);
                  filterCategory();
                  ?>
                </select>
              </div>
              <div>
                <label for="new-kategorie">New Category</label>
                <input id="new-kategorie" name="new-kategorie" type="text" placeholder="New Category" oninput="toggleSelect('kategorie', 'new-kategorie')">
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

  <script>
  function toggleSelect(elementId, inputId) {
    const selectElement = document.getElementById(elementId);
    const inputElement = document.getElementById(inputId);

    if (selectElement.value == 'None') {
      selectElement.disabled = true;
      inputElement.disabled = false;
    } else if (inputElement.value !== '') {
      selectElement.disabled = true;
      inputElement.disabled = false;
    } else {
      selectElement.disabled = false;
      inputElement.disabled = true;
    }

    inputElement.addEventListener('input', function() {
      if (inputElement.value !== '') {
        selectElement.disabled = true;
        inputElement.disabled = false;
      } else {
        selectElement.disabled = false;
        inputElement.disabled = true;
      }
    });

    selectElement.addEventListener('change', function() {
      if (selectElement.value === '') {
        selectElement.disabled = false;
        inputElement.disabled = true;
      } else {
        inputElement.value = '';
        selectElement.disabled = true;
        inputElement.disabled = false;
      }
    });
  }
</script>
</body>
</html>