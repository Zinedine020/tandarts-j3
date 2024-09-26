<?php
class DB
{
  private $dbh;
  protected $stmt;

  public function __construct($db, $host = "localhost:3306", $user = "root", $pass = "")
  {
    try {
      $this->dbh = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
      $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      die("Connection failed: " . $e->getMessage());
    }
  }

  public function run($sql, $placeholder = NULL)
  {
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute($placeholder);
    return $stmt;
  }

  public function lastInsertId()
  {
    return $this->dbh->lastInsertId(); // Use PDO's method
  }
}

$mydb = new DB("tandartspraktijk");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $datum = trim($_POST['datum']);
  $tijd = trim($_POST['tijd']);
  $beschrijving = trim($_POST['beschrijving']);
  $gebruikerid_patient = trim($_POST['gebruikerid_patient']);
  $gebruikerid_tandarts = trim($_POST['gebruikerid_tandarts']);

  // Validation
  if (empty($datum) || empty($tijd) || empty($beschrijving) || empty($gebruikerid_patient) || empty($gebruikerid_tandarts)) {
    echo "Vul alstublieft alle velden in.";
    exit;
  }

  if (!is_numeric($gebruikerid_patient) || !is_numeric($gebruikerid_tandarts)) {
    echo "Ongeldige gebruiker ID's.";
    exit;
  }

  // Check for existing appointment
  $sql = "SELECT * FROM afspraken WHERE datum = ? AND tijd = ?";
  $stmt = $mydb->run($sql, [$datum, $tijd]);

  if ($stmt->rowCount() > 0) {
    echo "Dit tijdslot is al geboekt. Kies een andere tijd.";
  } else {
    // Insert new appointment
    $sql = "INSERT INTO afspraken (datum, tijd, beschrijving, gebruikerid_patient, gebruikerid_tandarts) 
        VALUES (?, ?, ?, ?, ?)";
    try {
      $mydb->run($sql, [$datum, $tijd, $beschrijving, $gebruikerid_patient, $gebruikerid_tandarts]);
      $afspraakid = $mydb->lastInsertId();
      header("Location: afspraak_beheer.php?afspraakid=" . $afspraakid);
      exit;
    } catch (PDOException $e) {
      echo "Er ging iets mis bij het opslaan van de afspraak. Probeer het opnieuw.";
    }
  }
}