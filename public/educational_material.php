<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Voorbeeldmateriaal
$educational_material = [
    'Dutch' => [
        'Introductie tot Tandheelkunde' => 'educational_material/dutch_intro.pdf',
        'Basisbehandelingen' => 'educational_material/dutch_basic_treatments.pdf',
    ],
    'English' => [
        'Introduction to Dentistry' => 'educational_material/english_intro.pdf',
        'Basic Treatments' => 'educational_material/english_basic_treatments.pdf',
    ]
];

$language = isset($_SESSION['language']) ? $_SESSION['language'] : 'nl';
$material = $language == 'en' ? $educational_material['English'] : $educational_material['Dutch'];
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Educatief Materiaal</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Educatief Materiaal</h1>
    <ul>
        <?php foreach ($material as $title => $link): ?>
            <li><a href="<?= htmlspecialchars($link) ?>" download><?= htmlspecialchars($title) ?></a></li>
        <?php endforeach; ?>
    </ul>
    <br>
    <a href="dashboard.php">Terug naar Dashboard</a>
</body>
</html>
