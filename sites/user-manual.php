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
      <textarea>
Willkommen zur App-Bedienungshilfe! Diese spezielle App wurde entwickelt, 
um Benutzerinteraktionen zu simulieren und Testumgebungen für verschiedene Szenarien bereitzustellen. 
Bitte beachten Sie, dass dies eine fiktive App ist und keine echte Funktionalität bietet. 
Hier sind einige der simulierten Funktionen, die Sie testen können:

Registrierung:

1. Geben Sie Ihren Benutzernamen, Ihre E-Mail-Adresse und ein Passwort ein, 
um sich zu registrieren.
Die Registrierung ist lediglich simuliert und erzeugt keine tatsächlichen Konten.
Anmelden:

2. Verwenden Sie Ihre zuvor erstellten Anmeldeinformationen, um sich anzumelden.
Dieser Vorgang simuliert den Anmeldevorgang und prüft die eingegebenen Daten.
Profilverwaltung:

3. Bearbeiten Sie Ihr Profil, indem Sie persönliche Informationen wie Name, 
Geburtsdatum und Profilbild eingeben.
Diese Informationen werden nicht gespeichert und dienen nur zu Testzwecken.
Einstellungen:

4. Simulieren Sie verschiedene Einstellungen, wie beispielsweise das Ändern 
der Sprache, des Farbschemas oder der Benachrichtigungseinstellungen.
Diese Einstellungen haben keinen Einfluss auf das tatsächliche Gerät oder die App.
Simulierte Funktionen:

5. Testen Sie verschiedene App-Funktionen, wie beispielsweise das Hochladen von Bildern, 
das Versenden von Nachrichten oder das Durchsuchen von Inhalten.
Diese Funktionen erzeugen lediglich simulierten Output und haben keinen Einfluss auf externe Systeme.
Bitte beachten Sie, dass diese App-Bedienungshilfe ausschließlich zu Testzwecken erstellt wurde und 
keine echte Funktionalität bietet. Die in der App angezeigten Informationen und Daten sind nicht echt 
und werden nicht gespeichert. Verwenden Sie diese App-Bedienungshilfe ausschließlich 
für Test- und Schulungszwecke.

Vielen Dank für Ihre Teilnahme!</textarea>
      <div class="div-buttons">
            <?php
            btnBackToMainMenu();
            ?>
      </div>    
    </div>
  </div>
</body>

</html>