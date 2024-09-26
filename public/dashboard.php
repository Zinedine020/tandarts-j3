<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Tandartspraktijk</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <h2>Dashboard</h2>
        <?php if ($role == 'patient'): ?>
            <p>Welkom, patiënt! Hier kunt u uw afspraken beheren en uw profiel bijwerken.</p>
            <a href="appointments.php">Bekijk Afspraken</a>
        <?php elseif ($role == 'dentist'): ?>
            <p>Welkom, tandarts! Hier kunt u uw patiëntenlijst bekijken en afspraken beheren.</p>
            <a href="patients.php">Bekijk Patiëntenlijst</a>
        <?php endif; ?>
    </main>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>
