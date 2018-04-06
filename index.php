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
				$allsponsors= $db->prepare('SELECT * FROM partenaires WHERE choix=:choix');
				$allsponsorsExecute=$allsponsors->execute(array("choix"=>"s"));
				if(!$allsponsorsExecute){
					echo "<p> Erreur lors de la recherche des sponsors existants.</p>";
				}else{
					$tailleGauche = 0;
					$tailleDroite = 0;
					$gauche = array('0');
					$droite = array('0');
					$i=0;
					foreach($allsponsors as $chaqueS){
						$i++;
						list($width, $height, $type, $attr) = getimagesize($chaqueS['photoP']);
						$hauteur = $height*200/$width;
						if($tailleDroite > $tailleGauche){
							array_push($gauche, $chaqueS['idP']);
							$tailleGauche+=$hauteur;
						}else{
							array_push($droite, $chaqueS['idP']);
							$tailleDroite+=$hauteur;
						}
				}
			}

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
							if(in_array($chaqueS['idP'], $gauche)){?>
								<p> <img src="<?php echo $chaqueS['photoP'];?>" style="height: auto; max-width: 200px; width:100%;"/> </p><br/><?php
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
							if(in_array($chaqueS['idP'], $droite)){?>
								<p> <img src="<?php echo $chaqueS['photoP'];?>" style="height: auto; max-width: 200px;width:100%;"/> </p><br/><?php
							}
						}	?>
					</div><?php
				}
			?>

			<div class="conteneur-div filtre text-center">
				<h2 style="color:#6B63CA;">40<sup>e</sup> congrès de l'APLIUT</h2>

				<div class="present-images">
					<div class="present-text">
						<b><p style="color:#6B63CA;font-size:1.5em;">Toulouse</p>
						<p style="color:#6B63CA;font-size:1.5em;">IUT Paul Sabatier et LAIRDIL </p>
						<p style="color:#6B63CA;font-size:1.5em;">L'internationalisation des formations et l'enseignement/apprentissage des langues</p>
						<p style="color:#6B63CA;font-size:1.5em;">Du 31 mai au 2 juin 2018</p></b>
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
					<img style="width:100%;height:auto;max-width:450px;" src="https://www.tameteo.com/wimages/fotoab7ecac22f9c1ca2dce08fd4802d1fa5.png">

					<div class="row">
						<?php
							$req = $db->prepare("SELECT lien FROM accueil WHERE nom = 'videoPres'");
							$req->execute();
							$accueil = $req->fetch();
							$req2 = $db->prepare("SELECT lien FROM accueil WHERE nom = 'videoPres2'");
							$req2->execute();
							$accueil2 = $req2->fetch();

						 ?>
						<div id="vid1" class="col-sm-5 col-sm-offset-1" <?php
						if(strlen($accueil2['lien'])==0){
							echo 'style="float: none; margin: 0 auto;"';
						}
						?>>
							<?php


							if(strlen($accueil['lien'])!=0){
								echo "<div class='embed-responsive embed-responsive-16by9'>";
								echo "<iframe class='embed-responsive-item' src='https://www.youtube.com/embed/".$accueil['lien']."'allowfullscreen></iframe>";

								echo "</div><br>";
								echo "<a class='fenetre' href='https://www.youtube.com/embed/".$accueil['lien']."' >Lien vers la video</a>";
							}?>
						</div>
						<div id="vid2" class="col-sm-5" <?php
						if(strlen($accueil['lien'])==0){
							echo 'style="float: none; margin: 0 auto;"';
						}
						?>>
							<?php


							if(strlen($accueil2['lien'])!=0){
								echo "<div class='embed-responsive embed-responsive-16by9'>";
								echo "<iframe class='embed-responsive-item' src='https://www.youtube.com/embed/".$accueil2['lien']."'allowfullscreen></iframe>";

								echo "</div><br>";

								echo "<a class='fenetre' href='https://www.youtube.com/embed/".$accueil2['lien']."'>Lien vers la video</a>";
							}?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="topButton"><span class="glyphicon glyphicon-menu-up"></span></div>

	</div>




	<!-- PIED DE PAGE -->
	<footer>
		<?php include('php/footer.php'); ?>
	</footer>

	<!-- FICHIERS CÔTÉ CLIENT -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery-2-1-4-min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/colloque2018.js"></script>
	<script type="text/javascript" src="js/index.js"></script>

</body>
</html>
