
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
    echo "Toegevoegd aan DB";
    return $stmt;
  }
}

$mydb = new DB("tandartsplatform");
?>