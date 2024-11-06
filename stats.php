<?php
// Prüfen, ob der Benutzer authentifiziert ist (einfache Authentifizierung)
$username = "admin";  // Setze einen Benutzernamen
$password = "password123";  // Setze ein Passwort

// Prüfen, ob die Zugangsdaten stimmen
if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || 
    $_SERVER['PHP_AUTH_USER'] !== $username || $_SERVER['PHP_AUTH_PW'] !== $password) {
    header('WWW-Authenticate: Basic realm="Visitor Stats"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Authentifizierung erforderlich';
    exit;
}

// Datei für Besucherzählung auslesen
$file = 'counter.txt';
if (file_exists($file)) {
    $counter = file_get_contents($file);
} else {
    $counter = 0;
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Besucherstatistik</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            color: #333;
            text-align: center;
            padding: 50px;
        }
        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            display: inline-block;
            padding: 30px;
        }
        h1 {
            color: #007bff;
        }
        .counter {
            font-size: 3em;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Besucherstatistik</h1>
        <p class="counter"><?php echo $counter; ?></p>
        <p>Besuche insgesamt</p>
    </div>
</body>
</html>
