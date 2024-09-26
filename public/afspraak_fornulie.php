
<!DOCTYPE html>
<html lang="nl">  
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Afspraak Inplannen</title> 
  <link rel="stylesheet" href="assets/css/login.css">
  
</head>
<body>
<?php include 'includes/header.php'; ?>

  <h2>Afspraak Inplannen</h2>
  

  <!-- Formulier voor het inplannen van een afspraak -->
  <form action="afspraak_opslaan.php" method="post">
    <label for="datum">Datum:</label>
    <input type="date" id="datum" name="datum" required><br><br>

    <label for="tijd">Tijd:</label>
    <input type="time" id="tijd" name="tijd" required><br><br>

    <label for="beschrijving">Beschrijving:</label>
    <textarea id="beschrijving" name="beschrijving" required></textarea><br><br>

    <label for="gebruikerid_patient">Patiënt:</label>
    <select id="gebruikerid_patient" name="gebruikerid_patient" required>
      <option value="">Selecteer patiënt</option>
      <?php foreach ($patiënten as $patiënt): ?>
        <option value="<?= htmlspecialchars($patiënt['gebruikerid']) ?>"><?= htmlspecialchars($patiënt['naam']) ?></option>
      <?php endforeach; ?>
    </select><br><br>

    <label for="gebruikerid_tandarts">Tandarts:</label>
    <select id="gebruikerid_tandarts" name="gebruikerid_tandarts" required>
      <option value="">Selecteer tandarts</option>
      <?php foreach ($tandartsen as $tandarts): ?>
        <option value="<?= htmlspecialchars($tandarts['gebruikerid']) ?>"><?= htmlspecialchars($tandarts['naam']) ?></option>
      <?php endforeach; ?>
    </select><br><br>

    <input type="submit" value="Afspraak Inplannen">

    <?php include 'includes/footer.php'; ?>
  </form>
</body>
</html>