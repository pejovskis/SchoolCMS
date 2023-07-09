<?php
session_start();
require '../engine/functions.php';
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SEM User Manual</title>
  <link rel="stylesheet" href="../css/stylenew.css">
</head>

<body>
  <div class="div-bg">
    <div class="div-menu">
      <div class="div-title">
        <p>User Manual</p>
      </div>
      <div class="div-textarea">
        <textarea style="text-align: center;">
        Please note:
There are no actual data or sensitive information used in this web application!

To log in and test the app, please contact@pejovskisashko.de to obtain the fictional login credentials.

After acquiring the login information, proceed to the login page and enter the provided credentials.

The app offers three modes:

1. Student Mode: Upon logging in, students can view the available exercises and download them. They have read-only access to the exercises.

2. Teacher Mode: Upon logging in, teachers can view, edit, and add new exercises with various parameters. While most fields are optional, the subject and category fields are always required. Teachers can only edit or delete exercises created by themselves. For example, a history teacher cannot edit an exercise created by a biology teacher. Additionally, any modifications made to an exercise will update the exercise's timestamp, preventing last-minute changes.

3. Super User Mode: The super user has full control over the application. They can create new users, exercises, and have the ability to edit or delete any exercise. The super user has unrestricted access and privileges within the app.

IMPORTANT: To avoid confusion among teachers, ONLY the Super User has the authority to add new subjects. However, teachers are free to create as many new categories as they require.

If the database is empty at the time of your login, feel free to populate it with some fictitious information. Please be mindful of the language you use. &#128513

Please note that only the Super User can add new subjects, ensuring proper organization and consistency within the app. Teachers have the flexibility to create additional categories specific to their subjects or topics.

Enjoy exploring the app and feel free to populate the database with appropriate mock data to facilitate your testing. Should you have any further questions or concerns, please don't hesitate to contact us at contact@pejovskisashko.de

Please enjoy exploring the app, and if you have any further questions, don't hesitate to contact@pejovskisashko.de

</textarea>
        <div class="div-buttons">
          <?php
          btnBackToMainMenu();
          ?>
        </div>
      </div>

    </div>
  </div>
</body>

</html>