<?php
 session_start();;
 require '../engine/functions.php';
 redirectCheckUserLogIn();
?>

<!doctype html>
<html lang="en">
  <head>
    <title>SEM Main Menu</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/stylenew.css">
  </head>
  <body>
        
    <div class="div-bg">
      
      <div class="div-menu">

        <div class="div-title">
          <?php 
            displayMainMenuUserInfo();
            ?>
        </div>

          <div class="div-buttons">
            <?php
              if (superCheck()) {
                btnAddUser();
                btnAddSubject();
              } 
              
              if (teacherCheck() || superCheck()) {
                btnAddCategory();
                btnAddExercise();
              }
            ?>
            <a href="exercises.php" class="btn-menu">Show Exercises</a>
            <a href="user-manual.php" class="btn-menu">Help</a>
            <a href="about.php" class="btn-menu" >About</a>
          <form class="" method="POST">
            <button class="btn-menu btn-cancel" name="logout">Log out</button>
        </form>
        <?php 
            btnLogOut();
        ?>
        </div>
      </div>
    </div>

  </body>
</html>