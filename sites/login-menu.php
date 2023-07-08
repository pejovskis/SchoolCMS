<?php
  session_start();
  require '../engine/functions.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SEM Log In</title>
    <link rel="stylesheet" href="/css/stylenew.css">
  </head>
  <body>

  <div class="div-bg">
      <div class="div-menu">
        <div class="div-title">
          <p>Log In</p> 
        </div>
        <div class="">

            <!-- Log In Form -->
            <form method="post"> 
              <div class="div-login">
                <div class="">
                    <label for="email" class="">Email address</label>
                    <input name="email" type="email">
                    <!-- <small>This log in is private only. There are no real email adresses used in the proccess, and it's only for test purposes. To obtain account & password please contact the Developer</small> -->
                  </div>
                  <div class="">
                    <label for="password" class="form-label">Password</label>
                    <input name="password" type="password">
                  </div>
              </div>   
              <div class="div-cancon">
                    <a class="btn-cancel" href="../index.php">cancel</a>  
                    <button type="submit" class="btn-confirm">Log In</button>
                  </div> 
              <?php 
                userLogIn();
              ?>     
              </form>
              
        </div>
      </div>
    </div>
    
  </body>
</html>