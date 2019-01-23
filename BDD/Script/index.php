<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
     <link rel="stylesheet" type="text/css" href="./css/style.css"> 
    <title>Remplissage BDD en PHP</title>
</head>

<script>

</script>


<body>
    <header>
	    <h1>Script de création et remplissage de la base de données</h1>
    </header>
    <div id="corps">
        <div id="explain">
            <br>
            <h2>Ce script permet de créer la base de données nécessaire au fonctionnement 
                de l'application Data-Project.</h2>
            <br><br>

            <h2>Procédure</h2>
            <br>
                <p>*  Renseigner les informations d'utilisateur et de mot de passe dans le fichier
                    config.json</p>
            <br>
                <p>* Lancer le script de création et Patienter</p>
            <br><br><br>
            <button type="button" id="button" onclick="createbase()">Lancer la création</button>
        </div>

        <div id="resultat">
            <br>
            <h2>Le traitement est terminé</h2>
            <h2>La base de données a été créée avec succès et les tables ont été remplies</h2>
            <br><br>
            <a class="carte" href="../../index.php"><img src="./css/france-map.png" alt="Retour à l'application"></a>
        </div>


        <div id="loader">
        </div>
        <div id="text">
            <h2>Veuillez patienter, ce traitement peut prendre plusieurs minutes</h2>
        </div>
    </div>

    <footer>
			<span class="lien"class="lien" href="#">Copyright © 2019 Dcl-Aramis</span>

	</footer>
    <script src="./js/traitement.js"></script>
</body>
</html>
