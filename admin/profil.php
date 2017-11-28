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
		<link rel="icon" type="text/css" href="../../img/favicon.ico"></link>
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
		<title>Session admin | Votre profil</title>
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

			<!-- Carrousel à modifier -->
			<div id="conteneur-carrousel-modifier" class="conteneur conteneur-carrousel-modifier conteneur-profil">
				<h2>Profil personnel</h2>
				<div class="conteneur-div filtre">
					<p>Vous pouvez modifier vos informations.</p>
					<?php
					$profilCourant = $db->prepare('SELECT * FROM connexion WHERE id = :id AND pseudo = :pseudo AND nom = :nom AND prenom = :prenom');
					$profilCourant->execute(array(
						"id" => $_SESSION['id'],
						"pseudo" => $_SESSION['pseudo'],
						"nom" => $_SESSION['nom'],
						"prenom" => $_SESSION['prenom']
						));
					$parcoursProfil = $profilCourant->fetch();
					?>
					<div class="profil" id="infosProfil<?php echo $parcoursProfil['id']; ?>">
						<p>
							<b>Nom</b> <?php echo $parcoursProfil['nom']; ?><br />
							<b>Prénom</b> <?php echo $parcoursProfil['prenom']; ?><br />
							<b>Pseudo</b> <?php echo $parcoursProfil['pseudo']; ?><br />
							<b>Adresse mail</b><br /><?php echo $parcoursProfil['mail']; ?>
						</p>
					</div>
					<!-- Bouton modifier -->
					<span id="btnModifProfil<?php echo $parcoursProfil['id']; ?>" class="glyphicon glyphicon-edit btn-edit" onclick="modifierInfoPratiques(this, '<?php echo $parcoursProfil['id']; ?>', 'Profil');" ></span>
					<!-- *************** -->
					<form method="post" class="partieCachee formModifProfil" id="formModifProfil<?php echo $parcoursProfil['id']; ?>" style="margin-bottom: 30px;">

						<input type="hidden" name="idp<?php echo $parcoursProfil['id']; ?>" value="<?php echo $parcoursProfil['id']; ?>" />
						<!-- Nom -->
						<label for="nom">Nom</label>
						<input style="display: block; width: 300px; padding: 5px; margin-bottom: 20px;" type="text" name="nom" value="<?php echo $parcoursProfil['nom']; ?>" />
						<!-- Prénom -->
						<label for="prenom">Prénom</label>
						<input style="display: block; width: 300px; padding: 5px; margin-bottom: 20px;" type="text" name="prenom" value="<?php echo $parcoursProfil['prenom']; ?>" />
						<!-- Pseudo -->
						<label for="pseudo">Pseudo</label>
						<input style="display: block; width: 300px; padding: 5px; margin-bottom: 20px;" type="text" name="pseudo" value="<?php echo $parcoursProfil['pseudo']; ?>" />
						<!-- Adresse mail -->
						<label for="mail">Adresse mail</label>
						<input style="display: block; width: 300px; padding: 5px; margin-bottom: 20px;" type="text" name="mail" value="<?php echo $parcoursProfil['mail']; ?>" />
						<!-- Mot de passe -->
						<label for="mdp">Mot de passe</label>
						<input style="display: block; width: 300px; padding: 5px; margin-bottom: 20px;" type="password" name="mdp" value="<?php echo $parcoursProfil['mdp']; ?>" />
						<label for="mdpConfirm">Confirmer mot de passe</label>
						<input style="display: block; width: 300px; padding: 5px; margin-bottom: 20px;" type="password" name="mdpConfirm" value="<?php echo $parcoursProfil['mdp']; ?>" />
						<!-- Boutons de validation -->
						<input type="submit" name="modifier<?php echo $parcoursProfil['id']; ?>" value="Modifier" class="input_validation" />
						<input type="submit" name="annuler" value="Annuler" class="input_annulation" />
					</form>
					<?php
							$btn_modif = 'modifier' . $parcoursProfil['id'];	// Bouton 'Modifier'
							if (isset($_POST[$btn_modif])) {
								$id = $parcoursProfil['id'];
								$nom = $_POST['nom'];								// Nom à modifier
								$prenom	= $_POST['prenom'];							// Prénom à modifier
								$pseudo	= $_POST['pseudo'];							// Pseudo à modifier
								$mail	= $_POST['mail'];							// Adresse mail à modifier
								$mdp	= $_POST['mdp'];							// Mot de passe à modifier
								$mdpConfirm	= $_POST['mdpConfirm'];					// Mot de passe de confirmation à modifier
								if (!empty($mdp) || !empty($mdpConfirm)) {
									if ($mdp != $mdpConfirm) {
										echo '<div class="alert alert-danger">Veuillez entrer un mot de passe similaire dans les deux champs de saisie.</div>';
									} else {
										modifProfil($id, $nom, $prenom, $pseudo, $mail, $mdp);
									}
								}
							}
							if (isset($_POST['annuler'])) {
								?>
								<meta http-equiv="refresh" content="0;url=profil.php" />
								<?php
							}
							?>
							<?php
							$profilCourant->closeCursor();
							?>
						</div>
					</div>	

					<div id="topButton"><span class="glyphicon glyphicon-menu-up"></span></div>

				</div>

				<script type="text/javascript" src="../js/menu.js"></script>
				<script type="text/javascript" src="../js/bootstrap.js"></script>
				<script type="text/javascript" src="../js/colloque2018.js"></script>

				<!-- PIED DE PAGE -->
				<footer>
					<?php include('../php/footer.php'); ?>
				</footer>
				
				<body/>
				<html/>
				<?php
			}
			else {
				echo "Redirection vers la page de connexion";
				header("Refresh:0;url=index.php");
			}
			?>