<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Remplissage BDD en PHP</title>
</head>
<body>
    <!-- formulaire de saisie des informations -->
    <!-- nom du fichier csv -->
    <!-- nom de la base de données -->
    <!-- nom de la table -->

<?php
    $file_json = file_get_contents("config.json");
    $parsed_json = json_decode($file_json, true);
    $dbadmin = $parsed_json['dbadmin'];
    $adminPass = $parsed_json['adminPass'];
    $servername = $parsed_json['servername'];
    $dbname = $parsed_json['dbname'];
    $username = $parsed_json['username'];
    $password = $parsed_json['password'];


    // Se connecter à sql
    $conn = new PDO("mysql:host=$servername", $dbadmin, $adminPass);

    // Supprimer la base de données si elle existe
    $requete_pdo = "DROP DATABASE IF EXISTS ".$dbname;
    $conn->prepare($requete_pdo)->execute();
    echo ($requete_pdo);

    // Supprimer la base de données si elle existe
    $requete_pdo = "CREATE DATABASE ".$dbname;
    $conn->prepare($requete_pdo)->execute();
    echo ($requete_pdo);

    // Utiliser la nouvelle database
    $requete_pdo = "USE ".$dbname;
    $conn->prepare($requete_pdo)->execute();
    echo ($requete_pdo);   

    $requete_pdo = 'CREATE USER \'DP_TEST\'@\'localhost\' IDENTIFIED WITH mysql_native_password AS \'***\'GRANT USAGE ON *.* 
    TO \'DP_TEST\'@\'localhost\' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 
    MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0GRANT ALL PRIVILEGES ON `DATA_TEST`.* TO \'DP_TEST\'@\'localhost\'';



?>
</body>
</html>
