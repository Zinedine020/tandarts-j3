
<?php
require_once 'db.php'; // Zorg ervoor dat het pad naar je DB-klasse correct is ingesteld

// Maak een nieuwe DB-verbinding
$mydb = new DB("tandartsplatform");

// Controleer of de gegevens zijn ingesteld
if (
  isset($_POST['naam']) &&
  isset($_POST['email']) &&
  isset($_POST['wachtwoord']) &&
  isset($_POST['adres']) &&
  isset($_POST['telefoonnummer']) &&
  isset($_POST['verzekeringsnummer']) &&
  isset($_POST['taal']) 
  ) {
  // Haal gegevens op uit het formulier
  $naam = $_POST['naam'];
  $email = $_POST['email'];
  $wachtwoord = $_POST['wachtwoord'];
  $adres = $_POST['adres'];
  $telefoonnummer = $_POST['telefoonnummer'];
  $verzekeringsnummer = $_POST['verzekeringsnummer'];
  $taal = $_POST['taal'];

  // Hash het wachtwoord
  $hashed_password = password_hash($wachtwoord, PASSWORD_DEFAULT);

  try {
    // SQL-query om gegevens in de database in te voegen
    $sql = "INSERT INTO Patiënten (Naam, Email, Wachtwoord, Adres, Telefoonnummer, Verzekeringsnummer, Taal)
        VALUES (:naam, :email, :wachtwoord, :adres, :telefoonnummer, :verzekeringsnummer, :taal)";

    // Voorbereiden en uitvoeren van de query
    $params = [
      ':naam' => $naam,
      ':email' => $email,
      ':wachtwoord' => $hashed_password,
      ':adres' => $adres,
      ':telefoonnummer' => $telefoonnummer,
      ':verzekeringsnummer' => $verzekeringsnummer,
      ':taal' => $taal
    ];
    echo "Roept run-function";
    $stmt = $mydb->run($sql, $params);
    echo "Registratie succesvol!";
    header("Location: login.php");
    } catch (PDOException $e) {
    echo "Fout: " . $e->getMessage();
  }
} 
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Tandartspraktijk</title>
    <link rel="stylesheet" href="./assets/css/login.css">
</head>
<body class="body">
    <?php include 'includes/header.php'; ?>
   

    <main>

   
        <section class="hero">
            <div class="container">
                <h2>Welkom bij onze Tandartspraktijk</h2>
                <p>Wij bieden hoogwaardige tandheelkundige zorg in een comfortabele omgeving.</p>
                <a href="appointments.php" class="btn">Maak een afspraak</a>
            </div>
        </section>
        
        <section class="services">
            <div class="container">
                <h2>Onze Diensten</h2>
                <div class="service-item">
                    <h3>Reguliere Controles</h3>
                    <p>Voorkom problemen met regelmatige controles en professionele reiniging.</p>
                </div>
                <div class="service-item">
                    <h3>Cosmetische Tandheelkunde</h3>
                    <p>Verfraai uw glimlach met whitening en andere cosmetische behandelingen.</p>
                </div>
                <div class="service-item">
                    <h3>Specialistische Zorg</h3>
                    <p>Behandelingen door gespecialiseerde tandartsen voor complexe gevallen.</p>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
