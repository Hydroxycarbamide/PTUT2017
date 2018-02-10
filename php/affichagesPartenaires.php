<?php
  function affichagePartenaires($choix){                                              //Fonction affichant les partenaires et les sponsors
      global $db;                                                                     //Variable nous connectant a la BD (voir "connexion.php")
      $resultats = $db->prepare('SELECT * FROM partenaires WHERE choix=:choix');      //Requete recuperant les sponsors (choix=s) OU les partenanires (choix=p)
      $execute = $resultats->execute(array("choix"=>$choix));
      if(!$execute){                                                                  //SI n'est pas executée afficher un msg d'erreur
          echo "Erreur recherche partenaires";
      }else{                                                                          //SINON afficher les partenaires ou sponsors
        while($row = $resultats->fetch()){
            echo '<div class="col-sm-6">';                                            //Les afficher dans 2 colonnes (bootstrap) les titres et images
            //echo '<p style="text-align: center;">'.$row['nomP'].'</p>';               //Titre centré
            echo '<img src="'.$row['photoP'].'" style="height: 100px;                /*Hauteur de 100px*/
                                                width: auto;                         /*Largeur definie grace a la Hauteur*/
                                                max-width:500px;                     /*Mais la largeur ne doit pas depasser 500px*/
                                                margin-left: auto;                   /*Centrer limage (meme distance a gauche et a droite)*/
                                                margin-right: auto;
                                                margin-bottom:20px;                  /*Creer un espace apres chaque ligne*/" >';
            echo '</div>';
        }
      }
  }
?>
