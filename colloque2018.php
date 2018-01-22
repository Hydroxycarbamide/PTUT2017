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
	<title>Congrès APLIUT 2018 - 40ème édition</title>
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
		include('php/trim_text.php');
		include('php/affichages.php');
		$ateliersDuJour = $db->prepare('SELECT * FROM ateliers WHERE dateA = :dateColloque ORDER BY horaireA, responsableA ASC');
		$conferencesDuJour = $db->prepare('SELECT * FROM conferences WHERE dateConf = :dateColloque ORDER BY horaireConf ASC');
		$evenementsDuJour = $db->prepare('SELECT * FROM evenements WHERE dateEvent = :dateColloque ORDER BY horaireEvent ASC');
		?>
	</header>

	<!-- PAGE PRINCIPALE -->
	<div class="page-principale page-colloque">
		<div id="push" style="padding-top:60px;"></div>
		<!-- GRAND TITRE -->
		<div class="conteneur conteneur-colloque conteneur-colloque-h1">
			<h1>Congrès de l'APLIUT 2018</h1>
			<h1 class="sous-h1">40ème édition</h1>
		</div>

		<!-- PRÉSENTATION -->
		<div class="conteneur conteneur-colloque conteneur-colloque-presentation" id="presentation">
			<?php

			$presentationIntro = $db->prepare('SELECT * FROM presentationColloque');
			$presentationIntro->execute();

			//Panneaux
			while ($pres = $presentationIntro->fetch()) {
				echo "<div class='panel-group'>";
				echo "<div class='panel panel-default'>";
				echo "<div class = 'panel-heading'>";
				echo "<a data-toggle='collapse' href='#presentation".$pres['idPC']."'><h4>".str_replace(array("\r\n","\n"), "<br/>", $pres['sousTitrePC']." ▼")."</h4></a>
				</div>";

				echo "<div id=presentation".$pres['idPC']." class = 'panel-collapse collapse'>";
				echo "<div class='panel-body'>";
				if (!is_null($pres['video'])) {
					echo "<div class='embed-responsive embed-responsive-16by9'>";
					echo "<video class='embed-responsive-item' src='".$pres['video']."' controls preload='none'></video>";
					echo "</div>";
				}

				if (!is_null($pres['lien'])) {
					echo "<div class='embed-responsive embed-responsive-16by9'>";
					echo "<iframe class='embed-responsive-item' src='https://www.youtube.com/embed/".$pres['lien']."'></iframe>";
						echo "</div>";
					}
					echo str_replace(array("\r\n","\n"), "<br/>", $pres['textePC'])."</div></div>";
					echo "</div>";
					echo "</div>";
				}
				?>
			</div>

			<span class="separerHorizontal"></span>

			<!-- CONFÉRENCES -->
			<div class="conteneur conteneur-colloque conteneur-colloque-conferences" id="conferences">
				<h2>Conférences</h2>
				<?php
				$chaqueJourDuCongres = $db->prepare('SELECT * FROM joursColloque');
				$chaqueJourDuCongres->execute();
				while ($trouverJour = $chaqueJourDuCongres->fetch()) {
					?>
					<h3><?php echo convertirDate($trouverJour['dateColloque']); ?></h3>
					<table class="table table-striped">
						<tr>
							<th>Heures</th>
							<th>Conférence</th>
							<th>Salle</th>
							<th>Intervenant(s)</th>
						</tr>
						<?php
						# Liste des conférences du jour
						$conferencesDuJour = $db->prepare('SELECT * FROM conferences WHERE dateConf = :dateColloque ORDER BY horaireConf ASC');
						$conferencesDuJour->execute(array("dateColloque" => $trouverJour['dateColloque']));
						while ($trouverEvenement = $conferencesDuJour->fetch()) {
							?>
							<tr>
								<?php
								if (!empty($conferencesDuJour)) {
									?>
									<td class="t_max_horaire"><?php echo trim_signum($trouverEvenement['horaireConf']); ?></td>
									<td class="t_max_titre"><a href="afficherPDF.php#page=6" Target="_blank"><?php echo $trouverEvenement['titreConf']; ?></a></td>
									<td class="t_max_salle"><?php echo ucfirst($trouverEvenement['salleConf']); ?></td>
									<td class="t_max_responsable"><?php echo ucfirst($trouverEvenement['idIntervenant']); ?></td>
									<?php
								} else {
									?>
									<td><p class="grise">Aucune conférence pour ce jour</p></td>
									<?php
								} ?>
							</tr>
							<?php
						}
						$conferencesDuJour->closeCursor(); ?>
					</table>
					<?php
				}
				$chaqueJourDuCongres->closeCursor();
				?>

			</div>



			<span class="separerHorizontal"></span>
			<!-- CONFÉRENCIERS -->
			<div class="conteneur conteneur-colloque conteneur-colloque-conferencies" id="conferencies">
				<h2>Conférenciers</h2>
				<?php
				$conferencies = $db->prepare('SELECT * FROM intervenants ORDER BY nom, prenom;');
				$conferencies->execute();
				while ($resConf = $conferencies->fetch()) {
					?>

					<figure class="conferencies-fig">
						<img src="<?php echo $resConf['photo']; ?>" class="conferencies-photo conferencies-photo1">
						<figcaption>
							<div class="figcaption-div figcaption-div-gauche">
								<h4 class="conferencies-h4">Nom</h4><p class="figcaption-p-info conferencies-nom"><?php echo $resConf['nom']; ?></p>
							</div>
							<div class="figcaption-div figcaption-div-droite">
								<h4 class="conferencies-h4">Prénom</h4><p class="figcaption-p-info conferencies-prenom"><?php echo $resConf['prenom']; ?></p>
							</div>
							<div class="figcaption-div">

								<?php echo "<div class = 'panel-heading'>";

								echo "<a data-toggle='collapse' href='#intervenants".$resConf['id']."'><h4 class='conferencies-h4' '>".str_replace(array("\r\n","\n"), "<br/>", "Afficher la biographie ▼")."</h2></a>
								</div>";

								//echo '<button type="button" class="btn btn-default" data-toggle="collapse" data-target="#'.$pres['idPC'].'">Lire</button>';
								echo "<div id=intervenants".$resConf['id']." class = 'panel-collapse collapse '>
								<div class='conferencies-biographie'>".str_replace(array("\r\n","\n"), "<br/>", $resConf['biographie'])."</div></div>"; ?>

							</div>
						</figcaption>
					</figure>
					<?php
				}
				?>
			</div>


			<span class="separerHorizontal"></span>

			<!-- ATELIERS -->
			<div class="conteneur conteneur-colloque conteneur-colloque-ateliers" id="ateliers">
				<h2>Ateliers</h2>
				<?php
				$chaqueJourDuCongres = $db->prepare('SELECT * FROM joursColloque ORDER BY dateColloque');
				$chaqueJourDuCongres->execute();
				while ($trouverJour = $chaqueJourDuCongres->fetch()) {
					?>
					<h3><?php echo convertirDate($trouverJour['dateColloque']); ?></h3>
					<table class="table table-striped">
						<tr>
							<th>Heures</th>
							<th>Ateliers</th>
							<th>Salle</th>
							<th>Intervenant(s)</th>
						</tr>
						<?php
						# Liste des ateliers du jour
						$ateliersDuJour->execute(array("dateColloque" => $trouverJour['dateColloque']));
						while ($trouverEvenement = $ateliersDuJour->fetch()) {
							?>
							<tr>
								<td class="t_max_horaire"><?php echo trim_signum($trouverEvenement['horaireA']); ?></td>
								<td class="t_max_titre"><a href="afficherPDF.php#page=6" Target="_blank"><?php echo $trouverEvenement['titreA']; ?></a></td>
								<td class="t_max_salle"><?php echo ucfirst($trouverEvenement['salleA']); ?></td>
								<td class="t_max_responsable"><?php echo ucfirst($trouverEvenement['responsableA']); ?></td>
							</tr>
							<?php
						}
						$ateliersDuJour->closeCursor(); ?>
					</table>
					<?php
				}
				$chaqueJourDuCongres->closeCursor();
				?>

			</div>

			<span class="separerHorizontal"></span>

			<!-- PROGRAMME -->
			<div class="conteneur conteneur-colloque conteneur-colloque-programme" id="programme">
				<h2>Programme du colloque</h2>
				<!-- Planing -->
				<?php afficherProgrammeColloque(); ?>
		</div>

		<span class="separerHorizontal"></span>

		<div id="topButton"><span class="glyphicon glyphicon-menu-up"></span></div>

	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery-2-1-4-min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/colloque2018.js"></script>

	<!-- PIED DE PAGE -->
	<footer>
		<?php include('php/footer.php'); ?>
	</footer>

</body>
</html>
