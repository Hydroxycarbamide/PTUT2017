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
	<title>Congrès APLIUT 2018 - Informations pratiques</title>
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
		include('php/reponse_formulaire.php');
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
				<li><a class="smenu s0menu accesiut" href="#accesiut">Accès à l'IUT</a></li>
				<li><a class="smenu s1menu hotels" href="#hotels">Hébergement</a></li>
				<li><a class="smenu s2menu restauration" href="#cocktails">Cocktail</a></li>
				<li><a class="smenu s3menu transports" href="#restauration">Diner</a></li>
				<li><a class="smenu s4menu transports" href="#marche">Marché des Produits Régionaux</a></li>
				<li><a class="smenu s5menu transports" href="#toulouse">A faire à Toulouse</a></li>
				<li><a class="smenu s6menu tourisme" href="#tourisme">Tourisme</a></li>
				<li><a class="smenu s7menu acceswifi" href="#acceswifi">Accès au WiFi</a></li>
				<li><a class="smenu s8menu chartes" href="#chartes">Charte de l'IUT et de l'UPS</a></li>
			</ul>
		</div>

		<!-- Accès IUT -->
		<div class="conteneur conteneur-informationspratiques conteneur-informationspratiques-div conteneur-informationspratiques-accesiut anchor" id="accesiut">
			<h2>Accès à l'IUT</h2>

			<?php
			$accesAIUT = $db->prepare('SELECT * FROM accesIUT ORDER BY idAcces;');
			$accesAIUT->execute();
			if($accesAIUT){
				$z = 0;?>
			<div class="conteneur-div filtre">
					<div class="panel-group present-text" id="accordion"><?php
			while ($allAccesIUT=$accesAIUT->fetch()) {
				$z++;
				?>
					<div class="panel panel-default ">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $z;?>" style="background:inherit" onMouseOver="$(this).css('font-weight', 'bold'); $(this).css('color', 'inherit');" onMouseOut="$(this).css('font-weight', 'normal');">
							<div class="panel-heading" style="background-color: #cac7ed">
			        	<h3 class="panel-title" style="text-align: center">
			          	<?php echo str_replace(array("\r\n","\n", '\n'),"<br />",explode(' :',$allAccesIUT['sousTitreAcces'])[0]); ?>
			        	</h3>
			      	</div>
						</a>

						<div id="collapse<?php echo $z;?>" class="panel-collapse collapse  <?php if($z==1){echo ' in';}?>">
			        <div class="panel-body">
								<p><?php echo str_replace(array("\r\n","\n", '\n'),"<br />",$allAccesIUT['texteAcces']); ?></p>
								<?php
								if($allAccesIUT['lien']!=''){
								?>
									<a class="lien-interne" href="<?php echo $allAccesIUT['lien']; ?>" target="_blank">Plus d'informations<span class="icon-circle-right"></span></a>
								<?php
								}
								?>

							</div>
			      </div>


						</div>
				<?php
			}?>
	</div>
</div><?php
		}
			$accesAIUT->closeCursor();
			?>

		</div>

		<span class="separerHorizontal"></span>

		<!-- Hotels -->
		<div class="conteneur conteneur-informationspratiques conteneur-informationspratiques-div conteneur-informationspratiques-hotels anchor" id="hotels">
			<h2>Hébergement</h2>
			<div class="container">
				<div class="present-text">
					<p>Nous vous conseillons de prendre un hôtel dans le centre-ville de Toulouse (Capitole, Wilson, Jean-Jaurès…) à proximité de la ligne de métro B (Jean-Jaurès, Jeanne d’Arc, Carmes…). Les transports en commun permettent de se rendre facilement à l'IUT, qui n'est pas en ville (15 minutes du centre-ville).</p>
					<p>Liste des hôtels à tarifs préférentiels avec pré-réservation d'un nombre de chambres (mentionnées ci-dessous).</p>
					<p>Signalez le code : APLIUT pour faire la réservation.</p>
				</div>

			</div>
			<?php
			$v_hotels = $db->prepare('SELECT * FROM hotels ORDER BY idH;');
			$v_hotels->execute();
			while ($allHotels=$v_hotels->fetch()) {
				?>
				<div class="conteneur-div filtre">
					<img src="<?php echo $allHotels['photoH']; ?>">
					<div class="present-text">
						<h3><?php echo $allHotels['nomH']; ?> <?php echo convertirNoteHotels($allHotels['noteH']); ?></h3>
						<p><?php echo $allHotels['adresseH']; ?><br />
							Tél. : <?php echo $allHotels['telH']; ?> – fax. <?php echo $allHotels['faxH']; ?><br />
							<?php echo $allHotels['descriptionH']; ?><br />
							<strong>Tarifs :</strong> <?php echo $allHotels['tarifH']; ?>
						</p>
						<a class="lien-interne" href="<?php echo $allHotels['lienH']; ?>" target="_blank">Plus d'informations<span class="icon-circle-right"></span></a>
					</div>
				</div>
				<?php
			}
			$v_hotels->closeCursor();
			?>
		</div>

		<span class="separerHorizontal"></span>
		<!-- Cocktails -->
		<div class="conteneur conteneur-informationspratiques conteneur-informationspratiques-div conteneur-informationspratiques-restauration anchor" id="cocktails">
			<h2>Cocktail</h2>
			<?php
			$v_restaurants = $db->prepare('SELECT * FROM restaurants WHERE choix="c" ORDER BY idR;');
			$v_restaurants->execute();
			while ($allRestaurants=$v_restaurants->fetch()) {
				?>
				<div class="conteneur-div filtre">
					<?php if(!is_null($allRestaurants['photoR'])){
						echo '<img src="'.$allRestaurants['photoR'].'">';
					} ?>

					<div class="present-text">
						<h3><?php echo $allRestaurants['nomR']; ?></h3>
						<p>
							<?php echo $allRestaurants['descriptionR']; ?><br/>
						</p>

					</div>
				</div>
				<?php
			}
			$v_restaurants->closeCursor();
			?>
	 	</div>
		<div class="conteneur conteneur-informationspratiques conteneur-informationspratiques-div conteneur-informationspratiques-restauration anchor" id="restauration">
			<h2>Diner</h2>
			<?php
			$v_restaurants = $db->prepare('SELECT * FROM restaurants WHERE choix="d" ORDER BY idR;');
			$v_restaurants->execute();
			while ($allRestaurants=$v_restaurants->fetch()) {
				?>
				<div class="conteneur-div filtre">
					<?php if(!is_null($allRestaurants['photoR'])){
						echo '<img src="'.$allRestaurants['photoR'].'">';
					} ?>

					<div class="present-text">
						<h3><?php echo $allRestaurants['nomR']; ?></h3>
						<p>
							<?php echo $allRestaurants['descriptionR']; ?><br/>
						</p>

					</div>
				</div>
				<?php
			}
			$v_restaurants->closeCursor();
			?>
		</div>

		<span class="separerHorizontal"></span>
		<!-- Marché des Produits Régionaux -->
		<div class="conteneur conteneur-informationspratiques conteneur-informationspratiques-div conteneur-informationspratiques-restauration anchor" id="marche">

			<h2>Marché des Produits Régionaux</h2>
			<?php
			$v_restaurants = $db->prepare('SELECT * FROM restaurants WHERE choix="m" ORDER BY idR;');
			$v_restaurants->execute();
			while ($allRestaurants=$v_restaurants->fetch()) {
				?>
				<div class="conteneur-div filtre">
					<?php if(!is_null($allRestaurants['photoR'])){
						echo '<img src="'.$allRestaurants['photoR'].'">';
					} ?>

					<div class="present-text">
						<h3><?php echo $allRestaurants['nomR']; ?></h3>
						<p>
							<?php echo $allRestaurants['descriptionR']; ?><br/>
						</p>

					</div>
				</div>
				<?php
			}
			$v_restaurants->closeCursor();
			?>
		</div>

		<span class="separerHorizontal"></span>
		<!-- A faire à Toulouse -->
		<div class="conteneur conteneur-informationspratiques conteneur-informationspratiques-div conteneur-informationspratiques-restauration anchor" id="toulouse">

			<h2>A faire à Toulouse</h2>
			<?php
			$v_restaurants = $db->prepare('SELECT * FROM restaurants WHERE choix="t" ORDER BY idR;');
			$v_restaurants->execute();
			while ($allRestaurants=$v_restaurants->fetch()) {
				?>
				<div class="conteneur-div filtre">
					<?php if(!is_null($allRestaurants['photoR'])){
						echo '<img src="'.$allRestaurants['photoR'].'">';
					} ?>

					<div class="present-text">
						<h3><?php echo $allRestaurants['nomR']; ?></h3>
						<p>
							<?php echo $allRestaurants['descriptionR']; ?><br/>
						</p>

					</div>
				</div>
				<?php
			}
			$v_restaurants->closeCursor();
			?>
		</div>


		<span class="separerHorizontal"></span>

			<!-- Tourisme -->
			<div class="conteneur conteneur-informationspratiques conteneur-informationspratiques-div conteneur-informationspratiques-tourisme anchor" id="tourisme">

				<h2>Tourisme</h2>
				<?php
				$v_tourisme = $db->prepare('SELECT * FROM tourisme ORDER BY idT;');
				$v_tourisme->execute();
				while ($allTourisme=$v_tourisme->fetch()) {
					?>
					<div class="conteneur-div filtre">


						<div class="present-text">

							<h3><?php
								if($allTourisme['lang']=="en"){
									echo '<img style="margin-right:5px; width:30px; height:24px; vertical-align:middle;" src="images/if_flag-united-kingdom_748024.png"></img>';
								}
								echo $allTourisme['titreT'];
								?>
							</h3>
							<?php if (!is_null($allTourisme['imageT'])){ ?>
								<img style="width:640px" src="<?php echo $allTourisme['imageT']; ?>">
							<?php }?>
							<?php if ($allTourisme['videoT'] != ""){ ?>
								<div>
									<iframe class="embed-responsive-item" width="640px" height="360px" src="https://www.youtube.com/embed/<?php echo $allTourisme['videoT']; ?>"allowfullscreen></iframe>
								</div>
							<?php } ?>

							<p>
								<?php echo $allTourisme['paragrapheT']; ?>
							</p>
							<?php
							if($allTourisme['lienT']!=''){
								?>
								<a class="lien-interne" href="<?php echo $allTourisme['lienT']; ?>" target="_blank">Plus d'informations<span class="icon-circle-right"></span></a>
								<?php
							} ?>
						</div>
					</div>
					<?php
				}
				$v_tourisme->closeCursor();
				?>
			</div>

			<span class="separerHorizontal"></span>

			<!-- Accès Wi-Fi -->
			<div class="conteneur conteneur-informationspratiques conteneur-informationspratiques-div conteneur-informationspratiques-acceswifi anchor" id="acceswifi">

				<h2>Accès au Wi-Fi</h2>
				<?php
				$v_wifi = $db->prepare('SELECT * FROM wifi ORDER BY idWifi;');
				$v_wifi->execute();
				while ($allWifi=$v_wifi->fetch()) {
					?>
					<div class="conteneur-div filtre">
						<div class="present-text">
							<p>
								<?php echo $allWifi['descriptionWifi']; ?>
							</p>

							<a class="lien-interne" href="<?php echo $allWifi['lienWifi']; ?>" target="_blank">Plus d'informations<span class="icon-circle-right"></span></a>
						</div>
					</div>
					<?php
				}
				$v_wifi->closeCursor();
				?>
			</div>

			<span class="separerHorizontal"></span>

			<!-- Charte de l'IUT -->
			<div class="conteneur conteneur-informationspratiques conteneur-informationspratiques-div conteneur-informationspratiques-chartes anchor" id="chartes">

				<h2>Charte de l'IUT et d'UPS</h2>
				<div class="conteneur-div filtre">
					<table class="table table-striped">
						<tr>
							<th>Titre du document</th>
							<th>Fichier</th>
						</tr>
						<?php
						$v_chartes = $db->prepare('SELECT * FROM chartes ORDER BY idCha;');
						$v_chartes->execute();
						while ($allChartes=$v_chartes->fetch()) {
							?>
							<tr>
								<td><?php echo $allChartes['descriptionCha']; ?></td>
								<td><a href="<?php echo $allChartes['lienCha']; ?>" target="_blank"><span class="glyphicon glyphicon-download-alt btn-pdf"></a></span></td>
							</tr>

						</p>
						<?php
					}
					$v_chartes->closeCursor();
					?>
				</table>
			</div>
		</div>

		<div id="topButton"><span class="glyphicon glyphicon-menu-up"></span></div>

	</div>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/colloque2018.js">
	</script>

	<!-- PIED DE PAGE -->
	<footer>
		<?php include('php/footer.php'); ?>
	</footer>

</body>
</html>
