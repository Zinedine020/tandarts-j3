<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Verzend e-mail (zorg ervoor dat je mail-configuratie correct is)
    $to = 'your-email@example.com'; // Vervang met jouw e-mailadres
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $email_subject = "Contactformulier: $subject";
    $email_message = "Naam: $name\nE-mail: $email\nOnderwerp: $subject\n\nBericht:\n$message\n";

    mail($to, $email_subject, $email_message, $headers);
    $success = true;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Tandartspraktijk</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <h2>Stuur ons een bericht</h2>
        <?php if (isset($success) && $success): ?>
            <p>Bedankt voor uw bericht! We nemen zo snel mogelijk contact met u op.</p>
        <?php endif; ?>
        <form method="POST" action="contact.php">
            <label for="name">Naam:</label>
            <input type="text" id="name" name="name" required><br>
            
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required><br>
            
            <label for="subject">Onderwerp:</label>
            <input type="text" id="subject" name="subject" required><br>
            
            <label for="message">Bericht:</label>
            <textarea id="message" name="message" rows="4" required></textarea><br>
            
            <button type="submit">Verstuur</button>
        </form>
        <a href="index.php">Terug naar Home</a>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
