<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $dentist_id = $_POST['dentist_id'];

    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ? AND role = 'dentist'");
    if ($stmt->execute([$dentist_id])) {
        echo "Tandarts succesvol verwijderd!";
    } else {
        echo "Er ging iets mis.";
    }
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE role = 'dentist'");
$stmt->execute();
$dentists = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Tandartsbeheer</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Tandartsbeheer</h1>
    <h2>Tandartsen</h2>
    <?php if ($dentists): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Naam</th>
                <th>Email</th>
                <th>Acties</th>
            </tr>
            <?php foreach ($dentists as $dentist): ?>
                <tr>
                    <td><?= htmlspecialchars($dentist['id']) ?></td>
                    <td><?= htmlspecialchars($dentist['name']) ?></td>
                    <td><?= htmlspecialchars($dentist['email']) ?></td>
                    <td>
                        <form method="POST" action="dentist_management.php">
                            <input type="hidden" name="dentist_id" value="<?= htmlspecialchars($dentist['id']) ?>">
                            <button type="submit" name="delete">Verwijderen</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Geen tandartsen gevonden.</p>
    <?php endif; ?>
    <br>
    <a href="dashboard.php">Terug naar Dashboard</a>
</body>
</html>
