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

    $servername = 'localhost';
    $dbname = 'DATA_PROJECT';
    $username = 'DP';
    $password = 'Data_Project';


    // Futur - créer la base de données

    // creer un utilisateur 
    // donner les droits d'administration sur la base à l'utilisateur
    // $sql  = 'CREATE USER \'DP_TEST\'@\'localhost\' IDENTIFIED WITH mysql_native_password AS \'***\'GRANT USAGE ON *.* 
    // TO \'DP_TEST\'@\'localhost\' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 
    // MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0GRANT ALL PRIVILEGES ON `DATA_TEST`.* TO \'DP_TEST\'@\'localhost\'';

    // connexion PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec('SET NAMES utf8');

///////////////////////////////////////
// Pour remplir la table DEPARTEMENT //
///////////////////////////////////////
    $fichier = 'Departement.csv';
    // inserer les fichiers CSV
    // On instancie l'objet SplFileObject
    $csv = new SplFileObject($fichier); 
    // On indique que le fichier est de type CSV
    $csv->setFlags(SplFileObject::READ_CSV); 
    // On indique le caractère délimiteur, ici c'est la virgule
    $csv->setCsvControl(','); 

    // pour ignorer la contrainte de clé etrangère
    $requete_pdo = $conn->prepare("set FOREIGN_KEY_CHECKS=0");
    $requete_pdo->execute();
    // remplissage de la table
    foreach($csv as $ligne){
        if ($ligne[0]!=NULL)
        {
         // $ligne est un array qui contient chaque champs    
        $nomdept=addslashes($ligne[2]);
        $nomdeptmaj=addslashes($ligne[3]);
        $slugdept=addslashes($ligne[4]);
        // insert SQL dans la table
        $requete_pdo = $conn->prepare("INSERT IGNORE INTO DEPARTEMENT (ID_DEPT, NUMDEPT, NOMDEPT, NOMDEPTMAJ, SLUGDEPT) VALUES ('$ligne[0]','$ligne[1]', '$nomdept', '$nomdeptmaj', '$slugdept')");
        $requete_pdo->execute();
        }
        else
        {
            break;
        }
    }
    // pour remettre la contrainte de clé etrangère
    $requete_pdo = $conn->prepare("set FOREIGN_KEY_CHECKS=1");
    $requete_pdo->execute();

//////////////////////////////////////
// Pour remplir la table PREFECTURE //
//////////////////////////////////////
    $fichier = 'Prefecture.csv';
        // inserer les fichiers CSV
    // On instancie l'objet SplFileObject
    $csv = new SplFileObject($fichier); 
    // On indique que le fichier est de type CSV
    $csv->setFlags(SplFileObject::READ_CSV); 
    // On indique le caractère délimiteur, ici c'est la virgule
    $csv->setCsvControl(','); 

    // pour ignorer la contrainte de clé etrangère
    $requete_pdo = $conn->prepare("set FOREIGN_KEY_CHECKS=0");
    $requete_pdo->execute();
    // remplissage de la table
    foreach($csv as $ligne){

        if ($ligne[0]!=NULL)
        {
        // $ligne est un array qui contient chaque champs  
        $nomdept=addslashes($ligne[2]);
        $prefecture=addslashes($ligne[3]);
        $region=addslashes($ligne[4]);

        //insert SQL dans la table
        $requete_pdo = $conn->prepare("INSERT IGNORE INTO PREFECTURE (ID_PREF, NUMDEPT, NOMDEPT, PREFECTURE, REGION) VALUES ('$ligne[0]','$ligne[1]','$nomdept','$prefecture','$region')");
        $requete_pdo->execute();
        }
        else
        {
            break;
        }
    }
    // pour remettre la contrainte de clé etrangère
    $requete_pdo = $conn->prepare("set FOREIGN_KEY_CHECKS=1");
    $requete_pdo->execute();

//////////////////////////////////
// Pour remplir la table VILLE //
//////////////////////////////////
    $fichier = 'Ville.csv';
    // inserer les fichiers CSV
    // On instancie l'objet SplFileObject
    $csv = new SplFileObject($fichier); 
    // On indique que le fichier est de type CSV
    $csv->setFlags(SplFileObject::READ_CSV); 
    // On indique le caractère délimiteur, ici c'est la virgule
    $csv->setCsvControl(','); 

    // pour ignorer la contrainte de clé etrangère
    $requete_pdo = $conn->prepare("set FOREIGN_KEY_CHECKS=0");
    $requete_pdo->execute();
    // remplissage de la table
    foreach($csv as $ligne){


        if ($ligne[0]!=NULL)
        {
        // $ligne est un array qui contient chaque champs  
        $nomville=addslashes($ligne[2]);
        $slugville=addslashes($ligne[3]);
        //insert SQL dans la table
        $requete_pdo = $conn->prepare("INSERT IGNORE INTO VILLE (ID_VILLE, NUMDEPT, NOMVILLE, SLUGVILLE, GPS_LAT, GPS_LNG) VALUES ('$ligne[0]','$ligne[1]','$nomville','$slugville','$ligne[4]','$ligne[5]')");
        $requete_pdo->execute();
        }
        else
        {
            break;
        }
    }
    // pour remttre la contrainte de clé etrangère
    $requete_pdo = $conn->prepare("set FOREIGN_KEY_CHECKS=1");
    $requete_pdo->execute();

//////////////////////////////////
// Pour remplir la table PHOTOS //
//////////////////////////////////
    $fichier = 'Photos.csv';
    // inserer les fichiers CSV
    // On instancie l'objet SplFileObject
    $csv = new SplFileObject($fichier); 
    // On indique que le fichier est de type CSV
    $csv->setFlags(SplFileObject::READ_CSV); 
    // On indique le caractère délimiteur, ici c'est la virgule
    $csv->setCsvControl(','); 

    // pour ignorer la contrainte de clé etrangère
    $requete_pdo = $conn->prepare("set FOREIGN_KEY_CHECKS=0");
    $requete_pdo->execute();
    // remplissage de la table
    foreach($csv as $ligne){

        if ($ligne[0]!=NULL)
        {
        // $ligne est un array qui contient chaque champs  
        $commune=addslashes($ligne[2]);
        $edifice=addslashes($ligne[3]);
        $legende=addslashes($ligne[4]);
        $auteur=addslashes($ligne[5]);
        $miniature=addslashes($ligne[7]);
        $image=addslashes($ligne[8]);
        //insert SQL dans la table
        $requete_pdo = $conn->prepare("INSERT IGNORE INTO PHOTOS (ID_PHOTO, NUMDEPT, COMMUNE, EDIFICE, LEGENDE, AUTEUR, DATE, MINIATURE, IMAGE) VALUES ('$ligne[0]','$ligne[1]','$commune','$edifice','$legende','$auteur','$ligne[6]','$miniature','$image')");
        $requete_pdo->execute();
        }
        else
        {
            break;
        }
    }
    // pour remttre la contrainte de clé etrangère
    $requete_pdo = $conn->prepare("set FOREIGN_KEY_CHECKS=1");
    $requete_pdo->execute();




    $requete_pdo->closeCursor();
?>

</body>
</html>
