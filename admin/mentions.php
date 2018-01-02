<?php
	session_start();
	require("../php/connexion.php");
	if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']) AND isset($_SESSION['nom']) AND isset($_SESSION['prenom']))
	{
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
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
	<title>Session admin | Mentions légales</title>
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
			<h1>Mentions légales</h1>
		</div>

		<!-- MENTIONS LÉGALES -->
		<?php
			$mentionsLegales = $db->prepare('SELECT * FROM mentionslegales');
			$mentionsLegales->execute();
			while($chaqueMentionLegale = $mentionsLegales->fetch()){
		?>
			<div class="conteneur conteneur-mentions conteneur-mentions-presentation" id="mentions<?php echo $chaqueMentionLegale['idM']; ?>">
				<h2><?php echo $chaqueMentionLegale['nomM']; ?></h2>
				<p id="p<?php echo $chaqueMentionLegale['idM']; ?>"><?php echo str_replace(array("\r\n","\n", '\n'),"<br />",$chaqueMentionLegale['descriptionM']); ?></p>
				<!-- Bouton modifier -->
				<span id="lien<?php echo $chaqueMentionLegale['idM']; ?>" class="glyphicon glyphicon-edit btn-edit" onclick="modifierInfo(this, '<?php echo $chaqueMentionLegale['idM']; ?>');" ></span>
				<!-- *************** -->
				<!-- Bouton supprimer -->
				<span id="supprimer<?php echo $chaqueMentionLegale['idM']; ?>" class="glyphicon glyphicon-remove btn-remove" onclick="modifierInfoSuppr(this, '<?php echo $chaqueMentionLegale['idM']; ?>');" ></span>
				<!-- *************** -->
				<form method="post" class="partieCachee" id="form<?php echo $chaqueMentionLegale['idM']; ?>" style="margin-bottom: 30px;">

					<input type="hidden" name="idp<?php echo $chaqueMentionLegale['idM']; ?>" value="<?php echo $chaqueMentionLegale['idM']; ?>">

					<label for="titre<?php echo $chaqueMentionLegale['idM']; ?>">Titre</label>
					<input style="display: block; width: 300px; padding: 5px; margin-bottom: 20px;" type="text" name="titre<?php echo $chaqueMentionLegale['idM']; ?>" value="<?php echo $chaqueMentionLegale['nomM']; ?>" />

					<label for="text<?php echo $chaqueMentionLegale['idM']; ?>">Texte</label>
					<textarea rows="7" style="width: 100%; padding: 5px; margin-bottom: 20px;" name="text<?php echo $chaqueMentionLegale['idM']; ?>"><?php echo $chaqueMentionLegale['descriptionM']; ?></textarea>

					<input type="submit" name="modifier<?php echo $chaqueMentionLegale['idM']; ?>" value="Modifier" class="input_validation" />
					<input type="submit" name="annuler" value="Annuler" class="input_annulation" />
					<?php
						$id = $chaqueMentionLegale['idM'];
						$titreId = 'titre' . $chaqueMentionLegale['idM'];	// Titre à modifier
						$textId	= 'text' . $chaqueMentionLegale['idM'];		// Texte à modifier
						$btn_modif = 'modifier' . $chaqueMentionLegale['idM'];
						if (isset($_POST[$btn_modif])) {
							modifMentions($id, $titreId, $textId);
						}
						if (isset($_POST['annuler'])) {
					?>
							<meta http-equiv="refresh" content="0;url=mentions.php">
					<?php
						}
					?>
				</form>

				<!-- Formulaire de suppression -->
				<form method="post" class="partieCachee" id="formSuppr<?php echo $chaqueMentionLegale['idM']; ?>" style="margin-bottom: 30px;">
					<input class="first_inp" type="hidden" name="idp<?php echo $chaqueMentionLegale['idM']; ?>" value="<?php echo $chaqueMentionLegale['idM']; ?>" />
					<p style="font-size: 1.5em;">Voulez-vous vraiment supprimer ce paragraphe ?</p>
					<input type="submit" name="supprimerMention<?php echo $chaqueMentionLegale['idM']; ?>" value="Oui" class="input_over" />
					<input type="submit" name="annuleSupression" value="Non" />

					<?php
						if (isset($_POST['supprimerMention' . $chaqueMentionLegale['idM']])) {
							$idM = $_POST['idp' . $chaqueMentionLegale['idM']];
							suppressionMentions($idM);
						}
					?>
				</form>
			</div>

			<span class="separerHorizontal"></span>
		<?php
			}
			$mentionsLegales->closeCursor();
		?>
		<!-- Gestion d'ajout -->
			<div class="conteneur conteneur-mentions conteneur-mentions-presentation" id="mentions<?php echo $chaqueMentionLegale['idM']; ?>">

				<!-- Bouton ajouter -->
				<span class="glyphicon glyphicon-plus-sign btn-add" onclick="modifierInfoAdd(this, 'form-ajout');" ></span>
				<!-- *************** -->

				<!-- Formulaire d'ajout -->
				<form method="post" class="partieCachee form-ajout" id="form-ajout">
					<input class="first_inp" type="hidden" name="idp">


					<label for="addNomM">Titre</label><br />
					<input type="text" name="addNomM" placeholder="Entrer un titre..." /><br />

					<label for="addDescriptionM">Texte</label><br />
					<textarea rows="3" style="width: 100%;" name="addDescriptionM" placeholder="Entrer un texte..."></textarea><br />

					<input type="submit" name="ajouterMentionsLegales" value="Ajouter" class="input_validation" />
					<input type="submit" name="annuleSupression" value="Non" />

					<?php
						if (isset($_POST['ajouterMentionsLegales'])) {
							$nomM = $_POST['addNomM'];
							$descriptionM = $_POST['addDescriptionM'];
							ajoutMentions($nomM, $descriptionM);
						}
					?>
				</form>
			</div>

		<div id="topButton"><span class="glyphicon glyphicon-menu-up"></span></div>

	</div>

	<script type="text/javascript" src="../js/menu.js"></script>
	<script type="text/javascript" src="../js/bootstrap.js"></script>
	<script type="text/javascript" src="../js/colloque2018.js"></script>

	<!-- PIED DE PAGE -->
	<footer>
		<?php include('./footer_admin.php'); ?>
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
