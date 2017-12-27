<?php
session_start();
require("../php/connexion.php");
if (isset($_SESSION['id']) and isset($_SESSION['pseudo']) and isset($_SESSION['nom']) and isset($_SESSION['prenom'])) {
    ?>
    <!-- EN-TETE -->
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
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/mobile.css" media="screen and (max-width: 768px)"></link>
        <!-- ************************** -->
        <title>Session admin | Partenaires</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery-2-1-4-min.js"></script>
    </head>
    <header>
        <?php
        include('menu.php'); 						// Importation du menu
        include('../php/convertirDate.php');		     // Importation de la fonction de convertion de date
        include('../php/reponse_formulaire.php');	     // Importation de la fonction de modification des images
        include('../php/convertirHoraire.php');		// Importation de la fonction de conversion d horaire
        ?>
    </header>
    <!DOCTYPE html>

        <body>
            <div class="page-principale page-principale-informationspratiques">

                <!-- GRAND TITRE -->
                <div class="conteneur conteneur-informationspratiques conteneur-informationspratiques-h1">
                    <h1>Partenaires et sponsors</h1>
                </div>
                <form action="partenaires.php" method="post">
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
        </body>
    </html>
    <!-- PIED DE PAGE -->


    <?php

}
else {
       echo "Redirection vers la page de connexion";
       header("Refresh:0;url=index.php");
   }
?>
