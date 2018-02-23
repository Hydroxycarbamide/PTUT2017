<!DOCTYPE html>
<html lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
	<!-- FEUILLES DE STYLE -->
	<link rel="icon" type="text/css" href="./images/favicon.ico">
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
	<title>Congrès APLIUT 2018 - Inscription</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery-2-1-4-min.js"></script>
</head>
<body>
	<!-- EN-TETE -->
	<header>
		<?php
		require('php/connexion.php');
		include('php/convertirDate.php');
		include('php/menu.php');
		?>
	</header>

	<!-- PAGE PRINCIPALE -->
	<div class="page-principale page-inscription">
		<div id="push" style="padding-top:60px;"></div>
		<!-- GRAND TITRE -->
		<div class="conteneur conteneur-colloque conteneur-colloque-h1">
			<h1>ESOF</h1>
		</div>


		<!-- PRÉSENTATION -->
		<div class="conteneur conteneur-colloque conteneur-colloque-presentation">
			<div style="text-align: center; margin-bottom:2em;">
				<img style="height:200px; width:auto;" src="images/Logotype-ESOF-Label-WEBssfond[1313].png">
      </div>
      <div class="row">
        <div class="col-sm-6">
          <h2>A propos d’ESOF Toulouse 2018</h2>
        </div>
        <div class="col-sm-6">
          <h2>About ESOF Toulouse 2018</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <p>Plus grande biennale européenne sur la science et l’Innovation en Europe, l’EuroScience Open Forum (ESOF) aura lieu à Toulouse du 9 au 14 juillet 2018.</p>
          <p>Parce qu’elle accueille cet événement, Toulouse deviendra en 2018 «Cité européenne de la Science».</p>
          <p>ESOF 2018 aura pour thème « Partager la science : vers de nouveaux horizons ». L’événement s’articulera autour de cinq volets - « Science », « Science Policy », « Science to Business », « Careers », « Media & Science Communication », d’une exposition professionnelle et d’un festival destiné au grand public « Science in the City ». Un ensemble de thématiques couvrant tous les domaines scientifiques et leurs relations avec la société seront abordés dans cette manifestation multidisciplinaire au travers de conférences, expositions et événements satellites.</p>
        </div>
        <div class="col-sm-6">
          <p>The biennal European event, EuroScience Open Forum (ESOF) will take place in Toulouse, "European City of Science" from 9 to 14 July 2018. </p>
          <p>"Sharing science: towards new horizons" will be the motto of this ESOF 2018 edition, a 6-in-1 event including various sections “Science”, “Science policy”, “Science to Business”, “Careers” and “Media & Science Communication” and a “Science in the City” programme dedicated to the general public. A series of themes covering all fields of science and their relations with society are covered by this multidisciplinary event through conferences, exhibitions and satellite events.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <a class="lien-interne" href="https://www.esof.eu" target="_blank">Plus d'informations<span class="icon-circle-right"></span></a>
        </div>
        <div class="col-sm-6">
          <a class="lien-interne" href="https://www.esof.eu" target="_blank">More<span class="icon-circle-right"></span></a>
        </div>
      </div>
    </div>

    <div id="topButton"><span class="glyphicon glyphicon-menu-up"></span></div>
  </div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery-2-1-4-min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/colloque2018.js"></script>

	<!-- PIED DE PAGE -->
	<footer>
		<?php include('php/footer.php'); ?>
	</footer>

</body>
</html>
