<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $appointment_id = $_POST['appointment_id'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    
    $stmt = $pdo->prepare("UPDATE appointments SET appointment_date = ?, appointment_time = ? WHERE id = ?");
    if ($stmt->execute([$appointment_date, $appointment_time, $appointment_id])) {
        echo "Afspraken gewijzigd!";
    } else {
        echo "Er ging iets mis.";
    }
}

$appointment_id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM appointments WHERE id = ?");
$stmt->execute([$appointment_id]);
$appointment = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Afspraken Wijzigen</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Afspraken Wijzigen</h1>
    <form method="POST" action="edit_appointment.php">
        <input type="hidden" name="appointment_id" value="<?= htmlspecialchars($appointment['id']) ?>">
        <label>Datum:</label>
        <input type="date" name="appointment_date" value="<?= htmlspecialchars($appointment['appointment_date']) ?>" required><br>
        <label>Tijd:</label>
        <input type="time" name="appointment_time" value="<?= htmlspecialchars($appointment['appointment_time']) ?>" required><br>
        <button type="submit">Opslaan</button>
    </form>
    <a href="dashboard.php">Terug naar Dashboard</a>
</body>
</html>

