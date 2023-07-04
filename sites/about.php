<?php 
  session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> About </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="../css/fe-style-1.css" rel="stylesheet">
  </head>
  <body>
    <div class="container-fluid w-100 vh-100 d-flex flex-column justify-content-center align-items-center">
        <div class="container d-flex flex-column w-100 h-75 justify-content-center align-items-center border border-5 bg-light p-5">
        <h1 class="h1 mb-5">App - About (Fake-App für Testzwecke)</h1>
            <textarea class="form-control h-100 text-center">
    
            Titel: "DBManager - Eine revolutionäre App zur Verwaltung von Bildungsdaten"

Beschreibung: DBManager ist eine bahnbrechende App, die entwickelt wurde, um den reibungslosen Austausch von Informationen zwischen Schülern und Dozenten zu ermöglichen. Diese fortschrittliche Anwendung verwaltet Datenbanken, um den Zugriff auf Aufgaben und Informationen zu koordinieren. Mit DBManager können Schüler auf ihre zugewiesenen Aufgaben zugreifen, während Dozenten neue Aufgaben erstellen und Daten aktualisieren können.

Funktionen:

Schülerzugriff:

Schüler können sich in der App anmelden und auf ihre zugewiesenen Aufgaben zugreifen.
Die App stellt eine übersichtliche Liste der aktuellen Aufgaben dar, damit Schüler immer den Überblick behalten.
Schüler können den Status ihrer Aufgaben verfolgen, beispielsweise ob sie abgeschlossen oder noch ausstehend sind.
Zusätzlich können Schüler weitere Ressourcen wie Vorlesungsmaterialien oder Anmerkungen zu den Aufgaben einsehen.
Dozentenrechte:

Dozenten haben erweiterte Berechtigungen und können neue Aufgaben erstellen und bearbeiten.
Dozenten können Aufgaben mit spezifischen Parametern wie Fälligkeitsdatum, Schwierigkeitsgrad und Gewichtung versehen.
Sie können auch zusätzliche Anhänge wie Beispielantworten oder zusätzliche Materialien hinzufügen, um den Schülern bei der Aufgabenbearbeitung zu helfen.
Datenbankverwaltung:

Die App verwaltet alle Daten in einer sicheren und effizienten Datenbank.
Die Informationen werden organisiert und können jederzeit abgerufen und aktualisiert werden.
Durch die Verwendung von Verschlüsselung und sicheren Verbindungen wird die Vertraulichkeit und Integrität der Daten gewährleistet.
Hinweis: Diese App ist eine fiktive Anwendung, die für Testzwecke erstellt wurde. Sie hat keine tatsächliche Funktionalität und speichert keine echten Daten. Sie wurde entwickelt, um Benutzerinteraktionen zu simulieren und die Verwaltung von Bildungsdaten zu demonstrieren.

Genießen Sie die Vorteile einer effizienten und organisierten Datenverwaltung mit DBManager.</textarea>

        </div>
        <div class="m-5">
        <?php
                require '../engine/btn-back-to-mm.php';
            ?>
        </div>
        </div>
    
        
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>