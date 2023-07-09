<?php
require 'db-conn-users.php';

//Check if the ID parameter is set in the URL and fetch user data and send it to the edit form
if (isset($_GET['id'])) {

  $id = $_GET['id'];
  $query = "SELECT * FROM user WHERE id =" . $id . ";";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);

  require '../sites/edit-user-form.php';
} else {
  echo "No ID parameter found.";
}
