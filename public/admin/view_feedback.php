<?php
session_start();
require '../../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$stmt = $pdo->query("SELECT * FROM feedback");
$feedbacks = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Feedback Bekijken</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Feedback Bekijken</h1>
    <table>
        <tr>
            <th>Patient ID</th>
            <th>Dentist ID</th>
            <th>Feedback</th>
            <th>Rating</th>
            <th>Datum</th>
        </tr>
        <?php foreach ($feedbacks as $feedback): ?>
            <tr>
                <td><?= htmlspecialchars($feedback['patient_id']) ?></td>
                <td><?= htmlspecialchars($feedback['dentist_id']) ?></td>
                <td><?= htmlspecialchars($feedback['feedback_text']) ?></td>
                <td><?= htmlspecialchars($feedback['rating']) ?></td>
                <td><?= htmlspecialchars($feedback['feedback_date']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="../dashboard.php">Terug naar Dashboard</a>
</body>
</html>
