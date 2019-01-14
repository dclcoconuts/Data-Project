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

			var lat = 47.08;
			var lon = 2.4;
			var macarte = null;
			var villes = {
				"Charost": { "lat": 46.9833, "lon": 2.1333 },
				"Vierzon": { "lat": 47.2167, "lon": 2.0833 },
				"Bourges": { "lat": 47.0833, "lon": 2.4 },
				"coucou": { "lat": 47.08, "lon": 2.42 },
				"Ourouer-les-Bourdelins": { "lat": 46.9167, "lon": 2.8167 },
				"Rians": { "lat": 47.1787, "lon": 2.6136 },
				"Avord" : {"lat": 47.0333, "lon": 2.65 }
				};
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
				// Nous ajoutons un marqueur
			// Nous parcourons la liste des villes
			for (ville in villes) {
				var marker = L.marker([villes[ville].lat, villes[ville].lon]);
				// Nous ajoutons la popup. A noter que son contenu (ici la variable ville) peut être du HTML
				marker.bindPopup(ville);
				markerClusters.addLayer(marker); // Nous ajoutons le marqueur aux groupes
				} 
				macarte.addLayer(markerClusters);
            }
			window.onload = function(){
				// Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
				initMap(); 
			};
		</script>
		<title>Departement</title>
	</head>
	<body>
		<div id="map"></div>
		<a class="bouton" href="../../index.php"><img src="../img/france-map.png" alt="bouton"></a>
	</body>
</html>