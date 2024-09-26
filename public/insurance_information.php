<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT insurance_provider, policy_number FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Verzekeringsinformatie</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Verzekeringsinformatie</h1>
    <p>Zorgverzekeraar: <?= htmlspecialchars($user['insurance_provider']) ?></p>
    <p>Polisnummer: <?= htmlspecialchars($user['policy_number']) ?></p>
    <br>
    <a href="dashboard.php">Terug naar Dashboard</a>
</body>
</html>
