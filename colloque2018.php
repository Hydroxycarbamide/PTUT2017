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
		include('php/trim_text.php')
        ?>
	</header>

	<!-- PAGE PRINCIPALE -->
	<div class="page-principale page-colloque">

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

			// Ancienne partie 2016
            /*while ($pres = $presentationIntro->fetch()) {
                ?>
				<h2><?php echo str_replace(array("\r\n","\n"), "<br/>", $pres['sousTitrePC']); ?></h2>
				<?php	if ($pres['idPC']==3) {} else {
                ?>
					<p><?php echo str_replace(array("\r\n","\n"), "<br/>", $pres['textePC']); ?></p>
					<?php
                }
            }

            $presentationIntro->closeCursor();
            if (isset($_POST['lirePlus'])) {
                $lettreDeCadrage = $db->prepare('SELECT textePC FROM presentationColloque WHERE idPC=:id');
                $lettreDeCadrage->execute(array('id'=>'3'));
                $LC=$lettreDeCadrage->fetch(); ?>				<p><?php echo str_replace(array("\r\n","\n"), "<br/>", $LC[0]); ?></p>
				<?php
            } else {
                    $lettreDeCadrage = $db->prepare('SELECT textePC FROM presentationColloque WHERE idPC=:id');
                    $lettreDeCadrage->execute(array('id'=>'3'));
                    $LC=$lettreDeCadrage->fetch(); ?>					<form action="colloque2018.php" method="post">
					<div style="overflow:hidden; height:50px;">
						<p><?php echo str_replace(array("\r\n","\n"), "<br/>", $LC['textePC']); ?></p>
					</div>
					<button type="submit" name="lirePlus">Lire la suite</button>
				</form>
				<?php
			}*/

			//Affichage Simple
			/*while ($pres = $presentationIntro->fetch()){
				echo "<h2>".str_replace(array("\r\n","\n"),"<br/>",$pres['sousTitrePC'])."</h2>";
				echo "<p>".str_replace(array("\r\n","\n"),"<br/>",$pres['textePC'])."</p>";
			}*/

			//Panneaux
			while ($pres = $presentationIntro->fetch()){
				echo "<div class='panel-group'>";
				echo "<div class='panel panel-default'>";
				echo "<div class = 'panel-heading'>";
					echo "<a data-toggle='collapse' href='#".$pres['idPC']."'><h2 class='panel-title' '>".str_replace(array("\r\n","\n"),"<br/>",$pres['sousTitrePC'])."</h2></a>
				</div>";

				//echo '<button type="button" class="btn btn-default" data-toggle="collapse" data-target="#'.$pres['idPC'].'">Lire</button>';
				echo "<div id=".$pres['idPC']." class = 'panel-collapse collapse in'>
					<div class='panel-body'>".str_replace(array("\r\n","\n"),"<br/>",$pres['textePC'])."</div></div>";
				echo "</div>";
				echo "</div>";
			}
            ?>
		</div>

					<span class="separerHorizontal"></span>

					<!-- CONFÉRENCIÉS -->
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
										<h4 class="conferencies-h4">Biographie</h4>
										<p class="conferencies-biographie"><?php echo str_replace(array('\r\n','\n'), '<br/>', $resConf['biographie']); ?></p>
									</div>
								</figcaption>
							</figure>
							<?php
                        }
                        ?>
					</div>

					<span class="separerHorizontal"></span>

					<!-- PROGRAMME -->
					<div class="conteneur conteneur-colloque conteneur-colloque-programme" id="programme">
						<h2>Programme du colloque</h2>
						<!-- Planing -->
						<table class="planing">
							<tr>
								<?php
                                $chaqueJourDuCongres = $db->prepare('SELECT * FROM joursColloque');
                                $chaqueJourDuCongres->execute();
                                while ($trouverJour = $chaqueJourDuCongres->fetch()) {
                                    ?>
									<th><?php echo convertirDate($trouverJour['dateColloque']); ?></th>
									<?php
                                }
                                $chaqueJourDuCongres->closeCursor();
                                ?>
							</tr>
							<tr>
								<?php
                                $ateliersDuJour = $db->prepare('SELECT * FROM ateliers WHERE dateA = :dateColloque ORDER BY horaireA ASC');
                                $conferencesDuJour = $db->prepare('SELECT * FROM conferences WHERE dateConf = :dateColloque ORDER BY horaireConf ASC');
                                $evenementsDuJour = $db->prepare('SELECT * FROM evenements WHERE dateEvent = :dateColloque ORDER BY horaireEvent ASC');
                                $chaqueJourDuCongres->execute();
                                while ($trouverJour = $chaqueJourDuCongres->fetch()) {
                                    ?>
									<td>
									<?php

                            		# Liste des ateliers du jour
									$ACEDuJour = $db->prepare('SELECT horaireA, salleA, titreA, 0 FROM ateliers WHERE dateA = :dateColloque UNION ALL SELECT horaireConf, salleConf, titreConf, 1 FROM conferences WHERE dateConf = :dateColloque ORDER BY horaireA');
									$ACEDuJour->execute(array("dateColloque" => $trouverJour['dateColloque']));
                                    while ($trouver = $ACEDuJour->fetch()) {
                                        ?>
											<div class="une_liste
											<?php
											if($trouver['0'] == 1)
											echo "une_conference";
											else echo "un_atelier";
											?>
											">
												<p class="une_liste_details theme" title="<?php echo $trouver['titreA'] ?>"><strong><?php echo trim_text($trouver['titreA'],50, $ellipses = true, $strip_html = true); ?></strong></p>
												<p class="une_liste_details horaire"><?php echo $trouver['horaireA']; ?></p>
												<p class="une_liste_details salle"><?php echo ucfirst($trouver['salleA']); ?></p>
											</div>
											<?php
                                    }
                                    ?>
									</td>
									<?php
                                }
                                $chaqueJourDuCongres->closeCursor();
                                ?>
							</tr>
						</table>
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
											<td><?php echo ucfirst($trouverEvenement['horaireA']); ?></td>
											<td><a href="afficherPDF.php#page=6" Target="_blank"><?php echo $trouverEvenement['titreA']; ?></a></td>
											<td><?php echo ucfirst($trouverEvenement['salleA']); ?></td>
											<td><?php echo ucfirst($trouverEvenement['responsableA']); ?></td>
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
                                $conferencesDuJour = $db->prepare('SELECT * FROM conferences, intervenants WHERE conferences.idIntervenant = intervenants.id AND dateConf = :dateColloque ORDER BY horaireConf ASC');
                            $conferencesDuJour->execute(array("dateColloque" => $trouverJour['dateColloque']));
                            while ($trouverEvenement = $conferencesDuJour->fetch()) {
                                ?>
									<tr>
										<?php
                                        if (!empty($conferencesDuJour)) {
                                            ?>
											<td><?php echo ucfirst($trouverEvenement['horaireConf']); ?></td>
											<td><a href="afficherPDF.php#page=6" Target="_blank"><?php echo $trouverEvenement['titreConf']; ?></a></td>
											<td><?php echo ucfirst($trouverEvenement['salleConf']); ?></td>
											<td><?php echo ucfirst($trouverEvenement['nom']); ?></td>
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
