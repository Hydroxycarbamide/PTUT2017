<?php
	session_start();
	require("../php/connexion.php");
	if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']) AND isset($_SESSION['nom']) AND isset($_SESSION['prenom']))
	{
		header("Refresh:0;url=accueil.php");
	} else {
?>
	<!DOCTYPE html>
	<html lang="fr">
	<head>
		<meta charset="utf-8">
		<link rel="icon" type="text/css" href="../images/favicon.ico"></link>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"></link>
		<link rel="stylesheet" type="text/css" href="../css/style.css"></link>
		<link rel="stylesheet" type="text/css" href="../css/carousel.css"></link>
		<link rel="stylesheet" type="text/css" href="../css/menu.css"></link>
		<link rel="stylesheet" type="text/css" href="../css/footer.css"></link>
		<link rel="stylesheet" type="text/css" href="../css/main.css"></link>
		<link rel="stylesheet" type="text/css" href="../css/max1630px.css" media="screen and (min-width: 1445px) and (max-width: 1630px)"></link>
		<link rel="stylesheet" type="text/css" href="../css/max1445px.css" media="screen and (min-width: 1280px) and (max-width: 1445px)"></link>
		<link rel="stylesheet" type="text/css" href="../css/max1280px.css" media="screen and (min-width: 1032px) and (max-width: 1280px)"></link>
		<link rel="stylesheet" type="text/css" href="../css/max1032px.css" media="screen and (min-width: 768px) and (max-width: 1032px)"></link>
		<link rel="stylesheet" type="text/css" href="../css/mobile.css" media="screen and (max-width: 768px)"></link>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<title>Page administrateur</title>
	</head>
	<body class="body-connexionAdmin">
		<!-- PAGE PRINCIPALE -->
		<div class="page-principale">

			<!-- FORMULAIRE DE CONNEXION -->
			<div class="conteneur conteneur-admin">
				<form method="post" action="" class="form-horizontal">
					<h2>Interface administrateur</h2>
					<div class="form-group">
						<label for="inputPseudo" class="col-sm-2 control-label">Login</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" id="inputPseudo" placeholder="Login" name="pseudo">
						</div>
					</div>
						<div class="form-group">
						<label for="inputPasswd" class="col-sm-2 control-label">Mot de passe</label>
						<div class="col-sm-10">
						  <input type="password" class="form-control" id="inputPasswd" placeholder="Password" name="mdp">
						</div>
					</div>
					<!--div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						  <div class="checkbox">
						    <label>
						      <input type="checkbox">Se souvenir
						    </label>
						  </div>
						</div>
					</div-->
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						  <button type="submit" name="connexion" class="btn btn-default">Se connecter</button>
						</div>
					</div>
				</form>
			</div>

		</div>

		<!-- PIED DE PAGE -->
		<footer class="footer-connexion">
			<div class="acces-site">
				<p>
					<a href="../index.php">Accéder au site du Congrès APLIUT 2018</a>
				</p>
			</div>
			<div class="logos">
				<p><img src="../images/glassite-logo.png"><br />
					S3E3
				</p>
			</div>
			<div class="credits">
				<p>© 40ème Congrès de l'APLIUT 2018 - Tous droits réservés</p>
			</div>
		</footer>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script type="text/javascript" src="../js/jquery-2-1-4-min.js"></script>
		<script type="text/javascript" src="../js/menu.js"></script>
		<script type="text/javascript" src="../js/bootstrap.js"></script>

	</body>
	</html>
<?php
	}
?>
