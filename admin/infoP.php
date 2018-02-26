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
	<link rel="icon" type="text/css" href="../images/favicon.ico">
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
	<title>Session admin | Informations pratiques</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery-2-1-4-min.js"></script>
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
	<div class="page-principale page-principale-informationspratiques">
		<div id="push" style="padding-top:60px;"></div>
		<!-- GRAND TITRE -->
		<div class="conteneur conteneur-informationspratiques conteneur-informationspratiques-h1">
			<h1>Informations pratiques</h1>
		</div>

		<!-- SOUS-MENU DE NAVIGATION -->
		<div class="sousMenu">
			<ul class="sousMenu-ul">
				<!--Liens du sous-menu de navigation -->
				<li><a class="smenu s0menu accesiut" href="#accesiut">Accès à l'IUT</a></li>
				<li><a class="smenu s1menu hotels" href="#hotels">Hébergement</a></li>
				<li><a class="smenu s2menu restauration" href="#cocktails">Cocktails</a></li>
				<li><a class="smenu s3menu transports" href="#restauration">Diner</a></li>
				<li><a class="smenu s4menu marche" href="#marche">Marché des Produits Régionaux</a></li>
				<li><a class="smenu s5menu tourisme" href="#tourisme">Tourisme</a></li>
				<li><a class="smenu s6menu acceswifi" href="#acceswifi">Accès au WiFi</a></li>
				<li><a class="smenu s7menu chartes" href="#chartes">Charte de l'IUT et de l'UPS</a></li>
			</ul>
		</div>

	  <!-- Accès IUT -->
		<div class="conteneur conteneur-informationspratiques conteneur-informationspratiques-div conteneur-informationspratiques-accesiut" id="accesiut">
				<h2>Accès à l'IUT</h2>
		<?php
			$accesAIUT = $db->prepare('SELECT * FROM accesIUT ORDER BY idAcces;');
			$accesAIUT->execute();
			while ($chaqueAccesIUT = $accesAIUT->fetch()) {
		?>
			<div class="conteneur-div filtre" style="text-align: left;">
				<div class="present-text">
					<h3><?php echo str_replace(array("\r\n","\n", '\n'),"<br />", $chaqueAccesIUT['sousTitreAcces']); ?></h3>
					<p id="p<?php echo $chaqueAccesIUT['idAcces']; ?>"><?php echo str_replace(array("\r\n","\n", '\n'),"<br />", $chaqueAccesIUT['texteAcces']); ?></p>
				</div>

				<!-- Bouton modifier -->
				<span id="lien<?php echo $chaqueAccesIUT['idAcces']; ?>" class="glyphicon glyphicon-edit btn-edit" onclick="modifierInfo(this, '<?php echo $chaqueAccesIUT['idAcces']; ?>');" style="margin: -20px 0px 40px 20px;"></span>
				<!-- *************** -->
				<!-- Bouton supprimer -->
				<span id="supprimer<?php echo $chaqueAccesIUT['idAcces']; ?>" class="glyphicon glyphicon-remove btn-remove" onclick="modifierInfoSuppr(this, '<?php echo $chaqueAccesIUT['idAcces']; ?>');" style="margin: -20px 0px 0px 0px;"></span>
				<!-- *************** -->

				<!-- Formulaire de modification -->
				<form method="post" class="partieCachee" id="form<?php echo $chaqueAccesIUT['idAcces']; ?>" style="margin-bottom: 30px;">

					<input type="hidden" name="idp<?php echo $chaqueAccesIUT['idAcces']; ?>" value="<?php echo $chaqueAccesIUT['idAcces']; ?>">

					<label for="titre<?php echo $chaqueAccesIUT['idAcces']; ?>">Sous-titre</label>
					<input style="display: block; width: 300px; padding: 5px; margin-bottom: 20px;" type="text" name="titre<?php echo $chaqueAccesIUT['idAcces']; ?>" value="<?php echo $chaqueAccesIUT['sousTitreAcces']; ?>" />

					<label for="text<?php echo $chaqueAccesIUT['idAcces']; ?>">Texte</label>
					<textarea rows="7" style="width: 100%; padding: 5px; margin-bottom: 20px;" name="text<?php echo $chaqueAccesIUT['idAcces']; ?>"><?php echo $chaqueAccesIUT['texteAcces']; ?></textarea>

					<label for="addLien<?php echo $chaqueAccesIUT['idAcces']; ?>">Lien</label><br />
					<input class="form-control" style="width: 100%;" name="addlienA<?php echo $chaqueAccesIUT['idAcces']; ?>" placeholder="http://.." value = "<?php echo $chaqueAccesIUT['lien']; ?>"><br />

					<input type="submit" name="modifier<?php echo $chaqueAccesIUT['idAcces']; ?>" value="Modifier" class="input_validation" />
					<input type="submit" name="annulera" value="Annuler" class="input_annulation" />


					<?php
						$idAcces = $chaqueAccesIUT['idAcces'];
						$soustitreAcces = 'titre' . $chaqueAccesIUT['idAcces'];	// Titre à modifier
						$texteAcces	= 'text' . $chaqueAccesIUT['idAcces'];		// Texte à modifier
						$btn_modif = 'modifier' . $chaqueAccesIUT['idAcces'];
						$lienA = 'addlienA' . $chaqueAccesIUT['idAcces'];
						if (isset($_POST[$btn_modif])) {
							modifAccesIUT($idAcces, $soustitreAcces, $texteAcces, $lienA);
						}
						if (isset($_POST['annulera'])) {
					?>
							<meta http-equiv="refresh" content="0;url=infoP.php#accesiut">
					<?php
						}
					?>
				</form>

				<!-- Formulaire de suppression -->
				<form method="post" class="partieCachee" id="formSuppr<?php echo $chaqueAccesIUT['idAcces']; ?>" style="margin-bottom: 30px;">
					<input class="first_inp" type="hidden" name="idp<?php echo $chaqueAccesIUT['idAcces']; ?>" value="<?php echo $chaqueAccesIUT['idAcces']; ?>" />
					<p style="font-size: 1.5em; color: #FFFFFF;">Voulez-vous vraiment supprimer cette diapo du carrousel ?</p>
					<input type="submit" name="supprimerAcces<?php echo $chaqueAccesIUT['idAcces']; ?>" value="Oui" class="input_over" />
					<input type="submit" name="annuleSupression" value="Non" />

					<?php
						if (isset($_POST['supprimerAcces' . $chaqueAccesIUT['idAcces']])) {
							$idAcces = $_POST['idp' . $chaqueAccesIUT['idAcces']];
							suppressionAccesIUT($idAcces);
						}
					?>
				</form>
			</div>
		<?php
			}
			$accesAIUT->closeCursor();
		?>
		</div>
			<!-- Gestion d'ajout -->
			<div class="conteneur conteneur-informationspratiques conteneur-informationspratiques-accesiut">
				<div class="conteneur-div filtre">

					<!-- Bouton ajouter -->
					<span style="margin: -20px 0px 40px 20px;" class="glyphicon glyphicon-plus-sign btn-add" onclick="modifierInfoAdd(this, 'form-ajout');" ></span>
					<!-- *************** -->

					<!-- Formulaire d'ajout -->
					<form method="post" class="partieCachee form-ajout" id="form-ajout">
						<input class="first_inp" type="hidden" name="idp">


						<label for="addSousTitreAcces">Sous-titre</label><br />
						<input class="form-control" type="text" name="addSousTitreAcces" placeholder="Entrer un sous-titre..." /><br />

						<label for="addDescriptionM">Texte</label><br />
						<textarea rows="3" style="width: 100%;" name="addDescriptionM" placeholder="Entrer un texte..."></textarea><br />

						<label for="addLien">Lien</label><br />
						<input class="form-control" style="width: 100%;" name="addlienA" placeholder="http://.."><br />

						<input type="submit" name="ajouterAccesIUT" value="Ajouter" class="input_validation" />
						<input type="submit" name="annuleSupression" value="Non" />

						<?php
							if (isset($_POST['ajouterAccesIUT'])) {
								$SousTitreAcces = $_POST['addSousTitreAcces'];
								$descriptionM = $_POST['addDescriptionM'];
								$lienA = $_POST['addlienA'];
								ajoutAccesIUT($SousTitreAcces, $descriptionM, $lienA);
							}
						?>
					</form>
				</div>
			</div>
		</div>

		<span class="separerHorizontal"></span>

	  <!-- Hotels -->
		<div class="conteneur conteneur-carrousel-modifier conteneur-informationspratiques conteneur-informationspratiques-div conteneur-informationspratiques-hotels" id="hotels">
			<h2>Hébergement</h2>
			<div class="conteneur-div filtre">
			<?php
				$hotels = $db->prepare('SELECT * FROM hotels ORDER BY nomH;');
				$hotels->execute();
			    $compteurHotels = 0;
				while ($chaqueHotel = $hotels->fetch()) {
			?>
				<!-- Gestion de modification et de suppression -->
				<div class="before-figure vertical-align-top">
					<figure id="infosHotel<?php echo $chaqueHotel['idH']; ?>" class="fig-img fig-img<?php echo $chaqueHotel['idH']; ?>">
						<img alt="photo_hotel_<?php echo $compteurHotels; ?>" src="../<?php echo $chaqueHotel['photoH']; ?>">
						<figcaption class="text-align-left">
							<p><em>Nom</em> : <?php echo $chaqueHotel['nomH']; ?></p>
							<p><em>Nombre d'étoiles</em> : <?php echo $chaqueHotel['noteH']; ?></p>
							<p><em>Adresse</em> : <?php echo $chaqueHotel['adresseH']; ?></p>
							<p><em>Tél.</em> : <?php echo $chaqueHotel['telH']; ?></p>
							<p><em>Fax.</em> : <?php echo $chaqueHotel['faxH']; ?></p>
							<p><em>Description</em> :<br /><?php echo str_replace(array("\r\n","\n", '\n'),"<br />", $chaqueHotel['descriptionH']); ?></p>
							<p><em>Tarifs</em> : <?php echo $chaqueHotel['tarifH']; ?></p>
							<p><em>Lien</em> : <?php echo $chaqueHotel['lienH']; ?></p>
						</figcaption>
					</figure>

					<!-- Bouton modifier -->
					<span id="btnModifHotel<?php echo $chaqueHotel['idH']; ?>" class="glyphicon glyphicon-edit btn-edit" onclick="modifierInfoPratiques(this, '<?php echo $chaqueHotel['idH']; ?>', 'Hotel');" ></span>
					<!-- *************** -->
					<!-- Bouton supprimer -->
					<span id="supprimerHotel<?php echo $chaqueHotel['idH']; ?>" class="glyphicon glyphicon-remove btn-remove" onclick="modifierInfoSupprInfoPratiques(this, '<?php echo $chaqueHotel['idH']; ?>', 'Hotel');" ></span>
					<!-- *************** -->

					<!-- Formulaire de modification -->
					<form method="post" enctype="multipart/form-data" class="partieCachee" id="formModifHotel<?php echo $chaqueHotel['idH']; ?>" style="margin-bottom: 30px; text-align: left;">
						<input class="first_inp" type="hidden" name="idHotel<?php echo $chaqueHotel['idH']; ?>" value="<?php echo $chaqueHotel['idH']; ?>" />
						<!-- Image hôtel -->
						<label class="first_lab" for="photoHotel<?php echo $chaqueHotel['idH']; ?>">Photo à modifier</label>
						<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
						<input style="display: block;" type="file" name="photoHotel<?php echo $chaqueHotel['idH']; ?>" value="<?php echo $chaqueHotel['photoH']; ?>" />
						<!-- Nom hôtel -->
						<label for="nomHotel<?php echo $chaqueHotel['idH']; ?>">Nom</label><br />
						<input type="text" name="nomHotel<?php echo $chaqueHotel['idH']; ?>" value="<?php echo $chaqueHotel['nomH']; ?>" /><br />
						<!-- Nombre d'étoiles hôtel -->
						<label for="noteHotel<?php echo $chaqueHotel['idH']; ?>">Nombre d'étoiles</label><br />
						<input type="text" name="noteHotel<?php echo $chaqueHotel['idH']; ?>" value="<?php echo $chaqueHotel['noteH']; ?>" style="width: 50px;" /><br />
						<!-- Adresse hôtel -->
						<label for="adresseHotel<?php echo $chaqueHotel['idH']; ?>">Adresse</label><br />
						<input type="text" name="adresseHotel<?php echo $chaqueHotel['idH']; ?>" value="<?php echo $chaqueHotel['adresseH']; ?>" style="width: 100%;" /><br />
						<!-- Téléphone hôtel -->
						<label for="telephoneHotel<?php echo $chaqueHotel['idH']; ?>">Téléphone</label><br />
						<input type="text" name="telephoneHotel<?php echo $chaqueHotel['idH']; ?>" value="<?php echo $chaqueHotel['telH']; ?>" style="width: 40%;" /><br />
						<!-- Fax hôtel -->
						<label for="faxHotel<?php echo $chaqueHotel['idH']; ?>">Fax</label><br />
						<input type="text" name="faxHotel<?php echo $chaqueHotel['idH']; ?>" value="<?php echo $chaqueHotel['faxH']; ?>" style="width: 40%;" /><br />
						<!-- Description hôtel -->
						<label for="descriptionHotel<?php echo $chaqueHotel['idH']; ?>">Description</label><br />
						<textarea rows="6" name="descriptionHotel<?php echo $chaqueHotel['idH']; ?>"><?php echo $chaqueHotel['descriptionH']; ?></textarea><br />
						<!-- Tarifs hôtel -->
						<label for="tarifsHotel<?php echo $chaqueHotel['idH']; ?>">Tarifs</label><br />
						<input type="text" name="tarifsHotel<?php echo $chaqueHotel['idH']; ?>" value="<?php echo $chaqueHotel['tarifH']; ?>" /><br />
						<!-- Lien "Plus d'infos" hôtel -->
						<label for="lienHotel<?php echo $chaqueHotel['idH']; ?>">Lien "Plus d'infos"</label><br />
						<input type="text" name="lienHotel<?php echo $chaqueHotel['idH']; ?>" value="<?php echo $chaqueHotel['lienH']; ?>" style="width: 100%;" /><br /><br />

						<!-- Boutons de validation -->
						<input type="submit" name="modifierHotel<?php echo $chaqueHotel['idH']; ?>" value="Modifier" class="input_validation" />
						<input type="submit" name="annulerh" value="Annuler" class="input_annulation" />

						<?php
							if (isset($_POST['modifierHotel' . $chaqueHotel['idH']])) {
								$idH = $_POST['idHotel' . $chaqueHotel['idH']];
								$nomHotel = $_POST['nomHotel' . $chaqueHotel['idH']];
								$photoHotel = 'photoHotel' . $chaqueHotel['idH'];
								$noteHotel = $_POST['noteHotel' . $chaqueHotel['idH']];
								$adresseHotel = $_POST['adresseHotel' . $chaqueHotel['idH']];
								$telephoneHotel = $_POST['telephoneHotel' . $chaqueHotel['idH']];
								$faxHotel = $_POST['faxHotel' . $chaqueHotel['idH']];
								$descriptionHotel = $_POST['descriptionHotel' . $chaqueHotel['idH']];
								$tarifsHotel = $_POST['tarifsHotel' . $chaqueHotel['idH']];
								$lienHotel = $_POST['lienHotel' . $chaqueHotel['idH']];
								modifHotel($idH, $nomHotel, $photoHotel, $noteHotel, $adresseHotel, $telephoneHotel, $faxHotel, $descriptionHotel, $tarifsHotel, $lienHotel);
							}
							if (isset($_POST['annulerh'])) {
						?>
								<meta http-equiv="refresh" content="0;url=infoP.php#hotels" />
						<?php
							}
						?>
					</form>

					<!-- Formulaire de suppression -->
					<form method="post" class="partieCachee" id="formSupprHotel<?php echo $chaqueHotel['idH']; ?>" style="margin-bottom: 30px;">
						<input class="first_inp" type="hidden" name="idH<?php echo $chaqueHotel['idH']; ?>" value="<?php echo $chaqueHotel['idH']; ?>" />
						<input class="" type="hidden" name="photoH<?php echo $chaqueHotel['idH']; ?>" value="<?php echo $chaqueHotel['photoH']; ?>" />
						<p style="font-size: 1.5em; color: #FFFFFF;">Voulez-vous vraiment supprimer cette diapo du carrousel ?</p>
						<input type="submit" name="supprimerHotel<?php echo $chaqueHotel['idH']; ?>" value="Oui" class="input_over" />
						<input type="submit" name="annuleSupression" value="Non" />

						<?php
							if (isset($_POST['supprimerHotel' . $chaqueHotel['idH']])) {
								$idH = $_POST['idH' . $chaqueHotel['idH']];
								$photoH = $_POST['photoH' . $chaqueHotel['photoH']];
								suppressionHotel($idH, $photoH);
							}
						?>
					</form>
				</div>
		<!-- ************************** -->
			<?php
					$compteurHotels++;
				}
				$hotels->closeCursor();
			?>
				<!-- Gestion d'ajout -->
				<div class="before-figure">

					<!-- Bouton ajouter -->
					<span id="span-ajout-img-carrousel" class="glyphicon glyphicon-plus-sign btn-add" onclick="modifierInfoAdd(this, 'form-ajoutHotel');" ></span>
					<!-- *************** -->

					<!-- Formulaire d'ajout -->
					<form method="post" enctype="multipart/form-data" class="partieCachee form-ajout" id="form-ajoutHotel" style="margin-bottom: 30px; text-align: left;">
						<input class="first_inp" type="hidden" name="idp">

						<label class="first_lab" for="addPhotoHotel">Image à ajouter</label>
						<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
						<input style="display: block;" type="file" name="addPhotoHotel" />
						<!-- Nom hôtel -->
						<label for="addNomHotel<?php echo $chaqueHotel['idH']; ?>">Nom</label><br />
						<input type="text" name="addNomHotel<?php echo $chaqueHotel['idH']; ?>" value="<?php echo $chaqueHotel['nomH']; ?>" /><br />
						<!-- Nombre d'étoiles hôtel -->
						<label for="addNoteHotel<?php echo $chaqueHotel['idH']; ?>">Nombre d'étoiles</label><br />
						<input type="text" name="addNoteHotel<?php echo $chaqueHotel['idH']; ?>" value="<?php echo $chaqueHotel['noteH']; ?>" style="width: 50px;" /><br />
						<!-- Adresse hôtel -->
						<label for="addAdresseHotel<?php echo $chaqueHotel['idH']; ?>">Adresse</label><br />
						<input type="text" name="addAdresseHotel<?php echo $chaqueHotel['idH']; ?>" value="<?php echo $chaqueHotel['adresseH']; ?>" style="width: 100%;" /><br />
						<!-- Téléphone hôtel -->
						<label for="addTelephoneHotel<?php echo $chaqueHotel['idH']; ?>">Téléphone</label><br />
						<input type="text" name="addTelephoneHotel<?php echo $chaqueHotel['idH']; ?>" value="<?php echo $chaqueHotel['telH']; ?>" style="width: 40%;" /><br />
						<!-- Fax hôtel -->
						<label for="addFaxHotel<?php echo $chaqueHotel['idH']; ?>">Fax</label><br />
						<input type="text" name="addFaxHotel<?php echo $chaqueHotel['idH']; ?>" value="<?php echo $chaqueHotel['faxH']; ?>" style="width: 40%;" /><br />
						<!-- Description hôtel -->
						<label for="addDescriptionHotel<?php echo $chaqueHotel['idH']; ?>">Description</label><br />
						<textarea rows="6" name="addDescriptionHotel<?php echo $chaqueHotel['idH']; ?>"><?php echo $chaqueHotel['descriptionH']; ?></textarea><br />
						<!-- Tarifs hôtel -->
						<label for="addTarifsHotel<?php echo $chaqueHotel['idH']; ?>">Tarifs</label><br />
						<input type="text" name="addTarifsHotel<?php echo $chaqueHotel['idH']; ?>" value="<?php echo $chaqueHotel['tarifH']; ?>" /><br />
						<!-- Lien "Plus d'infos" hôtel -->
						<label for="addLienHotel<?php echo $chaqueHotel['idH']; ?>">Lien "Plus d'infos"</label><br />
						<input type="text" name="addLienHotel<?php echo $chaqueHotel['idH']; ?>" value="<?php echo $chaqueHotel['lienH']; ?>" style="width: 100%;" /><br /><br />

						<input type="submit" name="ajouterHotel" value="Ajouter" />
						<input type="submit" name="annuleSupression" value="Non" />

						<?php
							if (isset($_POST['ajouterHotel'])) {
								$nomHotel = $_POST['addNomHotel'];
								$photoHotel = 'addPhotoHotel';
								$noteHotel = $_POST['addNoteHotel'];
								$adresseHotel = $_POST['addAdresseHotel'];
								$telephoneHotel = $_POST['addTelephoneHotel'];
								$faxHotel = $_POST['addFaxHotel'];
								$descriptionHotel = $_POST['addDescriptionHotel'];
								$tarifsHotel = $_POST['addTarifsHotel'];
								$lienHotel = $_POST['addLienHotel'];
								ajoutHotel($nomHotel, $photoHotel, $noteHotel, $adresseHotel, $telephoneHotel, $faxHotel, $descriptionHotel, $tarifsHotel, $lienHotel);
							}
						?>
					</form>
				</div>
			</div>
		</div>

		<span class="separerHorizontal"></span>

	  <!-- Cocktails -->
		<div class="conteneur conteneur-carrousel-modifier conteneur-informationspratiques conteneur-informationspratiques-div conteneur-informationspratiques-restauration" id="cocktails">
			<h2>Cocktails</h2>
			<div class="conteneur-div filtre">
			<?php
				$restaurants = $db->prepare('SELECT * FROM restaurants WHERE choix="c" ORDER BY nomR;');
				$restaurants->execute();
			    $compteurRestaurants = 0;
				while ($chaqueRestaurant = $restaurants->fetch()) {
			?>
				<!-- Gestion de modification et de suppression -->
				<div class="before-figure vertical-align-top">
					<figure id="infosCocktails<?php echo $chaqueRestaurant['idR']; ?>" class="fig-img fig-img<?php echo $chaqueRestaurant['idR']; ?>">
						<?php if(!is_null($chaqueRestaurant['photoR'])){?>
						<img alt="photo_restaurant_<?php echo $compteurRestaurants; ?>" src="../<?php echo $chaqueRestaurant['photoR']; ?>">
						<?php } ?>
						<figcaption class="text-align-left">
							<p><em>Nom</em> : <?php echo $chaqueRestaurant['nomR']; ?></p>
							<p><em>Description</em> :<br /><?php echo str_replace(array("\r\n","\n", '\n'),"<br />", $chaqueRestaurant['descriptionR']); ?></p>
						</figcaption>
					</figure>

					<!-- Bouton modifier -->
					<span id="btnModifRestaurant<?php echo $chaqueRestaurant['idR']; ?>" class="glyphicon glyphicon-edit btn-edit" onclick="modifierInfoPratiques(this, '<?php echo $chaqueRestaurant['idR']; ?>', 'Cocktails');" ></span>
					<!-- *************** -->
					<!-- Bouton supprimer -->
					<span id="supprimerRestaurant<?php echo $chaqueRestaurant['idR']; ?>" class="glyphicon glyphicon-remove btn-remove" onclick="modifierInfoSupprInfoPratiques(this, '<?php echo $chaqueRestaurant['idR']; ?>', 'Cocktails');" ></span>
					<!-- *************** -->

					<!-- Formulaire de modification -->
					<form method="post" enctype="multipart/form-data" class="partieCachee" id="formModifCocktails<?php echo $chaqueRestaurant['idR']; ?>" style="margin-bottom: 30px; text-align: left;">
						<input class="first_inp" type="hidden" name="idRestaurant<?php echo $chaqueRestaurant['idR']; ?>" value="<?php echo $chaqueRestaurant['idR']; ?>" />
						<!-- Image Restaurant -->
						<label class="first_lab" for="photoRestaurant<?php echo $chaqueRestaurant['idR']; ?>">Photo à modifier</label>
						<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
						<input style="display: block;" type="file" name="photoRestaurant<?php echo $chaqueRestaurant['idR']; ?>" value="<?php echo $chaqueRestaurant['photoR']; ?>" />
						<!-- Nom Restaurant -->
						<label for="nomRestaurant<?php echo $chaqueRestaurant['idR']; ?>">Nom*</label><br />
						<input type="text" name="nomRestaurant<?php echo $chaqueRestaurant['idR']; ?>" value="<?php echo $chaqueRestaurant['nomR']; ?>" /><br />

						<!-- Description Restaurant -->
						<label for="descriptionRestaurant<?php echo $chaqueRestaurant['idR']; ?>">Description</label><br />
						<textarea rows="6" name="descriptionRestaurant<?php echo $chaqueRestaurant['idR']; ?>"><?php echo $chaqueRestaurant['descriptionR']; ?></textarea><br />

						<!-- Boutons de validation -->
						<input type="submit" name="modifierRestaurant<?php echo $chaqueRestaurant['idR']; ?>" value="Modifier" class="input_validation" />
						<input type="submit" name="annulerr" value="Annuler" class="input_annulation" />

						<?php
							if (isset($_POST['modifierRestaurant' . $chaqueRestaurant['idR']])) {
								$idR = $_POST['idRestaurant' . $chaqueRestaurant['idR']];
								$nomRestaurant = $_POST['nomRestaurant' . $chaqueRestaurant['idR']];
								$photoRestaurant = 'photoRestaurant' . $chaqueRestaurant['idR'];
								$descriptionRestaurant = $_POST['descriptionRestaurant' . $chaqueRestaurant['idR']];
								modifRestaurant($idR, $nomRestaurant, $photoRestaurant, $descriptionRestaurant);
							}
							if (isset($_POST['annulerr'])) {
						?>
								<meta http-equiv="refresh" content="0;url=infoP.php#restauration" />
						<?php
							}
						?>
					</form>

					<!-- Formulaire de suppression -->
					<form method="post" class="partieCachee" id="formSupprCocktails<?php echo $chaqueRestaurant['idR']; ?>" style="margin-bottom: 30px;">
						<input class="first_inp" type="hidden" name="idRestaurant<?php echo $chaqueRestaurant['idR']; ?>" value="<?php echo $chaqueRestaurant['idR']; ?>" />
						<input class="" type="hidden" name="photoRestaurant<?php echo $chaqueRestaurant['idR']; ?>" value="<?php echo $chaqueRestaurant['photoR']; ?>" />
						<p style="font-size: 1.5em; color: #FFFFFF;">Voulez-vous vraiment supprimer cette diapo du carrousel ?</p>
						<input type="submit" name="supprimerRestaurant<?php echo $chaqueRestaurant['idR']; ?>" value="Oui" class="input_over" />
						<input type="submit" name="annuleSupression" value="Non" />

						<?php
							if (isset($_POST['supprimerRestaurant' . $chaqueRestaurant['idR']])) {
								$idR = $_POST['idRestaurant' . $chaqueRestaurant['idR']];
								$photoR = $_POST['photoRestaurant' . $chaqueRestaurant['idR']];
								suppressionRestaurant($idR, $photoR);
							}
						?>
					</form>
				</div>
		<!-- ************************** -->
			<?php
					$compteurRestaurants++;
				}
				$restaurants->closeCursor();
			?>
				<!-- Gestion d'ajout -->
				<div class="before-figure">

					<!-- Bouton ajouter -->
					<span id="span-ajout-img-carrousel" class="glyphicon glyphicon-plus-sign btn-add" onclick="modifierInfoAdd(this, 'form-ajoutCocktails');" ></span>
					<!-- *************** -->

					<!-- Formulaire d'ajout -->
					<form method="post" enctype="multipart/form-data" class="partieCachee form-ajout" id="form-ajoutCocktails" style="margin-bottom: 30px; text-align: left;">
						<input class="first_inp" type="hidden" name="idp">

						<label class="first_lab" for="addPhotoRestaurant">Image à ajouter</label>
						<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
						<input style="display: block;" type="file" name="addPhotoRestaurant" />
						<!-- Nom hôtel -->
						<label for="addNomRestaurant<?php echo $chaqueRestaurant['idR']; ?>">Nom*</label><br />
						<input type="text" name="addNomRestaurant<?php echo $chaqueRestaurant['idR']; ?>" value="<?php echo $chaqueRestaurant['nomR']; ?>" /><br />

						<!-- Description hôtel -->
						<label for="addDescriptionRestaurant<?php echo $chaqueRestaurant['idR']; ?>">Description</label><br />
						<textarea rows="6" name="addDescriptionRestaurant<?php echo $chaqueRestaurant['idR']; ?>"><?php echo $chaqueRestaurant['descriptionR']; ?></textarea><br />


						<input type="submit" name="ajouterCocktails" value="Ajouter" />
						<input type="submit" name="annuleSupression" value="Non" />

						<?php
							if (isset($_POST['ajouterCocktails'])) {
								$nomRestaurant = $_POST['addNomRestaurant'];
								$photoRestaurant = 'addPhotoRestaurant';
								$descriptionRestaurant = $_POST['addDescriptionRestaurant'];
								ajoutRestaurant($nomRestaurant, $photoRestaurant, $descriptionRestaurant,"c");
							}
						?>
					</form>
				</div>
			</div>
		</div>

		<span class="separerHorizontal"></span>

			<!-- Restaurants -->
	  		<div class="conteneur conteneur-carrousel-modifier conteneur-informationspratiques conteneur-informationspratiques-div conteneur-informationspratiques-restauration" id="restauration">
	  			<h2>Diner</h2>
	  			<div class="conteneur-div filtre">
	  			<?php
	  				$restaurants = $db->prepare('SELECT * FROM restaurants WHERE choix="d" ORDER BY nomR;');
	  				$restaurants->execute();
	  			    $compteurRestaurants = 0;
	  				while ($chaqueRestaurant = $restaurants->fetch()) {
	  			?>
	  				<!-- Gestion de modification et de suppression -->
	  				<div class="before-figure vertical-align-top">
	  					<figure id="infosRestaurants<?php echo $chaqueRestaurant['idR']; ?>" class="fig-img fig-img<?php echo $chaqueRestaurant['idR']; ?>">
							<?php if(!is_null($chaqueRestaurant['photoR'])){?>
							<img alt="photo_restaurant_<?php echo $compteurRestaurants; ?>" src="../<?php echo $chaqueRestaurant['photoR']; ?>">
							<?php } ?>
							<figcaption class="text-align-left">
	  							<p><em>Nom</em> : <?php echo $chaqueRestaurant['nomR']; ?></p>
	  							<p><em>Description</em> :<br /><?php echo str_replace(array("\r\n","\n", '\n'),"<br />", $chaqueRestaurant['descriptionR']); ?></p>
	  						</figcaption>
	  					</figure>

	  					<!-- Bouton modifier -->
	  					<span id="btnModifRestaurant<?php echo $chaqueRestaurant['idR']; ?>" class="glyphicon glyphicon-edit btn-edit" onclick="modifierInfoPratiques(this, '<?php echo $chaqueRestaurant['idR']; ?>', 'Restaurants');" ></span>
	  					<!-- *************** -->
	  					<!-- Bouton supprimer -->
	  					<span id="supprimerRestaurant<?php echo $chaqueRestaurant['idR']; ?>" class="glyphicon glyphicon-remove btn-remove" onclick="modifierInfoSupprInfoPratiques(this, '<?php echo $chaqueRestaurant['idR']; ?>', 'Restaurants');" ></span>
	  					<!-- *************** -->

	  					<!-- Formulaire de modification -->
	  					<form method="post" enctype="multipart/form-data" class="partieCachee" id="formModifRestaurants<?php echo $chaqueRestaurant['idR']; ?>" style="margin-bottom: 30px; text-align: left;">
	  						<input class="first_inp" type="hidden" name="idRestaurant<?php echo $chaqueRestaurant['idR']; ?>" value="<?php echo $chaqueRestaurant['idR']; ?>" />
	  						<!-- Image Restaurant -->
	  						<label class="first_lab" for="photoRestaurant<?php echo $chaqueRestaurant['idR']; ?>">Photo à modifier</label>
	  						<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
	  						<input style="display: block;" type="file" name="photoRestaurant<?php echo $chaqueRestaurant['idR']; ?>" value="<?php echo $chaqueRestaurant['photoR']; ?>" />
	  						<!-- Nom Restaurant -->
	  						<label for="nomRestaurant<?php echo $chaqueRestaurant['idR']; ?>">Nom*</label><br />
	  						<input type="text" name="nomRestaurant<?php echo $chaqueRestaurant['idR']; ?>" value="<?php echo $chaqueRestaurant['nomR']; ?>" /><br />

	  						<!-- Description Restaurant -->
	  						<label for="descriptionRestaurant<?php echo $chaqueRestaurant['idR']; ?>">Description</label><br />
	  						<textarea rows="6" name="descriptionRestaurant<?php echo $chaqueRestaurant['idR']; ?>"><?php echo $chaqueRestaurant['descriptionR']; ?></textarea><br />

	  						<!-- Boutons de validation -->
	  						<input type="submit" name="modifierRestaurant<?php echo $chaqueRestaurant['idR']; ?>" value="Modifier" class="input_validation" />
	  						<input type="submit" name="annulerr" value="Annuler" class="input_annulation" />

	  						<?php
	  							if (isset($_POST['modifierRestaurant' . $chaqueRestaurant['idR']])) {
	  								$idR = $_POST['idRestaurant' . $chaqueRestaurant['idR']];
	  								$nomRestaurant = $_POST['nomRestaurant' . $chaqueRestaurant['idR']];
	  								$photoRestaurant = 'photoRestaurant' . $chaqueRestaurant['idR'];
	  								$descriptionRestaurant = $_POST['descriptionRestaurant' . $chaqueRestaurant['idR']];
	  								modifRestaurant($idR, $nomRestaurant, $photoRestaurant, $descriptionRestaurant);
	  							}
	  							if (isset($_POST['annulerr'])) {
	  						?>
	  								<meta http-equiv="refresh" content="0;url=infoP.php#restauration" />
	  						<?php
	  							}
	  						?>
	  					</form>

	  					<!-- Formulaire de suppression -->
	  					<form method="post" class="partieCachee" id="formSupprRestaurants<?php echo $chaqueRestaurant['idR']; ?>" style="margin-bottom: 30px;">
	  						<input class="first_inp" type="hidden" name="idRestaurant<?php echo $chaqueRestaurant['idR']; ?>" value="<?php echo $chaqueRestaurant['idR']; ?>" />
	  						<input class="" type="hidden" name="photoRestaurant<?php echo $chaqueRestaurant['idR']; ?>" value="<?php echo $chaqueRestaurant['photoR']; ?>" />
	  						<p style="font-size: 1.5em; color: #FFFFFF;">Voulez-vous vraiment supprimer cette diapo du carrousel ?</p>
	  						<input type="submit" name="supprimerRestaurant<?php echo $chaqueRestaurant['idR']; ?>" value="Oui" class="input_over" />
	  						<input type="submit" name="annuleSupression" value="Non" />

	  						<?php
	  							if (isset($_POST['supprimerRestaurant' . $chaqueRestaurant['idR']])) {
	  								$idR = $_POST['idRestaurant' . $chaqueRestaurant['idR']];
	  								$photoR = $_POST['photoRestaurant' . $chaqueRestaurant['idR']];
	  								suppressionRestaurant($idR, $photoR);
	  							}
	  						?>
	  					</form>
	  				</div>
	  		<!-- ************************** -->
	  			<?php
	  					$compteurRestaurants++;
	  				}
	  				$restaurants->closeCursor();
	  			?>
	  				<!-- Gestion d'ajout -->
	  				<div class="before-figure">

	  					<!-- Bouton ajouter -->
	  					<span id="span-ajout-img-carrousel" class="glyphicon glyphicon-plus-sign btn-add" onclick="modifierInfoAdd(this, 'form-ajoutRestaurants');" ></span>
	  					<!-- *************** -->

	  					<!-- Formulaire d'ajout -->
	  					<form method="post" enctype="multipart/form-data" class="partieCachee form-ajout" id="form-ajoutRestaurants" style="margin-bottom: 30px; text-align: left;">
	  						<input class="first_inp" type="hidden" name="idp">

	  						<label class="first_lab" for="addPhotoRestaurant">Image à ajouter</label>
	  						<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
	  						<input style="display: block;" type="file" name="addPhotoRestaurant" />
	  						<!-- Nom hôtel -->
	  						<label for="addNomRestaurant<?php echo $chaqueRestaurant['idR']; ?>">Nom*</label><br />
	  						<input type="text" name="addNomRestaurant<?php echo $chaqueRestaurant['idR']; ?>" value="<?php echo $chaqueRestaurant['nomR']; ?>" /><br />

	  						<!-- Description hôtel -->
	  						<label for="addDescriptionRestaurant<?php echo $chaqueRestaurant['idR']; ?>">Description</label><br />
	  						<textarea rows="6" name="addDescriptionRestaurant<?php echo $chaqueRestaurant['idR']; ?>"><?php echo $chaqueRestaurant['descriptionR']; ?></textarea><br />


	  						<input type="submit" name="ajouterRestaurant" value="Ajouter" />
	  						<input type="submit" name="annuleSupression" value="Non" />

	  						<?php
	  							if (isset($_POST['ajouterRestaurant'])) {
	  								$nomRestaurant = $_POST['addNomRestaurant'];
	  								$photoRestaurant = 'addPhotoRestaurant';
	  								$descriptionRestaurant = $_POST['addDescriptionRestaurant'];
	  								ajoutRestaurant($nomRestaurant, $photoRestaurant, $descriptionRestaurant,"d");
	  							}
	  						?>
	  					</form>
	  				</div>
	  			</div>
	  		</div>

				<span class="separerHorizontal"></span>

				<!-- Restaurants -->
				<div class="conteneur conteneur-carrousel-modifier conteneur-informationspratiques conteneur-informationspratiques-div conteneur-informationspratiques-restauration" id="marche">
					<h2>Marché des Produits Régionaux</h2>
					<div class="conteneur-div filtre">
						<?php
						$restaurants = $db->prepare('SELECT * FROM restaurants WHERE choix="m" ORDER BY nomR;');
						$restaurants->execute();
						$compteurRestaurants = 0;
						while ($chaqueRestaurant = $restaurants->fetch()) {
							?>
							<!-- Gestion de modification et de suppression -->
							<div class="before-figure vertical-align-top">
								<figure id="infosRestaurants<?php echo $chaqueRestaurant['idR']; ?>" class="fig-img fig-img<?php echo $chaqueRestaurant['idR']; ?>">
									<?php if(!is_null($chaqueRestaurant['photoR'])){?>
										<img alt="photo_restaurant_<?php echo $compteurRestaurants; ?>" src="../<?php echo $chaqueRestaurant['photoR']; ?>">
									<?php } ?>
									<figcaption class="text-align-left">
										<p><em>Nom</em> : <?php echo $chaqueRestaurant['nomR']; ?></p>
										<p><em>Description</em> :<br /><?php echo str_replace(array("\r\n","\n", '\n'),"<br />", $chaqueRestaurant['descriptionR']); ?></p>
									</figcaption>
								</figure>

								<!-- Bouton modifier -->
								<span id="btnModifRestaurant<?php echo $chaqueRestaurant['idR']; ?>" class="glyphicon glyphicon-edit btn-edit" onclick="modifierInfoPratiques(this, '<?php echo $chaqueRestaurant['idR']; ?>', 'Marche');" ></span>
								<!-- *************** -->
								<!-- Bouton supprimer -->
								<span id="supprimerRestaurant<?php echo $chaqueRestaurant['idR']; ?>" class="glyphicon glyphicon-remove btn-remove" onclick="modifierInfoSupprInfoPratiques(this, '<?php echo $chaqueRestaurant['idR']; ?>', 'Marche');" ></span>
								<!-- *************** -->

								<!-- Formulaire de modification -->
								<form method="post" enctype="multipart/form-data" class="partieCachee" id="formModifMarche<?php echo $chaqueRestaurant['idR']; ?>" style="margin-bottom: 30px; text-align: left;">
									<input class="first_inp" type="hidden" name="idRestaurant<?php echo $chaqueRestaurant['idR']; ?>" value="<?php echo $chaqueRestaurant['idR']; ?>" />
									<!-- Image Restaurant -->
									<label class="first_lab" for="photoRestaurant<?php echo $chaqueRestaurant['idR']; ?>">Photo à modifier</label>
									<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
									<input style="display: block;" type="file" name="photoRestaurant<?php echo $chaqueRestaurant['idR']; ?>" value="<?php echo $chaqueRestaurant['photoR']; ?>" />
									<!-- Nom Restaurant -->
									<label for="nomRestaurant<?php echo $chaqueRestaurant['idR']; ?>">Nom*</label><br />
									<input type="text" name="nomRestaurant<?php echo $chaqueRestaurant['idR']; ?>" value="<?php echo $chaqueRestaurant['nomR']; ?>" /><br />

									<!-- Description Restaurant -->
									<label for="descriptionRestaurant<?php echo $chaqueRestaurant['idR']; ?>">Description</label><br />
									<textarea rows="6" name="descriptionRestaurant<?php echo $chaqueRestaurant['idR']; ?>"><?php echo $chaqueRestaurant['descriptionR']; ?></textarea><br />

									<!-- Boutons de validation -->
									<input type="submit" name="modifierRestaurant<?php echo $chaqueRestaurant['idR']; ?>" value="Modifier" class="input_validation" />
									<input type="submit" name="annulerm" value="Annuler" class="input_annulation" />

									<?php
									if (isset($_POST['modifierRestaurant' . $chaqueRestaurant['idR']])) {
										$idR = $_POST['idRestaurant' . $chaqueRestaurant['idR']];
										$nomRestaurant = $_POST['nomRestaurant' . $chaqueRestaurant['idR']];
										$photoRestaurant = 'photoRestaurant' . $chaqueRestaurant['idR'];
										$descriptionRestaurant = $_POST['descriptionRestaurant' . $chaqueRestaurant['idR']];
										modifRestaurant($idR, $nomRestaurant, $photoRestaurant, $descriptionRestaurant);
									}
									if (isset($_POST['annulerm'])) {
										?>
										<meta http-equiv="refresh" content="0;url=infoP.php#marche" />
										<?php
									}
									?>
								</form>

								<!-- Formulaire de suppression -->
								<form method="post" class="partieCachee" id="formSupprMarche<?php echo $chaqueRestaurant['idR']; ?>" style="margin-bottom: 30px;">
									<input class="first_inp" type="hidden" name="idRestaurant<?php echo $chaqueRestaurant['idR']; ?>" value="<?php echo $chaqueRestaurant['idR']; ?>" />
									<input class="" type="hidden" name="photoRestaurant<?php echo $chaqueRestaurant['idR']; ?>" value="<?php echo $chaqueRestaurant['photoR']; ?>" />
									<p style="font-size: 1.5em; color: #FFFFFF;">Voulez-vous vraiment supprimer cette diapo du carrousel ?</p>
									<input type="submit" name="supprimerRestaurant<?php echo $chaqueRestaurant['idR']; ?>" value="Oui" class="input_over" />
									<input type="submit" name="annuleSupression" value="Non" />

									<?php
									if (isset($_POST['supprimerRestaurant' . $chaqueRestaurant['idR']])) {
										$idR = $_POST['idRestaurant' . $chaqueRestaurant['idR']];
										$photoR = $_POST['photoRestaurant' . $chaqueRestaurant['idR']];
										suppressionRestaurant($idR, $photoR);
									}
									?>
								</form>
							</div>
							<!-- ************************** -->
							<?php
							$compteurRestaurants++;
						}
						$restaurants->closeCursor();
						?>
						<!-- Gestion d'ajout -->
						<div class="before-figure">

							<!-- Bouton ajouter -->
							<span id="span-ajout-img-carrousel" class="glyphicon glyphicon-plus-sign btn-add" onclick="modifierInfoAdd(this, 'form-ajoutMarche');" ></span>
							<!-- *************** -->

							<!-- Formulaire d'ajout -->
							<form method="post" enctype="multipart/form-data" class="partieCachee form-ajout" id="form-ajoutMarche" style="margin-bottom: 30px; text-align: left;">
								<input class="first_inp" type="hidden" name="idp">

								<label class="first_lab" for="addPhotoRestaurant">Image à ajouter</label>
								<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
								<input style="display: block;" type="file" name="addPhotoRestaurant" />
								<!-- Nom hôtel -->
								<label for="addNomRestaurant<?php echo $chaqueRestaurant['idR']; ?>">Nom*</label><br />
								<input type="text" name="addNomRestaurant<?php echo $chaqueRestaurant['idR']; ?>" value="<?php echo $chaqueRestaurant['nomR']; ?>" /><br />

								<!-- Description hôtel -->
								<label for="addDescriptionRestaurant<?php echo $chaqueRestaurant['idR']; ?>">Description</label><br />
								<textarea rows="6" name="addDescriptionRestaurant<?php echo $chaqueRestaurant['idR']; ?>"><?php echo $chaqueRestaurant['descriptionR']; ?></textarea><br />


								<input type="submit" name="ajouterMarche" value="Ajouter" />
								<input type="submit" name="annuleSupression" value="Non" />

								<?php
								if (isset($_POST['ajouterMarche'])) {
									$nomRestaurant = $_POST['addNomRestaurant'];
									$photoRestaurant = 'addPhotoRestaurant';
									$descriptionRestaurant = $_POST['addDescriptionRestaurant'];
									ajoutRestaurant($nomRestaurant, $photoRestaurant, $descriptionRestaurant,"m");
								}
								?>
							</form>
						</div>
					</div>
				</div>

		<span class="separerHorizontal"></span>

	  <!-- Tourisme -->
		<div class="conteneur conteneur-carrousel-modifier conteneur-informationspratiques conteneur-informationspratiques-div conteneur-informationspratiques-tourisme" id="tourisme">
			<h2>Tourisme</h2>
			<div class="conteneur-div filtre">
			<?php
				$tourisme = $db->prepare('SELECT * FROM tourisme ORDER BY titreT;');
				$tourisme->execute();
			    $compteurToursime = 0;
				while ($chaqueTourisme = $tourisme->fetch()) {
			?>
				<!-- Gestion de modification et de suppression -->
				<div class="before-figure vertical-align-top">
					<figure id="infosTourisme<?php echo $chaqueTourisme['idT']; ?>" class="fig-img fig-img<?php echo $chaqueTourisme['idT']; ?>">
						<?php if ($chaqueTourisme['videoT'] != ""){ ?>
							<div>
								<iframe class="embed-responsive-item" width="336px" height="189px" src="https://www.youtube.com/embed/<?php echo $chaqueTourisme['videoT']; ?>"></iframe>
							</div>
						<?php } ?>
						<?php if (!is_null($chaqueTourisme['imageT'])){ ?>
							<img alt="photo_tourisme_<?php echo $compteurToursime; ?>" src="../<?php echo $chaqueTourisme['imageT']; ?>">
						<?php }?>
						<figcaption class="text-align-center">
							<p><em>Titre</em> : <?php echo $chaqueTourisme['titreT']; ?></p>
							<p><em>Description</em> :<br /><?php echo str_replace(array("\r\n","\n", '\n'),"<br />", $chaqueTourisme['paragrapheT']); ?></p>
							<p><em>Lien</em> : <br><?php echo $chaqueTourisme['lienT']; ?></p>
							<p><em>Langue concernée</em> :
								<?php
									if($chaqueTourisme['lang']=="en"){
										echo "Anglais";
									} else {
										echo "Français";
									}
								 ?>
							</p>
						</figcaption>
					</figure>

					<!-- Bouton modifier -->
					<span id="btnModifTourisme<?php echo $chaqueTourisme['idT']; ?>" class="glyphicon glyphicon-edit btn-edit" onclick="modifierInfoPratiques(this, '<?php echo $chaqueTourisme['idT']; ?>', 'Tourisme');" ></span>
					<!-- *************** -->
					<!-- Bouton supprimer -->
					<span id="supprimerTourisme<?php echo $chaqueTourisme['idT']; ?>" class="glyphicon glyphicon-remove btn-remove" onclick="modifierInfoSupprInfoPratiques(this, '<?php echo $chaqueTourisme['idT']; ?>', 'Tourisme');" ></span>
					<!-- *************** -->

					<!-- Formulaire de modification -->
					<form method="post" enctype="multipart/form-data" class="partieCachee" id="formModifTourisme<?php echo $chaqueTourisme['idT']; ?>" style="margin-bottom: 30px; text-align: left;">
						<input class="first_inp" type="hidden" name="idTourisme<?php echo $chaqueTourisme['idT']; ?>" value="<?php echo $chaqueTourisme['idT']; ?>" />
						<!-- Image Tourisme -->
						<label class="first_lab" for="photoTourisme<?php echo $chaqueTourisme['idT']; ?>">Photo à modifier</label>
						<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
						<input style="display: block;" type="file" name="photoTourisme<?php echo $chaqueTourisme['idT']; ?>" value="<?php echo $chaqueTourisme['imageT']; ?>" />
						<!-- Titre Tourisme -->
						<label for="titreTourisme<?php echo $chaqueTourisme['idT']; ?>">Nom</label><br />
						<input type="text" name="titreTourisme<?php echo $chaqueTourisme['idT']; ?>" value="<?php echo $chaqueTourisme['titreT']; ?>" required/><br />
						<!-- Description Tourisme -->
						<label for="descriptionTourisme<?php echo $chaqueTourisme['idT']; ?>">Description</label><br />
						<textarea rows="6" name="descriptionTourisme<?php echo $chaqueTourisme['idT']; ?>"><?php echo $chaqueTourisme['paragrapheT'];?></textarea><br />
						<!-- Lien "Plus d'infos" hôtel -->
						<label for="lienTourisme<?php echo $chaqueTourisme['idT']; ?>">Lien "Plus d'infos"</label><br />
						<input type="text" name="lienTourisme<?php echo $chaqueTourisme['idT']; ?>" value="<?php echo $chaqueTourisme['lienT']; ?>" style="width: 100%;" /><br /><br />

						<label>Langue concernée</label>
						<select name="langue<?php echo $chaqueTourisme['idT']; ?>">
							<?php
							if($chaqueTourisme['lang']=='en'){
								echo '<option value="fr">Français</option>
								<option value="en" selected>English</option>';
							} else {
								echo '<option value="fr" selected>Français</option>
								<option value="en">English</option>';
							}
							?>
						</select>

						<div class="form-group">
							<label>Lien YouTube</label>
							<div class="input-group">
								<span class="input-group-addon">https://www.youtube.com/watch?v=</span>
								<input class="form-control" name="<?php echo 'videoT'.$chaqueTourisme['idT']; ?>" value = "<?php echo $chaqueTourisme['videoT']; ?>" placeholder="AABBccdd">
							</div>
						</div>

						<!-- Boutons de validation -->
						<input type="submit" name="modifierTourisme<?php echo $chaqueTourisme['idT']; ?>" value="Modifier" class="input_validation" />
						<input type="submit" name="annulerto" value="Annuler" class="input_annulation" />

						<?php
							if (isset($_POST['modifierTourisme' . $chaqueTourisme['idT']])) {
								$idT = $_POST['idTourisme' . $chaqueTourisme['idT']];
								$titreTourisme = $_POST['titreTourisme' . $chaqueTourisme['idT']];
								$photoTourisme = 'photoTourisme' . $chaqueTourisme['idT'];
								$descriptionTourisme = $_POST['descriptionTourisme' . $chaqueTourisme['idT']];
								$lienTourisme = $_POST['lienTourisme' . $chaqueTourisme['idT']];
								$videoT = $_POST['videoT'.$chaqueTourisme['idT']];
								$langue = $_POST['langue'.$chaqueTourisme['idT']];
								modifTourisme($idT, $titreTourisme, $photoTourisme, $descriptionTourisme, $lienTourisme,$videoT,$langue);
							}
							if (isset($_POST['annulerto'])) {
						?>
								<meta http-equiv="refresh" content="0;url=infoP.php#tourisme" />
						<?php
							}
						?>
					</form>

					<!-- Formulaire de suppression -->
					<form method="post" class="partieCachee" id="formSupprTourisme<?php echo $chaqueTourisme['idT']; ?>" style="margin-bottom: 30px;">
						<input class="first_inp" type="hidden" name="idTourisme<?php echo $chaqueTourisme['idT']; ?>" value="<?php echo $chaqueTourisme['idT']; ?>" />
						<input class="" type="hidden" name="imageTourisme<?php echo $chaqueTourisme['idT']; ?>" value="<?php echo $chaqueTourisme['imageT']; ?>" />
						<p style="font-size: 1.5em; color: #FFFFFF;">Voulez-vous vraiment supprimer cette diapo du carrousel ?</p>
						<input type="submit" name="supprimerTourisme<?php echo $chaqueTourisme['idT']; ?>" value="Oui" class="input_over" />
						<input type="submit" name="annuleSupression" value="Non" />

						<?php
							if (isset($_POST['supprimerTourisme' . $chaqueTourisme['idT']])) {
								$idT = $_POST['idTourisme' . $chaqueTourisme['idT']];
								$imageT = $_POST['imageTourisme' . $chaqueTourisme['idT']];
								suppressionTourisme($idT, $imageT);
							}
						?>
					</form>
				</div>
		<!-- ************************** -->
			<?php
					$compteurToursime++;
				}
				$restaurants->closeCursor();
			?>
				<!-- Gestion d'ajout -->
				<div class="before-figure">

					<!-- Bouton ajouter -->
					<span id="span-ajout-img-carrousel" class="glyphicon glyphicon-plus-sign btn-add" onclick="modifierInfoAdd(this, 'form-ajoutTourisme');" ></span>
					<!-- *************** -->

					<!-- Formulaire d'ajout -->
					<form method="post" enctype="multipart/form-data" class="partieCachee form-ajout" id="form-ajoutTourisme<?php echo $chaqueTourisme['idT']; ?>" style="margin-bottom: 30px; text-align: left;">
						<input class="first_inp" type="hidden" name="idp">

						<label class="first_lab" for="addImageTourisme">Image à ajouter</label>
						<input style="display: block;" type="file" name="addImageTourisme" />
						<!-- Nom hôtel -->
						<label for="addTitreTourisme<?php echo $chaqueTourisme['idT']; ?>">Nom</label><br />
						<input type="text" name="addTitreTourisme<?php echo $chaqueTourisme['idT']; ?>" value="<?php echo $chaqueTourisme['titreT']; ?>" /><br />
						<!-- Description hôtel -->
						<label for="addDescriptionTourisme<?php echo $chaqueTourisme['idT']; ?>">Description</label><br />
						<textarea rows="6" name="addDescriptionTourisme<?php echo $chaqueTourisme['idT']; ?>"><?php echo $chaqueTourisme['paragrapheT']; ?></textarea><br />
						<!-- Lien "Plus d'infos" hôtel -->
						<label for="addLienTourisme<?php echo $chaqueTourisme['idT']; ?>">Lien "Plus d'infos"</label><br />
						<input type="text" name="addLienTourisme<?php echo $chaqueTourisme['idT']; ?>" value="<?php echo $chaqueTourisme['lienT']; ?>" style="width: 100%;" /><br /><br />

						<label>Langue concernée</label>
						<select name="langue">
							<option value="fr" selected>Français</option>
							<option value="en">English</option>
						</select>

						<div class="form-group">
							<label>Lien YouTube</label>
							<div class="input-group">
								<span class="input-group-addon">https://www.youtube.com/watch?v=</span>
								<input class="form-control" name="videoT" value = "<?php echo $chaqueTourisme['videoT']; ?>" placeholder="AABBccdd">
							</div>
						</div>

						<input type="submit" name="ajouterTourisme" value="Ajouter" />
						<input type="submit" name="annuleSupression" value="Non" />

						<?php
							if (isset($_POST['ajouterTourisme'])) {
								$titreTourisme = $_POST['addTitreTourisme'];
								$imageTourisme = 'addImageTourisme';
								$descriptionTourisme = $_POST['addDescriptionTourisme'];
								$lienTourisme = $_POST['addLienTourisme'];
								ajoutTourisme($titreTourisme, $imageTourisme, $descriptionTourisme, $lienTourisme, $_POST['videoT'], $_POST['langue']);
							}
						?>
					</form>
				</div>
			</div>
		</div>

		<span class="separerHorizontal"></span>

	  <!-- Accès Wi-Fi -->
		<div class="conteneur conteneur-informationspratiques conteneur-informationspratiques-div conteneur-informationspratiques-acceswifi" id="acceswifi">
			<h2>Accès au Wi-Fi</h2>
		<?php
			$accesWifi = $db->prepare('SELECT * FROM wifi ORDER BY idWifi;');
			$accesWifi->execute();
			while ($chaqueWifi = $accesWifi->fetch()) {
		?>
			<div class="conteneur-div filtre" style="text-align: left;">
				<h3><?php echo substr($chaqueWifi['descriptionWifi'], 0, 40); ?>...</h3>
				<div class="present-text" id="infosAccesWifi<?php echo $chaqueWifi['idWifi']; ?>">
					<p id="descriptionWifi<?php echo $chaqueWifi['idWifi']; ?>"><em class="em">Description</em> : <?php echo str_replace(array("\r\n","\n"),"<br />", $chaqueWifi['descriptionWifi']); ?></p>
					<p id="lienWifi<?php echo $chaqueWifi['idWifi']; ?>"><em class="em">Lien "Plus d'informations"</em> : <?php echo $chaqueWifi['lienWifi']; ?></p>
				</div><br />

				<!-- Bouton modifier -->
				<span id="btnModifAccesWifi<?php echo $chaqueWifi['idWifi']; ?>" class="glyphicon glyphicon-edit btn-edit" onclick="modifierInfoPratiques(this, '<?php echo $chaqueWifi['idWifi']; ?>', 'AccesWifi');" style="margin: -20px 0px 40px 20px;"></span>
				<!-- *************** -->
				<!-- Bouton supprimer -->
				<span id="supprimerAccesWifi<?php echo $chaqueWifi['idWifi']; ?>" class="glyphicon glyphicon-remove btn-remove" onclick="modifierInfoSupprInfoPratiques(this, '<?php echo $chaqueWifi['idWifi']; ?>', 'AccesWifi');" style="margin: -20px 0px 0px 0px;"></span>
				<!-- *************** -->

				<!-- Formulaire de modification -->
				<form method="post" class="partieCachee" id="formModifAccesWifi<?php echo $chaqueWifi['idWifi']; ?>" style="margin-bottom: 30px;">
					<!-- Identifiant du AccesWifi -->
					<input type="hidden" name="idWifi<?php echo $chaqueWifi['idWifi']; ?>" value="<?php echo $chaqueWifi['idWifi']; ?>" />

					<label for="descriptionWifi<?php echo $chaqueWifi['idWifi']; ?>">Description</label>
					<textarea cols="8" style="display: block; width: 300px; padding: 5px;" type="text" name="descriptionWifi<?php echo $chaqueWifi['idWifi']; ?>"><?php echo $chaqueWifi['descriptionWifi']; ?></textarea>

					<label for="lienWifi<?php echo $chaqueWifi['idWifi']; ?>">Lien "Plus d'informations"</label>
					<input type="text" style="width: 100%; padding: 5px; margin-bottom: 20px;" name="lienWifi<?php echo $chaqueWifi['idWifi']; ?>" value="<?php echo $chaqueWifi['lienWifi']; ?>" />

					<input type="submit" name="modifierAccesWifi<?php echo $chaqueWifi['idWifi']; ?>" value="Modifier" class="input_validation" />
					<input type="submit" name="annuleraw" value="Annuler" class="input_annulation" />
					<?php
						$idWifi = $chaqueWifi['idWifi'];
						$descriptionWifi	= 'descriptionWifi' . $chaqueWifi['idWifi'];	// Terminus à modifier
						$lienWifi	= 'lienWifi' . $chaqueWifi['idWifi'];					// Lien à modifier
						$btn_modif = 'modifierAccesWifi' . $chaqueWifi['idWifi'];
						if (isset($_POST[$btn_modif])) {
							modifAccesWifi($idWifi, $descriptionWifi, $lienWifi);
						}
						if (isset($_POST['annuleraw'])) {
					?>
							<meta http-equiv="refresh" content="0;url=infoP.php#acceswifi" />
					<?php
						}
					?>
				</form>

				<!-- Formulaire de suppression -->
				<form method="post" class="partieCachee" id="formSupprAccesWifi<?php echo $chaqueWifi['idWifi']; ?>" style="margin-bottom: 30px;">
					<input class="first_inp" type="hidden" name="idp<?php echo $chaqueWifi['idWifi']; ?>" value="<?php echo $chaqueWifi['idWifi']; ?>" />
					<p style="font-size: 1.5em; color: #FFFFFF;">Voulez-vous vraiment supprimer cette rubrique ?</p>
					<input type="submit" name="supprimerAcces<?php echo $chaqueWifi['idWifi']; ?>" value="Oui" class="input_over" />
					<input type="submit" name="annuleSupression" value="Non" />

					<?php
						if (isset($_POST['supprimerAcces' . $chaqueWifi['idWifi']])) {
							$idWifi = $_POST['idp' . $chaqueWifi['idWifi']];
							suppressionAccesWifi($idWifi);
						}
					?>
				</form>
			</div>
		<?php
			}
			$accesWifi->closeCursor();
		?>
		</div>
			<!-- Gestion d'ajout -->
			<div class="conteneur conteneur-informationspratiques conteneur-informationspratiques-accesiut">
				<div class="conteneur-div filtre">

					<!-- Bouton ajouter -->
					<span style="margin: -20px 0px 40px 20px;" class="glyphicon glyphicon-plus-sign btn-add" onclick="modifierInfoAdd(this, 'form-ajoutAccesWifi');" ></span>
					<!-- *************** -->

					<!-- Formulaire d'ajout -->
					<form method="post" class="partieCachee form-ajout" id="form-ajoutAccesWifi">
						<input class="first_inp" type="hidden" name="idp">


						<label for="addDescriptionAccesWifi">Description</label><br />
						<textarea style="width: 100%;" type="text" name="addDescriptionAccesWifi" placeholder="Entrer une lettre ou numéro de ligne..."></textarea><br />

						<label for="addLienWifi">Lien Wifi</label><br />
						<input style="width: 100%;" type="text" name="addLienWifi" placeholder="http://..." /><br />

						<input type="submit" name="ajouterAccesWifi" value="Ajouter" class="input_validation" />
						<input type="submit" name="annuleSupression" value="Non" />

						<?php
							if (isset($_POST['ajouterAccesWifi'])) {
								$addDescriptionAccesWifi = $_POST['addDescriptionAccesWifi'];
								$addLienWifi = $_POST['addLienWifi'];
								ajoutAccesWifi($addDescriptionAccesWifi, $addLienWifi);
							}
						?>
					</form>
				</div>
			</div>
		</div>

		<span class="separerHorizontal"></span>

	  <!-- Charte de l'IUT -->
		<div class="conteneur conteneur-informationspratiques conteneur-informationspratiques-div conteneur-informationspratiques-chartes" id="chartes">
			<h2>Charte de l'IUT et d'UPS</h2>
		<?php
			$chartes = $db->prepare('SELECT * FROM chartes ORDER BY idCha;');
			$chartes->execute();
			while ($chaqueCharte = $chartes->fetch()) {
		?>
			<div class="conteneur-div filtre" style="text-align: left;">
				<div class="present-text">
					<h3><?php echo str_replace(array("\r\n","\n", '\n'),"<br />", $chaqueCharte['descriptionCha']); ?></h3>
					<p id="p<?php echo $chaqueCharte['idCha']; ?>"><em class="em">Lien du PDF : </em><span class="glyphicon glyphicon-file"></span><?php echo str_replace(array("\r\n","\n", '\n'),"<br />", $chaqueCharte['lienCha']); ?></p>
				</div><br />

				<!-- Bouton modifier -->
				<span id="btnModifCharte<?php echo $chaqueCharte['idCha']; ?>" class="glyphicon glyphicon-edit btn-edit" onclick="modifierInfoPratiques(this, '<?php echo $chaqueCharte['idCha']; ?>', 'Charte');" style="margin: -20px 0px 40px 20px;"></span>
				<!-- *************** -->
				<!-- Bouton supprimer -->
				<span id="supprimerCharte<?php echo $chaqueCharte['idCha']; ?>" class="glyphicon glyphicon-remove btn-remove" onclick="modifierInfoSupprInfoPratiques(this, '<?php echo $chaqueCharte['idCha']; ?>', 'Charte');" style="margin: -20px 0px 0px 0px;"></span>
				<!-- *************** -->

				<!-- Formulaire de modification -->
				<form method="post" enctype="multipart/form-data" class="partieCachee" id="formModifCharte<?php echo $chaqueCharte['idCha']; ?>" style="margin-bottom: 30px;">

					<input type="hidden" name="idp<?php echo $chaqueCharte['idCha']; ?>" value="<?php echo $chaqueCharte['idCha']; ?>" />

					<label for="descriptionCha<?php echo $chaqueCharte['idCha']; ?>">Description du fichier</label>
					<input style="display: block; width: 100%; padding: 5px; margin-bottom: 20px;" type="text" name="descriptionCha<?php echo $chaqueCharte['idCha']; ?>" value="<?php echo $chaqueCharte['descriptionCha']; ?>" />

					<label for="lienCha<?php echo $chaqueCharte['idCha']; ?>">Lien du fichier</label>
					<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
					<input style="display: block;" type="file" name="lienCha<?php echo $chaqueCharte['idCha']; ?>" />

					<input type="submit" name="modifierCharte<?php echo $chaqueCharte['idCha']; ?>" value="Modifier" class="input_validation" />
					<input type="submit" name="annulerc" value="Annuler" class="input_annulation" />
					<?php
						$idCha = $chaqueCharte['idCha'];
						$descriptionCha = 'descriptionCha' . $chaqueCharte['idCha'];	// Titre à modifier
						$lienCha	= 'lienCha' . $chaqueCharte['idCha'];				// Texte à modifier
						$btn_modif = 'modifierCharte' . $chaqueCharte['idCha'];
						if (isset($_POST[$btn_modif])) {
							modifCharte($idCha, $descriptionCha, $lienCha);
						}
						if (isset($_POST['annulerc'])) {
					?>
							<meta http-equiv="refresh" content="0;url=infoP.php#chartes" />
					<?php
						}
					?>
				</form>

				<!-- Formulaire de suppression -->
				<form method="post" class="partieCachee" id="formSupprCharte<?php echo $chaqueCharte['idCha']; ?>" style="margin-bottom: 30px;">
					<input class="first_inp" type="hidden" name="idCha<?php echo $chaqueCharte['idCha']; ?>" value="<?php echo $chaqueCharte['idCha']; ?>" />
					<input class="" type="hidden" name="lienCha<?php echo $chaqueCharte['idCha']; ?>" value="<?php echo $chaqueCharte['lienCha']; ?>" />
					<p style="font-size: 1.5em; color: #FFFFFF;">Voulez-vous vraiment supprimer cette rubrique ?</p>
					<input type="submit" name="supprimerAcces<?php echo $chaqueCharte['idCha']; ?>" value="Oui" class="input_over" />
					<input type="submit" name="annuleSupression" value="Non" />

					<?php
						if (isset($_POST['supprimerAcces' . $chaqueCharte['idCha']])) {
							$idCha = $_POST['idCha' . $chaqueCharte['idCha']];
							$lienCha = $_POST['lienCha' . $chaqueCharte['idCha']];
							suppressionCharte($idCha, $lienCha);
						}
					?>
				</form>
			</div>
		<?php
			}
			$chartes->closeCursor();
		?>
		</div>
			<!-- Gestion d'ajout -->
			<div class="conteneur conteneur-informationspratiques conteneur-informationspratiques-accesiut">
				<div class="conteneur-div filtre">

					<!-- Bouton ajouter -->
					<span style="margin: -20px 0px 40px 20px;" class="glyphicon glyphicon-plus-sign btn-add" onclick="modifierInfoAdd(this, 'form-ajoutCharte');" ></span>
					<!-- *************** -->

					<!-- Formulaire d'ajout -->
					<form method="post" enctype="multipart/form-data" class="partieCachee form-ajout" id="form-ajoutCharte">
						<input class="first_inp" type="hidden" name="idp" />

						<label for="addDescriptionCha">Description</label><br />
						<textarea rows="3" style="width: 100%;" name="addDescriptionCha" placeholder="Entrer un texte..."></textarea><br />
						<!-- Lien du fichier PDF -->
						<label for="addLienCha<?php echo $chaqueCharte['idCha']; ?>">Fichier PDF</label>
						<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
						<input style="display: block;" type="file" name="addLienCha<?php echo $chaqueCharte['idCha']; ?>" />

						<input type="submit" name="ajouterAccesIUT" value="Ajouter" class="input_validation" />
						<input type="submit" name="annuleSupression" value="Non" />

						<?php
							if (isset($_POST['ajouterAccesIUT'])) {
								$descriptionCha = $_POST['addDescriptionCha'];
								$lienCha = 'addLienCha';
								ajoutCharte($descriptionCha, $lienCha);
							}
						?>
					</form>
				</div>
			</div>
		</div>

		<div id="topButton"><span class="glyphicon glyphicon-menu-up"></span></div>

	</div>
	<script type="text/javascript" src="../js/bootstrap.js"></script>
	<script type="text/javascript" src="../js/colloque2018.js"></script>

	<!-- PIED DE PAGE -->
	<footer>
		<?php include('./footer_admin.php'); ?>
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
