<?php
$edifice = addslashes($_GET["edifice"]);
$commune = addslashes($_GET["commune"]);
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
$tabnewPhoto = array();

$stmtnewPhotos = $pdo->query("SELECT IMAGE FROM PHOTOS where COMMUNE='$commune' and EDIFICE='$edifice'");
while ($rownew = $stmtnewPhotos->fetch()){
    if ($rownew != FALSE) {
        $tabnewPhoto[] = array($rownew['IMAGE']);
    };
};
?>