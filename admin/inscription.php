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
		<title>Session admin | Inscription</title>
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
		<div class="page-principale page-inscription">

			<!-- GRAND TITRE -->
			<div class="conteneur conteneur-colloque conteneur-colloque-h1">
				<h1>Inscription</h1>
			</div>

			<?php
			$v_inscription = $db->prepare('SELECT * FROM inscription ORDER BY idI;');
			$v_inscription->execute();
			while ($allInscriptions=$v_inscription->fetch()) {
				?>
				<!-- PRÉSENTATION -->
				<div class="conteneur conteneur-colloque conteneur-colloque-presentation">



					<h2>
						<?php echo str_replace(array("\r\n","\n", '\n'),"<br />",$allInscriptions['titreI']); ?>
					</h2>
					<p>
						<?php echo str_replace(array("\r\n","\n", '\n'),"<br />",$allInscriptions['texteI']); ?>
					</p>

					<a class="lien-interne" href="<?php echo $allInscriptions['lienI']; ?>" target="_blank">Plus d'informations<span class="icon-circle-right"></span></a>
					<br/><br/><br/>
					<form method = "post" action="inscription.php">
						<input type="submit" name="modifierInscription" value="Modifier"/>
					</form>
					<?php
					if(isset($_POST['modifierInscription'])){
						?>
						<form method = "post" action = "inscription.php">
							<div class="form-group">
								<label>Changez titre : </label>
								<input class="form-control" type="text" name="titreInscription" value = "<?php echo $allInscriptions['titreI']; ?>"/><br/>
							</div>
							<div class="form-group">
								<label>Changez la description : </label>
								<textarea class="form-control" name="texteInscription" ><?php echo $allInscriptions['texteI']; ?></textarea><br/>
							</div>
							<div class="form-group">
								<label>Changez le lien d'inscription : </label>
								<input class="form-control" type="text" name="lienInscription" value = "<?php echo $allInscriptions['lienI']; ?>"/><br/>
							</div>
							<input type="reset" class="btn btn-secondary" name="effacerModifInscription" value="Effacer les modifications"/>
							<input type="submit" class="btn btn-primary" name="viliderModifInscription" value="Valider"/>

						</form>
						<?php
					}
					if(!empty($_POST['titreInscription'])){
				# Modification du titre
						$modificationTitreInscription=$db->prepare('UPDATE inscription SET titreI=:newTitre WHERE idI=:idInscription;');
						$modifierTitreI=$modificationTitreInscription->execute(array(	"newTitre"=>$_POST['titreInscription'],
							"idInscription"=>$allInscriptions['idI']));
						echo "Le titre a été bien changé ! Veuillez rafraichir cette page !" ;
					}
					if(!empty($_POST['texteInscription'])){
				# Modification du texte
						$modificationTexteInscription=$db->prepare('UPDATE inscription SET texteI=:newTexte WHERE idI=:idInscription;');
						$modifierTexteI=$modificationTexteInscription->execute(array("newTexte"=>$_POST['texteInscription'],
							"idInscription"=>$allInscriptions['idI']));
						echo "La description a été bien changé ! Veuillez rafraichir cette page ! " ;

					}
					if(!empty($_POST['lienInscription'])){
				# Modification du lien
						$modificationLienInscription=$db->prepare('UPDATE inscription SET lienI=:newLien WHERE idI=:idInscription;');
						$modifierLienI=$modificationLienInscription->execute(array(	"newLien"=>$_POST['lienInscription'],
							"idInscription"=>$allInscriptions['idI']));
						echo "Le lien d'inscription a été bien changé ! Veuillez rafraichir cette page !" ;
					}
					?>

				</div>

				<div id="topButton"><span class="glyphicon glyphicon-menu-up"></span></div>
				<?php
			}
			$v_inscription->closeCursor();
			?>

		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script type="text/javascript" src="../js/jquery-2-1-4-min.js"></script>
		<script type="text/javascript" src="../js/bootstrap.js"></script>
		<script type="text/javascript" src="../js/colloque2018.js">
		</script>

		<!-- PIED DE PAGE -->
		<footer>
			<?php include('../php/footer.php'); ?>
		</footer>

	</body>
	</html>
	<?php
}
else {
	echo "Redirection vers la page de connexion";
	header("Refresh:0;url=index.php");
}
?>
