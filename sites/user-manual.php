<?php 
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="../css/fe-style-1.css" rel="stylesheet">
  </head>
  <body>
    <div class="container-fluid w-100 vh-100 d-flex flex-column justify-content-center align-items-center">
        <div class="container d-flex flex-column w-100 h-75 justify-content-center align-items-center border border-5 bg-light p-5">
        <h1 class="h1 mb-5">App-Bedienungshilfe (Fake-App für Testzwecke)</h1>
            <textarea class="form-control h-100 text-center">
    
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