<?php

require 'db-conn-aufgabe.php';

//Fetch data from the database with filtering
$query = "SELECT * FROM aufgabe WHERE 1=1";

//Check -Fach- filter 
if (!empty($_GET['fach'])) {
  $fach = $_GET['fach'];
  $query .= " AND fach = '$fach'";
}

//Check -Kategorie- filter
if (!empty($_GET['kategorie'])) {
  $kategorie = $_GET['kategorie'];
  $query .= " AND kategorie = '$kategorie'";
}

$result = mysqli_query($conn, $query);

//Check errors
if (!$result) {
  die("Error executing query: " . mysqli_error($conn));
}

//Generate html rows
while ($row = mysqli_fetch_assoc($result)) {
  echo "<tr>";
  echo "<th scope='row'>" . $row['id'] . "</th>";
  echo "<td>" . $row['name'] . "</td>";
  echo "<td>" . $row['beschreibung'] . "</td>";
  echo "<td>" . $row['hinweis'] . "</td>";
  echo "<td>" . $row['fach'] . "</td>";
  echo "<td>" . $row['kategorie'] . "</td>";
  echo "<td>" . $row['add_date'] . "</td>";
  $added_by = intval($row['added_by']);
  echo "<td>" . getName($added_by) . "</td>";
  echo "<td><a href='../engine/download.php?id=" . $row['id'] . "'>Download</a></td>";
  if($_SESSION['status_level'] >= 2) {
    echo "<td><a href='../engine/edit.php?id=" . $row['id'] . "'>Edit</a></td>";
  }
  echo "</tr>";
}

function getName($added_by) {
  require 'db-conn-userss.php';

  $first_name = '';
  $last_name = '';
  
  $query = 'SELECT first_name, last_name FROM userss where id="' . $added_by . '";';

  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_execute($stmt);

  $result = mysqli_stmt_get_result($stmt);

  $row = mysqli_fetch_assoc($result);
  
  if ($row) {
    $first_name = strval($row['first_name']);
    $last_name = strval($row['last_name']);
    return $first_name . ' ' . $last_name;
  }
  return 'Unknown'; 
}

mysqli_close($conn);
?>
