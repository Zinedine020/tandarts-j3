<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: register.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $role == 'dentist' ? htmlspecialchars($_POST['patient_id']) : $user_id;
    $dentist_id = htmlspecialchars($_POST['dentist_id']);
    $appointment_date = htmlspecialchars($_POST['appointment_date']);
    $appointment_time = htmlspecialchars($_POST['appointment_time']);
    $treatment_type = htmlspecialchars($_POST['treatment_type']);

    $stmt = $pdo->prepare("INSERT INTO appointments (patient_id, dentist_id, appointment_date, appointment_time, treatment_type) VALUES (?, ?, ?, ?, ?)");
    if ($stmt->execute([$patient_id, $dentist_id, $appointment_date, $appointment_time, $treatment_type])) {
        echo "Afspraak gemaakt!";
    } else {
        echo "Er ging iets mis.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afspraken - Tandartspraktijk</title>
    <link rel="stylesheet" href="assets/css/login.css">

</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <h2>Afspraken Beheren</h2>
        <?php if ($role == 'patient'): ?>
            <h3>Maak een Afspraak</h3>
            <form method="POST" action="appointments.php">
                <label for="dentist_id">Tandarts:</label>
                <select id="dentist_id" name="dentist_id" required>
                    <!-- Dynamisch vullen met tandartsen uit de database -->
                    <?php
                    $stmt = $pdo->query("SELECT id, name FROM users WHERE role = 'dentist'");
                    while ($row = $stmt->fetch()) {
                        echo "<option value='{$row['id']}'>{$row['name']}</option>";
                    }
                    ?>
                </select><br>
                
                <label for="appointment_date">Datum:</label>
                <input type="date" id="appointment_date" name="appointment_date" required><br>
                
                <label for="appointment_time">Tijd:</label>
                <input type="time" id="appointment_time" name="appointment_time" required><br>
                
                <label for="treatment_type">Type Behandeling:</label>
                <input type="text" id="treatment_type" name="treatment_type" required><br>
                
                <button type="submit">Maak Afspraak</button>
            </form>
        <?php elseif ($role == 'dentist'): ?>
            <h3>Bekijk Afspraken</h3>
            <table>
                <thead>
                    <tr>
                        <th>Patiënt</th>
                        <th>Datum</th>
                        <th>Tijd</th>
                        <th>Behandeling</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $pdo->prepare("SELECT u.name as patient_name, a.appointment_date, a.appointment_time, a.treatment_type 
                                            FROM appointments a
                                            JOIN users u ON a.patient_id = u.id
                                            WHERE a.dentist_id = ?");
                    $stmt->execute([$user_id]);
                    while ($row = $stmt->fetch()) {
                        echo "<tr>
                                <td>{$row['patient_name']}</td>
                                <td>{$row['appointment_date']}</td>
                                <td>{$row['appointment_time']}</td>
                                <td>{$row['treatment_type']}</td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>

            