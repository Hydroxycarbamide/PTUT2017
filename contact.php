<?php session_start(); ?>
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
	<title>Congrès APLIUT 2018 - Contactez-nous</title>
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
	<div class="page-principale page-principale-contact">

		<!-- GRAND TITRE -->
		<div class="conteneur conteneur-contact conteneur-contact-h1">
			<h1>Contact</h1>
		</div>

		<!-- CONTA C-->
		<div class="conteneur conteneur-contact conteneur-contact-presentation" id="presentation">

			<!-- ******************* ENVOI DES MESSAGES ******************* -->
			<?php
	        # Envoi du formulaire
			if(isset($_POST['envoi'])){
				# Rubriques non vides
				if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['objet']) && !empty($_POST['message'])){

					$nom = $_POST['nom'];
					$prenom = $_POST['prenom'];
					$email = $_POST['email'];
					$objet = $_POST['objet'];
					$message = str_replace("\'", "'", $_POST['message']);

					$contactorganisateur = $db->prepare('SELECT mail FROM connexion WHERE id = id');
					$contactorganisateur->execute(array("id" => '1'));

					$voirContact = $contactorganisateur->fetch();

					$destinataire = $voirContact['mail'];
					$expediteur = ctype_upper($nom) . ' ' . $prenom . ' <' . $email . '>';

					$contenu = "Un internaute du site Colloque 2018 vient de vous contacter. Voici son message :

					Objet : $objet

					$message";

					$entete = "From: $nom $prenom
					Reply-To: $email";

					$send = mail($destinataire, $objet, $contenu, $entete);

					if ($send) {
						?>
						<div class="alert alert-success">Votre email à bien été transmis !</div>
						<?php
					} else {
						?>
						<div class="alert alert-danger">Impossible d'envoyer le mail ! Veuillez réessayer plus tard.</div>
						<?php
					}
				} else {
					?>
					<div class="alert alert-danger">
						Veuillez remplir les champs obligatoires !
					</div>
					<?php
				}
			}
			?>
			<!-- ********************************************************** -->

			<h2>Contacter l'organisateur du Colloque 2018</h2>

			<p class="contact-p">Pour plus de détails à propos du Colloque, vous avez la possibilité de nous joindre via le formulaire suivant :</p>

			<form method="post" action="" class="form-horizontal">
				<div class="form-group">
					<label for="inputnom" class="col-sm-2 control-label">Votre nom</label>
					<div class="col-sm-10">
						<input required type="text" name="nom" class="form-control" id="inputnom" placeholder="Iris" value="<?php echo isset($_SESSION['inputs']['nom'])? $_SESSION['inputs']['nom'] : ''; ?>">
					</div>
				</div>

				<div class="form-group">
					<label for="inputprenom" class="col-sm-2 control-label">Votre prénom</label>
					<div class="col-sm-10">
						<input required type="text" name="prenom" class="form-control" id="inputprenom" placeholder="Bonet" value="<?php echo isset($_SESSION['inputs']['nom'])? $_SESSION['inputs']['nom'] : ''; ?>">
					</div>
				</div>

				<div class="form-group">
					<label for="inputemail" class="col-sm-2 control-label">Votre email</label>
					<div class="col-sm-10">
						<input required type="email" name="email" class="form-control" id="inputemail" placeholder="iris.bonnet@mail.fr" value="<?php echo isset($_SESSION['inputs']['email'])? $_SESSION['inputs']['email'] : ''; ?>">
					</div>
				</div>

				<div class="form-group">
					<label for="inputobjet" class="col-sm-2 control-label">Objet de votre requête</label>
					<div class="col-sm-10">
						<input required type="text" name="objet" class="form-control" id="inputobjet" placeholder="Objet" value="<?php echo isset($_SESSION['inputs']['objet'])? $_SESSION['inputs']['objet'] : ''; ?>">
					</div>
				</div>

				<div class="form-group">
					<label for="inputmessage" class="col-sm-2 control-label">Contenu de votre message</label>
					<div class="col-sm-10">
						<textarea required id="inputmessage" name="message" class="form-control" rows="3" placeholder="Écrire un message..."><?php echo isset($_SESSION['inputs']['message'])? $_SESSION['inputs']['message'] : ''; ?></textarea>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" name="envoi" class="btn btn-default">Envoyer</button>
					</div>
				</div>
			</form>

		</div>

		<div id="topButton"><span class="glyphicon glyphicon-menu-up"></span></div>

	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery-2-1-4-min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/colloque2018.js">
	</script>

	<!-- PIED DE PAGE -->
	<footer>
		<?php include('php/footer.php'); ?>
	</footer>

</body>
</html>
<?php
  unset($_SESSION['inputs']); // on nettoie les données précédentes
  unset($_SESSION['success']);
  unset($_SESSION['errors']);
  ?>
