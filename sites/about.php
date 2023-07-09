<?php
session_start();
require '../engine/functions.php';
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>About SEM</title>
  <link rel="stylesheet" href="../css/stylenew.css">
</head>

<body>
  <div class="div-bg">
    <div class="div-menu">
      <div class="div-title">
        <p>About</p>
      </div>
      <div class="div-textarea">
        <textarea style="text-align: center;">

        "SEM - Revolutionizing Education Data Management with DBManager"

SEM (School Exercise Manager) is an app developed by Sashko Pejovski, a developer from Cologne, Germany. It introduces DBManager, an innovative application designed to facilitate seamless information exchange between students and instructors. This advanced app harnesses the power of database management to coordinate access to assignments and information. With SEM, students can effortlessly access their assigned tasks, while teachers can create new exercises and update data.

Features:
Student Access: -Students can log in to the app and access their assigned exercises.
The app provides a clear list of current assignments, ensuring students always stay organized.
Additionally, students can access additional resources such as lecture materials or task-related notes.

Teacher Privileges: -Teachers enjoy enhanced permissions, enabling them to create and edit exercises.
Teachers can assign specific parameters to exercises.
They can also include additional attachments, such as sample answers or supplementary materials, to assist students in completing the exercises.

Efficient Database Management:
The app securely manages all data in an efficient database system.
Information is organized and can be retrieved and updated at any time.
Encryption and secure connections ensure the confidentiality and integrity of the data.

Upcoming Features: -Student Favorite Exercise Tab: Students will have the ability to mark exercises as favorites for easy access.
User Password Change: Users will have the option to change their passwords within the app.
Search Field and Category Filter Dependency: A search field will be implemented, allowing users to search for exercises based on specific criteria. It will also be dependent on the category filter from the subject, providing refined search results.

Please note: SEM is a fictional application created for testing & learning purposes! It does not have actual functionality and does not store real data. It has been designed to simulate user interactions and demonstrate the management of educational data.

There are no real information of any kind included!

Experience the benefits of efficient and organized data management with SEM - the ultimate tool for managing school exercises.</textarea>
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