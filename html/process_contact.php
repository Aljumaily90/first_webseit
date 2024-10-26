<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // E-Mail-Einstellungen
    $to = "info@eman-bestattungen.ch";
    $subject = "Neue Kontaktanfrage von $name";
    $headers = "From: $email";

    $body = "Name: $name\n";
    $body .= "E-Mail: $email\n";
    $body .= "Nachricht: $message\n";

    // E-Mail senden
    if (mail($to, $subject, $body, $headers)) {
        echo "Danke, Ihre Nachricht wurde gesendet!";
    } else {
        echo "Fehler: Die Nachricht konnte nicht gesendet werden.";
    }
}
?>