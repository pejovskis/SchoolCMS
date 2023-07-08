<?php 
  session_start();
  require '../engine/functions.php';
?>

<!doctype html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SEM Add New Category</title>
    <link rel="stylesheet" href="/css/stylenew.css">
  </head>

  <body>

  <div class="div-bg">
    <div class="div-menu">
      <div class="div-title">
        <p>Add Category</p> 
      </div>
      <div class="div-buttons">
        <form method="post"> 
          <div class="div-elements">
            <div>
              <label for="category">New Category: </label>
              <input name="category" type="text">
            </div>
          </div>
          <div class="div-cancon">
            <a class="btn-cancel" href="../sites/main-menu.php">cancel</a>
            <button type="submit" class="btn-confirm">add category</button>
          </div>   
          <?php addCategoryToDb(); ?>
        </form>
      </div>
    </div>
  </div>

</body>
</html>


