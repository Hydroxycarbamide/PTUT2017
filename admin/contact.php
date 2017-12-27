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
        ?>
    </header>
    <body>
        <div class="page-principale page-principale-contact">

    		<!-- GRAND TITRE -->
    		<div class="conteneur conteneur-contact conteneur-contact-h1">
    			<h1>Contact</h1>
    		</div>

            <div class="conteneur conteneur-contact conteneur-contact-presentation" id="presentation">
                <h2> Changer l'adresse mail receveur</h2>
                <p> Actuelle :
                <?php
                    $res = $db->prepare('SELECT mail FROM connexion WHERE pseudo=:pseudo');
                    $err = $res->execute(array(':pseudo'=>$_SESSION['pseudo']));
                    if(!$err){
                        echo "Adresse email actuellement inexistante";
                    } else {
                        $row = $res->fetch();
                        echo $row['mail'];
                    }

                ?>
                </p>
                <form action='Contact.php' method="post">
                    
                </form>

            </div>
        </div>

    </body>
    <footer>
    	<?php include('../php/footer.php'); ?>
    </footer>
<?php
} else {
        echo "Redirection vers la page de connexion";
        header("Refresh:0;url=index.php");
    }
?>
