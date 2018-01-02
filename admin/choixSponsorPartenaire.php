
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
			<title>Session admin | Partenaires</title>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
			<script type="text/javascript" src="js/jquery-2-1-4-min.js"></script>
            <?php
            if(isset($_POST['choix'])) {
                $choix = $_POST['choix'];
                if($choix == 'partenaire') { ?>
                    <meta http-equiv="refresh" content="0; URL=partenaires.php?choix='partenaire'">
                    <?php
                }
                if($choix == 'sponsor') { ?>
                    <meta http-equiv="refresh" content="0; URL=sponsor.php?choix='sponsor'">
                    <?php
                }
            } ?>
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
            <div class="page-principale page-principale-informationspratiques">

                <!-- GRAND TITRE -->
                <div class="conteneur conteneur-informationspratiques conteneur-informationspratiques-h1">
                    <h1>Partenaires et sponsors</h1>
                </div>
                <form action="#" method="post">
                    <fieldset class="container taille-min">
                        <legend>Voulez-vous modifier/ajouter sponsor ou partenaire ? </legend>
                        <div>
                            <input type="radio" id="sp_choice"
                            name="choix" value="sponsor" checked>
                            <label for="sp_choice">Sponsor</label>
                            <input type="radio" id="part_choice"
                            name="choix" value="partenaire">
                            <label for="part_choice">Partenaire</label>
                        </div>
                        <div>
                            <button type="submit">Envoyer</button>
                        </div>
                    </fieldset>

                </form>
            </div>
            <?php
        }
             ?>
        </body>
