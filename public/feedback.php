<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_SESSION['user_id'];
    $dentist_id = $_POST['dentist_id'];
    $feedback_text = $_POST['feedback_text'];
    $rating = $_POST['rating'];
    
    $stmt = $pdo->prepare("INSERT INTO feedback (patient_id, dentist_id, feedback_text, rating) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$patient_id, $dentist_id, $feedback_text, $rating])) {
        echo "Feedback ingediend!";
    } else {
        echo "Er ging iets mis.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Feedback Geven</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Feedback Geven</h1>
    <form method="POST" action="feedback.php">
        <label>Tandarts ID:</label>
        <input type="text" name="dentist_id" required><br>
        <label>Feedback:</label>
        <textarea name="feedback_text" required></textarea><br>
        <label>Rating (1-5):</label>
        <input type="number" name="rating" min="1" max="5" required><br>
        <button type="submit">Verzenden</button>
    </form>
    <a href="dashboard.php">Terug naar Dashboard</a>
</body>
</html>
