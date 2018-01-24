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
				<div class="conteneur conteneur-colloque conteneur-colloque-presentation">
					<?php

						$presentationIntro = $db->prepare('SELECT * FROM presentationColloque');
						$presentationIntro->execute();
						while ($pres = $presentationIntro->fetch()) {		?>

							<h2><?php echo str_replace(array("\r\n","\n"),"<br/>",$pres['sousTitrePC']); ?></h2>

							<?php	if($pres['idPC']==3){
									$lettreDeCadrage = $db->prepare('SELECT textePC FROM presentationColloque WHERE idPC=:id');
									$lettreDeCadrage->execute(array('id'=>'3'));
									$LC=$lettreDeCadrage->fetch();

									$phrase= explode(". ", $LC[0]);
									$texte= substr($LC[0],strlen($phrase[0])+1,strlen($LC[0]));	?>

									<p><?php echo str_replace(array("\r\n","\n"),"<br/>",$phrase[0]); echo "."; ?></p>

									<button class="btn btn-primary btn-lg" type="button" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample1">Lire la suite</button>
						 			<button type="button" class="btn btn-warning btn-lg">Fermer</button>
		  							<div class="collapse" id="collapseExample1">
										<p><?php echo str_replace(array("\r\n","\n"),"<br/>",$texte); ?></p>
		  							</div>

									<script>
										$(document).ready(function(){
		    									$(".btn-warning").click(function(){
		        									$(".collapse").collapse('hide');
		   									});
										});
									</script>


							<?php	}else{	?>
									<p><?php echo str_replace(array("\r\n","\n"),"<br/>",$pres['textePC']); ?></p>
							<?php	}
						}//Fin While
						$presentationIntro->closeCursor();
					?>
				</div>

				<span class="separerHorizontal"></span>




			<?php	afficherPresentation();	?>
			<span class="separerHorizontal"></span>

			<?php	afficherConferences(); ?>
			<span class="separerHorizontal"></span>

			<?php	afficherConferenciers();	?>
			<span class="separerHorizontal"></span>

			<?php	afficherAteliers();	?>
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
