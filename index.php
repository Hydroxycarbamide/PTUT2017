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
		<div id="conteneur-first cf" class="conteneur conteneur-inscription" style="margin-top: 20px; margin-bottom: 20px">

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
				<h2 style="color:#6B63CA;">40e congrès de l'APLIUT</h2>

				<div class="present-images">
					<div class="present-text">
						<b><p style="color:#6B63CA;font-size:1.5em;">Toulouse</p></b>
						<b><p style="color:#6B63CA;font-size:1.5em;">L'internationalisation des formations et l'enseignement/apprentissage des langues</p></b>
						<b><p style="color:#6B63CA;font-size:1.5em;">Du 31 mai au 2 juin 2018</p></b>
						<a href="inscription.php">S'inscrire<span class="icon-circle-right"></span></a>
					</div>

					<!-- Programme -->
					<div class="conteneur conteneur-programme">
						<div class="conteneur-div filtre">
							<div class="present-images">
								<?php afficherProgramme(); ?>
							</div>
						</div>
					</div>


					<!--WIDGET METEO-->
					<img style="width:530px" src="https://www.tameteo.com/wimages/fotoab7ecac22f9c1ca2dce08fd4802d1fa5.png">


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
