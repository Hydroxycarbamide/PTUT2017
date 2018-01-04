<?php
session_start();
require("../php/connexion.php");
if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']) AND isset($_SESSION['nom']) AND isset($_SESSION['prenom']))
{
	?>
	<!DOCTYPE html>
	<html lang="fr">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
		<!-- FEUILLES DE STYLE -->
		<link rel="icon" type="text/css" href="../images/favicon.ico"></link>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"></link>
		<link rel="stylesheet" type="text/css" href="../css/style.css"></link>
		<link rel="stylesheet" type="text/css" href="../css/carrousel.css"></link>
		<link rel="stylesheet" type="text/css" href="../css/menu.css"></link>
		<link rel="stylesheet" type="text/css" href="../css/footer.css"></link>
		<link rel="stylesheet" type="text/css" href="../css/main.css"></link>
		<!-- STYLE DU RESPONSIVE DESIGN -->
		<link rel="stylesheet" type="text/css" href="../css/max1630px.css" media="screen and (min-width: 1445px) and (max-width: 1630px)"></link>
		<link rel="stylesheet" type="text/css" href="../css/max1445px.css" media="screen and (min-width: 1280px) and (max-width: 1445px)"></link>
		<link rel="stylesheet" type="text/css" href="../css/max1280px.css" media="screen and (min-width: 1032px) and (max-width: 1280px)"></link>
		<link rel="stylesheet" type="text/css" href="../css/max1032px.css" media="screen and (min-width: 768px) and (max-width: 1032px)"></link>
		<link rel="stylesheet" type="text/css" href="../css/mobile.css" media="screen and (max-width: 768px)"></link>
		<!-- ************************** -->
		<title>Session admin | Accueil</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script type="text/javascript" src="../js/jquery-2-1-4-min.js"></script>
	</head>
	<body>
		<!-- EN-TETE -->
		<header>
			<?php
			include('menu.php'); 						// Importation du menu
			include('../php/convertirDate.php');		// Importation de la fonction de convertion de date
			include('../php/reponse_formulaire.php');	// Importation de la fonction de modification des images
			?>
		</header>

		<!-- PAGE PRINCIPALE -->
		<div class="page-principale">

			<!-- GRAND TITRE -->
			<div class="conteneur conteneur-colloque conteneur-colloque-h1">
				<h1>Page d'accueil</h1>
			</div>


			<!-- Banner -->
			<?php
			if (isset($_POST["submit"])){
				if(move_uploaded_file ($_FILES["banner"]["tmp_name"],"../images/banner.png")){
					echo "<div class='alert alert-success'>Changements effectués</div>";
				} else {
					echo "<div class='alert alert-warning'>Erreur : fichier non changé</div>";
				}
			}
			?>
			<div class="container">
				<h2>Bannière</h2>
				<form action="accueil.php" method="post" enctype="multipart/form-data">
					<input type="file" name="banner" id="banner">	<br/>
					<button type="submit" class="btn btn-primary" name="submit">Changer la bannière</button>
				</form>



			</div>
			<!-- Carrousel à modifier -->
			<div id="conteneur-carrousel-modifier" class="conteneur conteneur-carrousel-modifier">
				<h2>Carrousel</h2>
				<div class="conteneur-div filtre">
					<div class="present-text">
						<p>Vous pouvez modifier les images et les textes qui apparaitront sur le carrousel (en haut de la page d'accueil).</p>
					</div>
					<?php
					$imagesCarrousel = $db->prepare('SELECT * FROM carrousel;');
					$imagesCarrousel->execute();
					$compteurImagesCarrousel = 0;
					while($chaqueImage = $imagesCarrousel->fetch()){
						?>
						<!-- Gestion de modification et de suppression -->
						<div class="before-figure">
							<figure id="p<?php echo $chaqueImage['idCar']; ?>" class="fig-img fig-img<?php echo $chaqueImage['idCar']; ?>">
								<img alt="img_car<?php echo $compteurImagesCarrousel; ?>" src="../<?php echo $chaqueImage['imageCar']; ?>">
								<figcaption><?php echo str_replace(array("\r\n","\n", '\n'),"<br />", $chaqueImage['sousTitreCar']); ?></figcaption>
							</figure>
							<!-- Bouton modifier -->
							<span id="lien<?php echo $chaqueImage['idCar']; ?>" class="glyphicon glyphicon-edit btn-edit" onclick="modifierInfo(this, '<?php echo $chaqueImage['idCar']; ?>');" ></span>
							<!-- *************** -->
							<!-- Bouton supprimer -->
							<span id="supprimer<?php echo $chaqueImage['idCar']; ?>" class="glyphicon glyphicon-remove btn-remove" onclick="modifierInfoSuppr(this, '<?php echo $chaqueImage['idCar']; ?>');" ></span>
							<!-- *************** -->


							<!-- Formulaire de modification -->
							<form method="post" enctype="multipart/form-data" class="partieCachee" id="form<?php echo $chaqueImage['idCar']; ?>" style="margin-bottom: 30px;">
								<input class="first_inp" type="hidden" name="idp<?php echo $chaqueImage['idCar']; ?>" value="<?php echo $chaqueImage['idCar']; ?>" />
								<label class="first_lab" for="img<?php echo $chaqueImage['idCar']; ?>">Image à modifier</label>
								<!--<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />-->
								<input style="display: block;" type="file" name="imgCar<?php echo $chaqueImage['idCar']; ?>" value="<?php echo $chaqueImage['imageCar']; ?>" />
								<label for="text<?php echo $chaqueImage['idCar']; ?>">Texte</label><br />
								<textarea rows="1" name="text<?php echo $chaqueImage['idCar']; ?>"><?php echo $chaqueImage['sousTitreCar']; ?></textarea><br />
								<input type="submit" name="modifierCar<?php echo $chaqueImage['idCar']; ?>" value="Modifier" class="input_validation" />
								<input type="submit" name="annuler" value="Annuler" class="input_annulation" />
								<?php
								if (isset($_POST['modifierCar' . $chaqueImage['idCar']])) {
									$idCar = $_POST['idp' . $chaqueImage['idCar']];
									$textCar = $_POST['text' . $chaqueImage['idCar']];
									$imgCar = 'imgCar' . $chaqueImage['idCar'];
									modifCar($idCar, $textCar, $imgCar);
								}
								if (isset($_POST['annuler'])) {
									?>
									<meta http-equiv="refresh" content="0;url=accueil.php">
									<?php
								}
								?>
							</form>


							<!-- Formulaire de suppression -->
							<form method="post" class="partieCachee" id="formSuppr<?php echo $chaqueImage['idCar']; ?>" style="margin-bottom: 30px;">
								<input class="first_inp" type="hidden" name="idp<?php echo $chaqueImage['idCar']; ?>" value="<?php echo $chaqueImage['idCar']; ?>" />
								<input class="" type="hidden" name="imgCar<?php echo $chaqueImage['idCar']; ?>" value="<?php echo $chaqueImage['imageCar']; ?>" />
								<p style="font-size: 1.5em; color: #FFFFFF;">Voulez-vous vraiment supprimer cette diapo du carrousel ?</p>
								<input type="submit" name="supprimerCar<?php echo $chaqueImage['idCar']; ?>" value="Oui" class="input_over" />
								<input type="submit" name="annuleSupression" value="Non" />

								<?php
								if (isset($_POST['supprimerCar' . $chaqueImage['idCar']])) {
									$idCar = $_POST['idp' . $chaqueImage['idCar']];
									$imgCar = $_POST['imgCar' . $chaqueImage['imageCar']];
									suppressionCar($idCar, $imgCar);
								}
								?>
							</form>
						</div>
						<!-- ************************** -->
						<?php
						$compteurImagesCarrousel++;
					}
					$imagesCarrousel->closeCursor();
					?>
					<!-- Gestion d'ajout -->
					<div class="before-figure">
						<!-- Bouton ajouter -->
						<span id="span-ajout-img-carrousel" class="glyphicon glyphicon-plus-sign btn-add" onclick="modifierInfoAdd(this, 'form-ajout');" ></span>
						<!-- *************** -->
						<!-- Formulaire d'ajout -->
						<form method="post" enctype="multipart/form-data" class="partieCachee form-ajout" id="form-ajout" style="margin-bottom: 30px;">
							<input class="first_inp" type="hidden" name="idp">

							<label class="first_lab" for="addImgCar">Image à ajouter</label>
							<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
							<input style="display: block;" type="file" name="addImgCar" />

							<label for="addSousTitreCar">Texte</label><br />
							<input class="form-control" name="addSousTitreCar" placeholder="Entrer un sous-titre..." required><br />

							<input type="submit" name="ajouterCar" value="Ajouter" />
							<input type="submit" name="annuleSupression" value="Non" />

							<?php
							if (isset($_POST['ajouterCar'])) {
								$textCar = $_POST['addSousTitreCar'];
								$imgCar = 'addImgCar';
								ajoutCar($textCar, $imgCar);
							}
							?>
						</form>
					</div>
				</div>
			</div>
			<div id="topButton"><span class="glyphicon glyphicon-menu-up"></span></div>
		</div>
		<script type="text/javascript" src="../js/menu.js"></script>
		<script type="text/javascript" src="../js/bootstrap.js"></script>
		<script type="text/javascript" src="../js/colloque2018.js"></script>
		<!-- PIED DE PAGE -->
		<footer>
			<?php include('footer_admin.php'); ?>
		</footer>
		<body/>
		<html/>
		<?php
	}
	else {
		echo '<div class="alert alert-info">Redirection vers la page de connexion</div>';
		header("Refresh:0;url=index.php");
	}
	?>
