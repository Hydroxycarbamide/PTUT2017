<!DOCTYPE html>
<html lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
  <!-- FEUILLES DE STYLE -->
  <link rel="icon" type="text/css" href="../img/favicon.ico">
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
  <title>Congrès APLIUT 2018 - Partenaires</title>
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

  <!-- PAGE PRINCIPAL -->
  <div class="page-principale">

    <!-- GRAND TITRE -->
    <div class="conteneur conteneur-mentions conteneur-mentions-h1">
      <h1>Partenaires</h1>
    </div>

    <!-- PARTENAIRES -->
    <div class="conteneur conteneur-mentions conteneur-mentions-presentation" id="mentions1">
     <h2> IUT Informatique Toulouse 3</h2>
     <p>L'IUT Informatique est un partenaire important bla bla  </p>

     <img src="">

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