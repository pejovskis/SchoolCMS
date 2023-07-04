<?php
//Fetch Data from DB
$query = "SELECT * FROM aufgabe WHERE 1=1";

//Check if -Fach- selected
if (!empty($_GET['fach'])) {
  $fach = $_GET['fach'];
  $query .= " AND fach = '$fach'";
}

//Check if -Kategorie- selected
if (!empty($_GET['kategorie'])) {
  $kategorie = $_GET['kategorie'];
  $query .= " AND kategorie = '$kategorie'";
}

$result = mysqli_query($conn, $query);

//Check Error
if (!$result) {
  die("Error executing query: " . mysqli_error($conn));
}

//Loop -> Generate Table Rows
while ($row = mysqli_fetch_assoc($result)) {
  echo "<tr>";
  echo "<th scope='row'>" . $row['id'] . "</th>";
  echo "<td>" . $row['name'] . "</td>";
  echo "<td>" . $row['beschreibung'] . "</td>";
  echo "<td>" . $row['hinweis'] . "</td>";
  echo "<td>" . $row['fach'] . "</td>";
  echo "<td>" . $row['kategorie'] . "</td>";
  echo "<td>PDF herunterladen</td>";
  echo "</tr>";
}

// Close the database connection (optional)
mysqli_close($conn);
?>
