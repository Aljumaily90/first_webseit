<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Dein Secret-Key von Google reCAPTCHA
        $recaptcha_secret = '6Le0SnYqAAAAAJ4Zmm2R_2K7RWVZZYyzyr6XzRsA';

        // Antwort-Token des reCAPTCHA vom Frontend (HTML)
        $recaptcha_response = $_POST['g-recaptcha-response'];
    
        // Überprüfen, ob reCAPTCHA-Token vorhanden ist
        if (empty($recaptcha_response)) {
            die("Fehler: reCAPTCHA nicht ausgefüllt.");
        }
    
        // Anfrage an Google zur Verifizierung der reCAPTCHA-Antwort
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $recaptcha_secret . "&response=" . $recaptcha_response);
        $response_data = json_decode($response);
    
        // Überprüfen, ob die reCAPTCHA-Überprüfung erfolgreich war
        if (!$response_data->success) {
            die("Fehler: reCAPTCHA-Überprüfung fehlgeschlagen.");
        }

    // Anrede, die im DOM als sichtbarer Wert hinterlegt wurde
    $anrede = htmlspecialchars(trim($_POST['anrede']));
    
    // Name: nur Buchstaben und Leerzeichen erlauben
    $name = trim($_POST['name']);
    if (!preg_match("/^[a-zA-ZäöüÄÖÜß\s]+$/", $name)) {
        die("Fehler: Ungültiger Name.");
    }
    
    // E-Mail-Validierung
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Fehler: Ungültige E-Mail-Adresse.");
    }
    
    // Telefonnummer: nur Zahlen, Leerzeichen, Plus und Bindestriche erlauben
    $telefon = trim($_POST['telefon']);
    if (!preg_match("/^[0-9\s\-\+]+$/", $telefon)) {
        die("Fehler: Ungültige Telefonnummer.");
    }
    
    // Nachricht: HTML-Tags entfernen, Zeilenumbrüche umwandeln
    $message = nl2br(htmlspecialchars(trim($_POST['message'])));

    // E-Mail-Einstellungen
    $to = "info@eman-bestattungen.ch";
    $subject = "Neue Kontaktanfrage von $name";
    
    // HTML-Nachricht (unverändert)
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

    // Zusätzliche Header für HTML-E-Mail (unverändert)
    $headers = "From: info@eman-bestattungen.ch\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // E-Mail senden und zur Bestätigungsseite weiterleiten
    if (mail($to, $subject, $body, $headers)) {
        header("Location: confirmation.html");
        exit();
    } else {
        echo "Fehler: Die Nachricht konnte nicht gesendet werden.";
    }
}

?>