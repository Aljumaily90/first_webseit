<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $anrede = htmlspecialchars($_POST['anrede']);
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $telefon = htmlspecialchars($_POST['telefon']);
    $message = htmlspecialchars($_POST['message']);

    // E-Mail-Einstellungen
    $to = "info@eman-bestattungen.ch";
    $subject = "Neue Kontaktanfrage von $name";
    
    // HTML-Nachricht
    $body = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; color: #333; }
            h2 { color: #1a1a1a; }
            .content { background-color: #f9f9f9; padding: 20px; border-radius: 10px; }
            .content p { margin: 5px 0; }
        </style>
    </head>
    <body>
        <div class='content'>
            <h2>Neue Kontaktanfrage</h2>
            <p><strong>Anrede:</strong> $anrede</p>
            <p><strong>Name:</strong> $name</p>
            <p><strong>E-Mail:</strong> $email</p>
            <p><strong>Telefon:</strong> $telefon</p>
            <p><strong>Nachricht:</strong></p>
            <p>$message</p>
        </div>
    </body>
    </html>
    ";

    // Zusätzliche Header für HTML-E-Mail
    $headers = "From: info@eman-bestattungen.ch\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // E-Mail senden
    if (mail($to, $subject, $body, $headers)) {
        echo "Danke, Ihre Nachricht wurde gesendet!";
    } else {
        echo "Fehler: Die Nachricht konnte nicht gesendet werden.";
    }
}
?>