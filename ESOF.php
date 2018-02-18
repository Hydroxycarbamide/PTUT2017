<!DOCTYPE html>
<html lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
	<!-- FEUILLES DE STYLE -->
	<link rel="icon" type="text/css" href="./images/favicon.ico"></link>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"></link>
	<link rel="stylesheet" type="text/css" href="css/style.css"></link>
	<link rel="stylesheet" type="text/css" href="css/carrousel.css"></link>
	<link rel="stylesheet" type="text/css" href="css/menu.css"></link>
	<link rel="stylesheet" type="text/css" href="css/footer.css"></link>
	<link rel="stylesheet" type="text/css" href="css/main.css"></link>
	<!-- STYLE DU RESPONSIVE DESIGN -->
	<link rel="stylesheet" type="text/css" href="css/max1630px.css" media="screen and (min-width: 1445px) and (max-width: 1630px)"></link>
	<link rel="stylesheet" type="text/css" href="css/max1445px.css" media="screen and (min-width: 1280px) and (max-width: 1445px)"></link>
	<link rel="stylesheet" type="text/css" href="css/max1280px.css" media="screen and (min-width: 1032px) and (max-width: 1280px)"></link>
	<link rel="stylesheet" type="text/css" href="css/max1032px.css" media="screen and (min-width: 768px) and (max-width: 1032px)"></link>
	<link rel="stylesheet" type="text/css" href="css/mobile.css" media="screen and (max-width: 768px)"></link>
	<!-- ************************** -->
	<title>Congrès APLIUT 2018 - Accueil</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery-2-1-4-min.js"></script>
</head>
<body>
	<!-- EN-TETE -->
	<header>
		<?php
		require('php/connexion.php');
		require('php/affichages.php');
		include('php/convertirDate.php');
		include('php/menu.php');
		?>
	</header>

    <div class="page-principale page-principale-informationspratiques">
		<div id="push" style="padding-top:60px;"></div>
		<!-- GRAND TITRE -->
		<div class="conteneur conteneur-informationspratiques conteneur-informationspratiques-h1">

		</div>

        <div class="container" style="margin-bottom:2em;">
            <div style="text-align: center; margin-bottom:2em;">
                <img style="height:200px; width:auto;" src="images/Logotype-ESOF-Label-WEBssfond[1313].png">
            </div>

            <div style="margin-bottom:2em;">
                <b>A propos d’ESOF Toulouse 2018</b>
                <p style="text-align:justify">
                    Plus grande biennale européenne sur la science et l’Innovation en Europe, l’EuroScience Open Forum (ESOF) aura lieu à Toulouse du 9 au 14 juillet 2018.
                </p>
                <p style="text-align:justify">
                    Parce qu’elle accueille cet événement, Toulouse deviendra en 2018 «Cité européenne de la Science».
                </p>
                <p style="text-align:justify">
                    ESOF 2018 aura pour thème « Partager la science : vers de nouveaux horizons ». L’événement s’articulera autour de cinq volets - « Science », « Science Policy », « Science to Business », « Careers », « Media & Science Communication », d’une exposition professionnelle et d’un festival destiné au grand public « Science in the City ». Un ensemble de thématiques couvrant tous les domaines scientifiques et leurs relations avec la société seront abordés dans cette manifestation multidisciplinaire au travers de conférences, expositions et événements satellites.
                </p>

                <a href="www.esof.eu">www.esof.eu</a>
            </div>

            <div>
                <b>About ESOF Toulouse 2018</b>
                <p style="text-align:justify">The biennal European event, EuroScience Open Forum (ESOF) will take place in Toulouse, "European City of Science" from 9 to 14 July 2018. "Sharing science: towards new horizons" will be the motto of this ESOF 2018 edition, a 6-in-1 event including various sections “Science”, “Science policy”, “Science to Business”, “Careers” and “Media & Science Communication” and a “Science in the City” programme dedicated to the general public. A series of themes covering all fields of science and their relations with society are covered by this multidisciplinary event through conferences, exhibitions and satellite events.</p>
                <a href="www.esof.eu">www.esof.eu</a>
            </div>
        </div>
    </div>
    <br>

	<!-- FICHIERS CÔTÉ CLIENT -->
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/colloque2018.js">
	</script>

	<!-- PIED DE PAGE -->
	<footer>
		<?php include('php/footer.php'); ?>
	</footer>

</body>
</html>
