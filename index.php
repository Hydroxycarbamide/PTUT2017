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
		include('php/convertirDate.php');
		include('php/menu.php');
		?>
	</header>

	<!-- PAGE PRINCIPALE -->
	<div class="page-principale">

		<!-- CAROUSEL -->
		<?php	include('php/carrousel.php'); ?>

		<!-- Participer -->
		<div id="conteneur-first cf" class="conteneur conteneur-inscription">
			<div class="conteneur-div filtre">
				<h2>Les dates</h2>
				<img alt="inscription" src="https://www.tameteo.com/wimages/foto0d8660438f89a21ac931ae9f8d504a18.png">
				<div class="present-text">
					<p>
						<?php
						# Affichage des dates du congrès
						$datesCongres = $db->prepare('SELECT * FROM joursColloque');
						$datesCongres->execute();

						while ($chaqueDate = $datesCongres->fetch()) {
							?>
							<strong><?php echo str_replace(array("\r\n","\n", '\n'),"<br />", convertirDate($chaqueDate['dateColloque'])); ?></strong><br />
							<?php
						}
						$datesCongres->closeCursor();
						?>
					</p>
					<p>N'hésitez pas à vous inscrire</p>
					<a href="inscription.php">S'inscrire<span class="icon-circle-right"></span></a>
				</div>
			</div>
		</div>

		<!-- Programme -->
		<div class="conteneur conteneur-programme">
			<div class="conteneur-div filtre">
				<h2>Programme</h2>
				<div class="present-images">
					<p>Consultez le planing du congrès et son déroulement.</p>
					<?php
						# Affichage des dates du congrès
					$datesCongres2 = $db->prepare('SELECT * FROM joursColloque');
					$datesCongres2->execute();

					while ($chaqueDate2 = $datesCongres2->fetch()) {
						?>
						<!-- Événement # -->
						<figure class="fig-img fig-img<?php echo $chaqueDate2['idColloque']; ?>">
							<a href="colloque2018.php#programme"><span class="glyphicon glyphicon-calendar gc"></span></a>
							<figcaption><?php echo convertirDate($chaqueDate2['dateColloque']); ?></figcaption>
						</figure>
						<?php
					}
					$datesCongres2->closeCursor();
					?>
				</div>

				<!--a class="lien-interne" href="colloque2018.php#programme">En savoir plus<span class="icon-circle-right"></span></a-->
			</div>
		</div>


		<!-- Informations pratiques -->
		<div class="conteneur conteneur-infoP">
			<div class="conteneur-div">
				<h2>Informations pratiques</h2>
				<div class="present-icons">
					<!-- Lieux touristiques -->
					<a href="infoP.php#tourisme">
						<figure class="fig-img fig-img1">
							<span class="icon-library"></span>
							<figcaption>Lieux touristiques</figcaption>
						</figure>
					</a>
					<!-- Hotels -->
					<a href="infoP.php#hotels">
						<figure class="fig-img fig-img2">
							<span class="icon-office"></span>
							<figcaption>Hôtels</figcaption>
						</figure>
					</a>
					<!-- Restaurants -->
					<a href="infoP.php#restauration">
						<figure class="fig-img fig-img3">
							<span class="icon-spoon-knife"></span>
							<figcaption>Restaurants</figcaption>
						</figure>
					</a>
					<!-- Transports -->
					<a href="infoP.php#transports">
						<figure class="fig-img fig-img3">
							<span class="icon-truck"></span>
							<figcaption>Transports</figcaption>
						</figure>
					</a>
				</div>
			</div>
		</div>

		<div id="topButton"><span class="glyphicon glyphicon-menu-up"></span></div>

	</div>

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
