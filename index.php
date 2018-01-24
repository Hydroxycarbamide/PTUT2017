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

	<!-- PAGE PRINCIPALE -->
	<div class="page-principale">
		<div id="push" style="padding-top:60px;"></div>
		<!-- CAROUSEL -->
		<?php	include('php/carrousel.php'); ?>

		<!-- Participer -->
		<div id="conteneur-first cf" class="conteneur conteneur-inscription" style="margin-top: 20px">

			<?php
				//selectionne tous les sponsorss
				$allsponsors= $db->prepare('SELECT * FROM partenaires WHERE choix=:choix');
				$allsponsorsExecute=$allsponsors->execute(array("choix"=>"s"));
				if(!$allsponsorsExecute){
					echo "<p> Erreur lors de la recherche des sponsors existants.</p>";
				}else{?>
					<div class="sponsorG"><?php
						$i=0;
						foreach($allsponsors as $chaqueS){
							$i++;
							if($i%2==1){?>
								<p> <img src="<?php echo $chaqueS['photoP'];?>" style="height: auto; width: 200px;"/> </p><br/><?php
							}
						}	?>
					</div><?php
				}

				$allsponsors= $db->prepare('SELECT * FROM partenaires WHERE choix=:choix');
				$allsponsorsExecute=$allsponsors->execute(array("choix"=>"s"));
				if(!$allsponsorsExecute){
					echo"<p> Erreur lors de la recherche des sponsors existants.</p>";
				}else{?>
					<div class="sponsorD"><?php
						$i=0;
						foreach($allsponsors as $chaqueS){
							$i++;
							if($i%2==0){?>
								<p> <img src="<?php echo $chaqueS['photoP'];?>" style="height: auto; width: 200px;"/> </p><br/><?php
							}
						}	?>
					</div><?php
				}
			?>

			<div class="conteneur-div filtre text-center">

				<h2>40e congrès de l'APLIUT</h2>
				<img alt="inscription" style="height:204px; max-width: 176px;" src="https://www.tameteo.com/wimages/fotocb05a8fc673fe585547bd075b35c78c1.png">
				<div class="present-text">
					<p>Toulouse</p>
					<p>Internationalisation des formations et enseignement / apprentissage des langues</p>
					<p>31 mai – 2 juin 2018</p>
					<a href="inscription.php">S'inscrire<span class="icon-circle-right"></span></a>
				</div>
			</div>

			<div class="col-sm-6" style="float: none;margin: 0 auto;">
				<?php
				$req = $db->prepare("SELECT lien FROM accueil WHERE nom = 'videoPres'");
				$req->execute();
				$accueil = $req->fetch();
				if(strlen($accueil['lien'])!=0){
					echo "<div class='embed-responsive embed-responsive-16by9'>";
					echo "<iframe class='embed-responsive-item' src='https://www.youtube.com/embed/".$accueil['lien']."'></iframe>";
					echo "</div>";
				}?>
			</div>
		</div>

		<!-- Programme -->
		<div class="conteneur conteneur-programme">
			<div class="conteneur-div filtre">
	            <a href="colloque2018.php#programme"><h2>Programme</h2></a>
				<div class="present-images">
					<?php afficherProgramme(); ?>
				</div>
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
