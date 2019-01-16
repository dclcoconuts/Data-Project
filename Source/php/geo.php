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
    $result = addslashes($row['PREFECTURE']);
}

// PREFECTURE GPS

$stmt = $pdo->query("SELECT GPS_LAT, GPS_LNG FROM VILLE where NOMVILLE='$result' AND NUMDEPT='$dep'");
while ($row = $stmt->fetch())
{
     $glat = $row['GPS_LAT'];
     $glng = $row['GPS_LNG'];
}


// Recuperer nom de chaque ville présente dans le fichier PHOTOS pour le département
// et selectionne sa latitude et sa longitude dans le fichier VILLE
$tabVille = array();
$tabPhoto = array();
$stmtPhotos = $pdo->query("SELECT COMMUNE, EDIFICE, LEGENDE, AUTEUR, DATE, MINIATURE FROM PHOTOS where NUMDEPT='$dep'");
while ($row = $stmtPhotos->fetch()){
    $tabPhoto[] = array($row['COMMUNE'],$row['EDIFICE'],$row['LEGENDE'],$row['AUTEUR'],$row['DATE'],$row['MINIATURE']);
    $resultat = addslashes($row['COMMUNE']);

    $stmtVille = $pdo->query("SELECT NOMVILLE, GPS_LAT, GPS_LNG FROM VILLE where NOMVILLE='$resultat'");
    $row1 = $stmtVille->fetch();
    $tabVille[] = array($row1['NOMVILLE'],$row1['GPS_LAT'],$row1['GPS_LNG']);
};


var_dump($tabPhoto);
// var_dump($tabVille);




?>