<?php
require 'db-conn-aufgabe.php';

  $query = "SELECT name FROM fach";
  $result = mysqli_query($conn, $query);

  //get -fach- from db and generate options in the multiple choice
  if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<option>' . $row['name'] . '</option>';
    }
  }

  mysqli_close($conn);
?>
