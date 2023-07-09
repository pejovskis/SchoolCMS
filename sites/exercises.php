<?php
session_start();
require '../engine/functions.php';
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SEM Exercises</title>
  <link rel="stylesheet" href="/css/stylenew.css">
</head>

<body>

  <div class="div-bg">
    <div class="div-menu">
      <div class="div-title">
        <p>Exercises Overview</p>
      </div>
      <div class="div-show-exercises">
        <form method="get" class="form-filter">
          <h3>Filter:</h3>
          <?php
          exerciseFilter();
          ?>
          <select name="subject" id="subjectSelect">
            <option value="">Select subject</option>
            <?php filterSubject(); ?>
          </select>
          <select name="category" id="categorySelect">
            <option value="">Select category</option>
            <?php filterCategory(); ?>
          </select>
          <button type="submit" class="btn-confirm">Filter</button>
          <?php
          btnBackToMainMenu();
          ?>
        </form>
      </div>
      <div style="overflow-x: auto;">
        <table class="table-dark">
          <thead class="table-head">
            <tr class="table-row">
              <th scope="col">#id</th>
              <th scope="col">Exercise Name</th>
              <th scope="col">Description</th>
              <th scope="col">Hint</th>
              <th scope="col">Subject</th>
              <th scope="col">Category</th>
              <th scope="col">Date</th>
              <th scope="col">Added From</th>'
              <th scope="col">PDF File</th>
              <?php
              if (teacherCheck() || superCheck()) {
                echo '<th scope="col">Edit Excercise</th>';
              }
              ?>
            </tr>
          </thead>
          <tbody>
            <?php
            // Include the updated code from show-exercises.php
            displayExercises();
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>