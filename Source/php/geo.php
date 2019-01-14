<?php
ob_start();
echo 'Numero ' . htmlspecialchars($_GET["dep"]) . 'Département';
ob_end_clean();
$dep = $_GET["dep"];

$host = '127.0.0.1';
$db   = 'DATA_PROJECT';
$user = '';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
// VILLE PREFECTURE

$stmt = $pdo->query("SELECT PREFECTURE FROM PREFECTURE where NUMDEPT='$dep'");
while ($row = $stmt->fetch())
{
    $result = $row['PREFECTURE'];
  }

// PREFECTURE GPS

$stmt = $pdo->query("SELECT GPS_LAT FROM VILLE where NOMVILLE='$result'");
while ($row = $stmt->fetch())
{
     $glat = $row['GPS_LAT'];
  }

$stmt = $pdo->query("SELECT GPS_LNG FROM VILLE where NOMVILLE='$result'");
while ($row = $stmt->fetch())
{
    $glng = $row['GPS_LNG'];
  }

?>
