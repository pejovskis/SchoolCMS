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
        <textarea>

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