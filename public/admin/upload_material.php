<?php
session_start();
require '../../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file = $_FILES['material'];
    $filePath = 'uploads/' . basename($file['name']);

    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        echo "Bestand geüpload!";
    } else {
        echo "Fout bij uploaden van bestand.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Upload Educatief Materiaal</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Upload Educatief Materiaal</h1>
    <form method="POST" enctype="multipart/form-data">
        <label>Kies bestand:</label>
        <input type="file" name="material" required><br>
        <button type="submit">Upload</button>
    </form>
    <a href="../dashboard.php">Terug naar Dashboard</a>
</body>
</html>
