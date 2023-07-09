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
          <div class="div-elements">
            <label for="exercise-name">Exercise Name</label>
            <input name="exercise-name" type="text" placeholder="Enter Name here">
            <label for="description">Description</label>
            <div class="div-textarea">
              <textarea name="description" type="text" placeholder="Enter description here"></textarea>
            </div>
            <label for="hint">Hint</label>
            <input name="hint" type="text" placeholder="Enter Hint here">
            <div class="field-required">
              <label for="subject">Subject</label>
              <p> <span class="red-asterisk">&#42;</span> This field is required.</p>
              <select id="subject" name="subject">
                <?php
                $subjectOptions = [];
                pullSubjectFromDb($subjectOptions);
                filterSubject();
                ?>
              </select>
            </div>
            <?php
            if (superCheck()) {
              inputAddSubject();
            }
            ?>

            <div class="field-required">
              <label for="category">Category</label>
              <p> <span class="red-asterisk">&#42;</span> This field is required.</p>
              <select id="category" name="category" onchange="toggleSelect('new-category', 'category')">
                <?php
                $categoryOptions = [];
                pullCategoryFromDb($categoryOptions);
                filterCategory();
                ?>
              </select>
            </div>
            <div>
              <label for="new-category">New Category</label>
              <input id="new-category" name="new-category" type="text" placeholder="New Category" oninput="toggleSelect('category', 'new-category')">
            </div>
            <div>
              <label for="excercise-file">Upload ONLY PDF Files !</label>
              <input id="btn-upload-file" name="excercise-file" type="file" accept="application/pdf">
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