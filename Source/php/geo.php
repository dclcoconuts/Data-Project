<?php
ob_start();
echo 'Numero ' . htmlspecialchars($_GET["dep"]) . 'Département';
ob_end_clean();
$dep = $_GET["dep"];

$host = '127.0.0.1';
$db   = 'DATA_PROJECT';
$user = 'DP';
$pass = 'Data_Project';
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

$stmt = $pdo->query("SELECT GPS_LAT, GPS_LNG FROM VILLE where NOMVILLE='$result'");
while ($row = $stmt->fetch())
{
     $glat = $row['GPS_LAT'];
     $glng = $row['GPS_LNG'];
  }

//Recuperer le nombre de ville du departement selectionner

// $stmt = $pdo->query("SELECT NUMDEPT, COUNT(*) as NB FROM VILLE where NUMDEPT='$dep'");
// while ($row = $stmt->fetch())
// {
//     $NbVille = $row['NB'];
//   }

// Recuperer nom de chaque ville du departement selectionne ainsi que sa latitude et sa longitude

$stmtVille = $pdo->query("SELECT NOMVILLE, GPS_LAT, GPS_LNG FROM VILLE where NUMDEPT='$dep'");
$tableau = array();
while ($row = $stmtVille->fetch()){
    $tableau[] = array($row['NOMVILLE'],$row['GPS_LAT'],$row['GPS_LNG']);
};

?>