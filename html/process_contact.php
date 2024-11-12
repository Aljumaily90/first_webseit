<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // reCAPTCHA Validierung
    $recaptchaSecret = '6Le0SnYqAAAAAJ4Zmm2R_2K7RWVZZYyzyr6XzRsA'; // Ersetze durch deinen geheimen Schlüssel
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    // Überprüfen der reCAPTCHA-Antwort
    $recaptchaVerifyUrl = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptchaVerifyResponse = file_get_contents($recaptchaVerifyUrl . '?secret=' . $recaptchaSecret . '&response=' . $recaptchaResponse);
    $recaptchaResult = json_decode($recaptchaVerifyResponse, true);

    if (!$recaptchaResult['success']) {
        echo "reCAPTCHA-Überprüfung fehlgeschlagen. Bitte versuche es erneut.";
        exit;
    }

    // Empfange Formulardaten
    $anrede = htmlspecialchars($_POST['anrede']);
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $telefon = htmlspecialchars($_POST['telefon']);
    $message = htmlspecialchars($_POST['message']);

    // Validierung
    if (empty($name) || empty($email) || empty($telefon) || empty($message)) {
        echo "Bitte füllen Sie alle erforderlichen Felder aus.";
        exit;
    }

    // E-Mail konfigurieren
    $to = 'info@eman-bestattungen.ch'; // Zieladresse einfügen
    $subject = "Neue Kontaktanfrage von $name";
    $from = 'noreply@eman-bestattungen.ch'; 
    $headers = "From: $from\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // HTML-Nachricht
    $body = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; color: #333; line-height: 1.5; }
            .content { background-color: #f9f9f9; padding: 20px; border-radius: 10px; max-width: 600px; margin: 0 auto; }
            .content h2 { color: #1a1a1a; }
            .content p { margin: 10px 0; }
            .content strong { color: #555; }
        </style>
    </head>
    <body>
        <div class='content'>
            <h2>Neue Kontaktanfrage</h2>
            <p><strong>Anrede:</strong> $anrede</p>
            <p><strong>Name:</strong> $name</p>
            <p><strong>E-Mail:</strong> <a href='mailto:$email'>$email</a></p>
            <p><strong>Telefon:</strong> <a href='tel:$telefon'>$telefon</a></p>
            <p><strong>Nachricht:</strong></p>
            <p>$message</p>
        </div>
    </body>
    </html>
    ";

    // E-Mail senden
    if (mail($to, $subject, $body, $headers)) {
        // Weiterleitung zur Bestätigungsseite
        header("Location: confirmation.html");
        exit;
    } else {
        echo "Fehler beim Senden der Nachricht. Bitte versuchen Sie es später erneut.";
    }
} else {
    echo "Ungültige Anfrage.";
}
?>