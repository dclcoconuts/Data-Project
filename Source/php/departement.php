<?php include "geo.php";?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link href="../css/style.css" media="screen" rel="stylesheet" type="text/css" />
		<!-- Nous chargeons les fichiers CDN de Leaflet. Le CSS AVANT le JS -->
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin=""/>
		<script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js" integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg==" crossorigin=""></script>
		<link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css" />
		<link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css" />
		<script type='text/javascript' src='https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js'></script>

		<script type="text/javascript">
			// On initialise la latitude et la longitude de Paris (centre de la carte
			var lat = <?php echo json_encode($glat); ?>;
			var lon = <?php echo json_encode($glng); ?>;
			var macarte = null;
			// variable table : tableau contenant le résultat de la requête des differents marqueurs par dept
			var tabVille = <?php echo json_encode($tabVille); ?>;
			var tabPhoto = <?php echo json_encode($tabPhoto); ?>;
			var markerClusters;
			
			// Fonction d'initialisation de la carte
			function initMap() {
				// Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
				macarte = L.map('map').setView([lat, lon], 11);
				markerClusters = L.markerClusterGroup(); // Nous initialisons les groupes de marqueurs
                // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
                L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
                    // Il est toujours bien de laisser le lien vers la source des données
                    attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
                    minZoom: 1,
                    maxZoom: 20
				}).addTo(macarte);

			// CM : creation marqueur ppersonnalisé
			var monument = L.icon({
				iconUrl: '../img/galata-tower.png',
				iconSize: [40, 50],
				iconAnchor: [22, 94],
				popupAnchor: [-3, -76]

			});	

			// CM: Paramétrage taille de la fenêtre popup
			var customOptions = 
			{
				'minWidth': '400',
			};

   			// Nous ajoutons un marqueur
			// Nous parcourons la liste des villes
			
			for (i=0; i<tabPhoto.length; i++){
				var marker = L.marker([tabVille[i][1],tabVille[i][2]],{icon: monument});
				// CM : Pour personnaliser la fenêtre popup pour chaque marqueur
				var html = '';
				html += '<h2>Commune : ' + tabPhoto[i][0] + '</h2></br>';
				html += '<h4>Edifice : ' + tabPhoto[i][1] + '</h4></br>';
				html += '<h4>Legende : ' + tabPhoto[i][2] + '</h4></br>';
				html += '<h4>Auteur : ' + tabPhoto[i][3] + '</h4></br>';
				html += '<h4>Date : ' + tabPhoto[i][4] + '</h4></br>';				
				html += '<img src=\"' + tabPhoto[i][5]+ '\" style=\"width:200px;height:200px\"=/></br>';		
				marker.bindPopup(html,customOptions);
				
				markerClusters.addLayer(marker); // Nous ajoutons le marqueur aux groupes
				}
				macarte.addLayer(markerClusters);
            };


			window.onload = function(){
				// Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
				initMap();
			};

		</script>
		<title>Departement</title>
	</head>
	<body>
		<div id="map"></div>
		<a class="carte" href="../../index.php"><img src="../img/france-map.png" alt="bouton"></a>
	</body>
</html>
