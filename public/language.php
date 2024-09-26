<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $language = $_POST['language'];
    $_SESSION['language'] = $language;
    echo "Taal gewijzigd naar: " . htmlspecialchars($language);
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Taalkeuze</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <h1>Kies je taal</h1>
    <form method="POST" action="language.php">
        <label>Taal:</label>
        <select name="language">
            <option value="nl" <?= (isset($_SESSION['language']) && $_SESSION['language'] == 'nl') ? 'selected' : '' ?>>Nederlands</option>
            <option value="en" <?= (isset($_SESSION['language']) && $_SESSION['language'] == 'en') ? 'selected' : '' ?>>Engels</option>
        </select>
        <button type="submit">Opslaan</button>
    </form>
    <br>
    <a href="dashboard.php">Terug naar Dashboard</a>
</body>
</html>
