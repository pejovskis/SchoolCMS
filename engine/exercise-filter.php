<?php
        // Fetch Fach options from the database
        $fachOptionsQuery = "SELECT DISTINCT fach FROM aufgabe";
        $fachOptionsResult = mysqli_query($conn, $fachOptionsQuery);
        $fachOptions = array();
        while ($fachOption = mysqli_fetch_assoc($fachOptionsResult)) {
          $fachOptions[] = $fachOption['fach'];
        }

        // Fetch Kategorie options from the database
        $kategorieOptionsQuery = "SELECT DISTINCT kategorie FROM aufgabe";
        $kategorieOptionsResult = mysqli_query($conn, $kategorieOptionsQuery);
        $kategorieOptions = array();
        while ($kategorieOption = mysqli_fetch_assoc($kategorieOptionsResult)) {
          $kategorieOptions[] = $kategorieOption['kategorie'];
        }
?>
        