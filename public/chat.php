<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST['message'];
    $user_id = $_SESSION['user_id'];
    
    $stmt = $pdo->prepare("INSERT INTO chat (user_id, message) VALUES (?, ?)");
    $stmt->execute([$user_id, $message]);
}

$stmt = $pdo->query("SELECT users.name, chat.message, chat.timestamp FROM chat JOIN users ON chat.user_id = users.id");
$messages = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Chat</title>
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
    <h1>Chat</h1>
    <div id="chat-box">
        <?php foreach ($messages as $msg): ?>
            <p><strong><?= htmlspecialchars($msg['name']) ?>:</strong> <?= htmlspecialchars($msg['message']) ?> <em><?= htmlspecialchars($msg['timestamp']) ?></em></p>
        <?php endforeach; ?>
    </div>
    <form method="POST" action="chat.php">
        <input type="text" name="message" required>
        <button type="submit">Verstuur</button>
    </form>
    <a href="dashboard.php">Terug naar Dashboard</a>
</body>
</html>
