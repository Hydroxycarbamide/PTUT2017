<?php
function afficherProgramme(){                                                       // Permet de gérer l'affichage du programme
    global $db;                                                                     //Variable nous connectant a la BD (voir "connexion.php")

    $req = $db->prepare("SELECT interrupteur FROM configs WHERE nom = 'afficherProgramme'");
    $req->execute();
    $bool = $req->fetch();                                                          //Recuperation de la variable booleenne qui determine si l'administrateur a masqué l'affichage du programme ou pas

    if($bool['interrupteur'] == 1){?>                                               <!--SI 1 alors le programme s'affiche-->
      <a href="colloque2018.php#programme" >                                        <!--Lien vers le planning de colloques2018.php-->
        <strong><p style="color:#6B63CA;font-size:large;">Programme</p></strong>    <!--Affiche un titre cliquable-->
      </a><?php
    } else {?>
      <strong>
        <p style="color:#6B63CA; font-size:large;">Programme bientôt disponible</p> <!--Affiche un titre NON cliquable-->
      </strong><?php
    }
}



function afficherProgrammeColloque(){                                               // Permet de gérer l'affichage du planning
  global $db;                                                                     //Variable nous connectant a la BD (voir "connexion.php")

  $req = $db->prepare("SELECT interrupteur FROM configs WHERE nom = 'afficherProgramme'");
  $req->execute();
  $bool = $req->fetch();                                                          //Recuperation de la variable booleenne qui determine si l'administrateur a masqué l'affichage du programme ou pas

  if($bool['interrupteur'] == 1){                                                 //SI 1 alors le programme s'affiche?>

    <p>Programme téléchargeable au format PDF:
<!--Icone renvoyant vers le pdf contennant le planning-->
      <a href="images/programme.pdf" target="_blank">
        <span class="glyphicon glyphicon-download-alt btn-pdf">
        </span>
      </a>
    </p>

<!--PLANNING-->
    <table class="planing">
      <p><i>Survolez le planning avec la souris pour voir le titre de la communication en entier.</i></p>
        <tr><?php
          $chaqueJourDuCongres = $db->prepare('SELECT * FROM joursColloque');     //Recuperer les 3 jours du congres dans la BD
          $chaqueJourDuCongres->execute();
          while ($trouverJour = $chaqueJourDuCongres->fetch()) {                  //Utiliser ces 3 jours comme entete de Planning (3 colonnes)
            echo '<th>'.convertirDate($trouverJour['dateColloque']).'</th>';
          }
          $chaqueJourDuCongres->closeCursor();?>
        </tr>

        <tr><?php
          $chaqueJourDuCongres->execute();
          while ($trouverJour = $chaqueJourDuCongres->fetch()) {?>
            <td><?php
//Liste des ateliers et conferences du jour
              $ACEDuJour = $db->prepare('SELECT horaireA, salleA, titreA,responsableA, 0 FROM ateliers WHERE dateA = :dateColloque
                                        UNION ALL
                                        SELECT horaireConf, salleConf, titreConf,idIntervenant, 1 FROM conferences WHERE dateConf = :dateColloque ORDER BY horaireA');
              $ACEDuJour->execute(array("dateColloque" => $trouverJour['dateColloque']));
//Afficher les ateliers et conferences
              while ($trouver = $ACEDuJour->fetch()) {?>
                <!--Mise en place du POPOVER qui affiche le titre complet au survol-->
                <div data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="<?php echo $trouver['titreA'] ?>">
                  <div class="une_liste <?php  if ($trouver['0'] == 1) { echo "une_conference";} else {echo "un_atelier";} ?>">
                    <p class="une_liste_details theme" title="<?php echo $trouver['titreA'] ?>"
                    style="font-size:large">                                        <!--Afficher le titre raccourcis (remplace la suite par "...")-->
                      <?php echo trim_text($trouver['titreA'], 50, $ellipses = true, $strip_html = true); ?>
                    </p>
                    <p>
                        <?php echo trim_text($trouver['responsableA'], 30,$ellipses = true, $strip_html = true); ?>
                    </p>
                    <p class="une_liste_details">                           <!--Afficher l'horaire-->
                      <?php echo "<i>".trim_signum($trouver['horaireA'])."</i>";
                      echo " ".ucfirst($trouver['salleA']); ?>
                    </p>

                  </div>
                </div><?php
              } ?>
            </td><?php                                                               //Fin de l'affichage de chaque case du planning
          }
          $chaqueJourDuCongres->closeCursor();?>
        </tr>
      </table>

<!-- SCRIPT POUR POPOVER (BOOTSTRAP) -->
      <script>
      $(document).ready(function(){
        $('[data-toggle="popover"]').popover();});
      </script><?php
    } else {    ?>

      <div class = "alert" style="background-color: #cac7ed; text-align:center;">
        <p>Le programme définitif du congrès sera bientôt mis en ligne. </p>
        <p>Pré-programme téléchargeable au format PDF:
        <!--Icone renvoyant vers le pdf contennant le planning-->
        <a href="images/programme.pdf" target="_blank">
          <span class="glyphicon glyphicon-download-alt btn-pdf">
          </span>
        </a>
      </p>
      </div><?php
    }
  }


// Afficher les parties de présentation
function afficherPresentation(){
    global $db;
    ?>
    <!-- PRÉSENTATION -->
    <div class="conteneur conteneur-colloque conteneur-colloque-presentation"><?php
      $presentationIntro = $db->prepare('SELECT * FROM presentationColloque');
      $presentationIntro->execute();
      while ($pres = $presentationIntro->fetch()) {		?>
        <h2><?php echo str_replace(array("\r\n","\n"),"<br/>",$pres['sousTitrePC']); ?></h2><?php
        if(strlen($pres['textePC'])>=300){
          $phrase= explode(". ", $pres['textePC']);
          $texte= substr($pres['textePC'],strlen($phrase[0])+1,strlen($pres['textePC']));	?>

          <p><?php echo str_replace(array("\r\n","\n"),"<br/>",$phrase[0]); echo "."; ?></p>

          <button class="btn btn-primary" type="button" data-toggle="collapse"
          data-target="#<?php echo $pres['idPC']; ?>" aria-expanded="false"
          aria-controls="collapseExample1">Lire la suite</button>

          <div class="collapse" id="<?php echo $pres['idPC']; ?>">
            <p><?php echo str_replace(array("\r\n","\n"),"<br/>",$texte); ?></p>
            <button type="button" class="btn btn-warning" id="fermer<?php echo $pres['idPC']; ?>">Fermer</button>
            <script>
            $(document).ready(function(){
              $("#fermer<?php echo $pres['idPC']; ?>").click(function(){
                $("#<?php echo $pres['idPC']; ?>").collapse('hide');
              });
            });
            </script>
          </div><?php
        }else{	?>
          <p><?php echo str_replace(array("\r\n","\n"),"<br/>",$pres['textePC']); ?></p><?php
        }
      }//Fin While
      $presentationIntro->closeCursor();?>
    </div>
    <?php
}


// Afficher les conférenciers
function afficherConferenciers(){
    global $db;
    ?>
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

                        <div class = 'panel-heading'>
                            <button class='btn' data-toggle="modal" data-target="#modalIntervenant<?php echo $resConf['id'] ?>">Afficher la biographie</button>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="modalIntervenant<?php echo $resConf['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h5 class="modal-title"><b><?php echo $resConf['prenom']." ".$resConf['nom']; ?></b></h5>

                                </div>
                                <div class="modal-body">
                                    <img src="<?php echo $resConf['photo']; ?>" class="conferencies-photo"><br>
                                    <p><?php echo $resConf['biographie'] ?></p>
                                </div>
                                <div class="modal-footer">

                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                          </div>
                        </div>

                    </div>
                </figcaption>
            </figure>
            <?php
        }
        ?>
    </div>
    <?php
}


// Afficher les conférences
function afficherConferences(){
    global $db;
    ?>

    <!-- CONFÉRENCES -->
    <div class="conteneur conteneur-colloque conteneur-colloque-conferences" id="conferences">
        <h2>Conférences</h2>
        <?php

        $chaqueJourDuCongres = $db->prepare('SELECT * FROM joursColloque');
        $chaqueJourDuCongres->execute();
        while ($trouverJour = $chaqueJourDuCongres->fetch()) {
            ?>
            <h3><?php echo convertirDate($trouverJour['dateColloque']); ?></h3>
            <table class="table table-striped planing">
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
                            <td class="t_max_titre"><a href="#" data-toggle="modal" data-target="#modalConf<?php echo $trouverEvenement['idConf'] ?>"><?php echo $trouverEvenement['titreConf']; ?></a></td>
                            <td class="t_max_salle"><?php echo ucfirst($trouverEvenement['salleConf']); ?></td>
                            <td class="t_max_responsable"><?php echo ucfirst($trouverEvenement['idIntervenant']); ?></td>

                            <!-- Modal -->
                            <div class="modal fade" id="modalConf<?php echo $trouverEvenement['idConf'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h5 class="modal-title"><b><?php echo $trouverEvenement['titreConf']; ?></b></h5>
                                    <br>
                                    <p><b>Horaire : </b><?php echo trim_signum($trouverEvenement['horaireConf']); ?></p>
                                    <p><b>Salle : </b><?php echo ucfirst($trouverEvenement['salleConf']); ?></p>
                                    <p><b>Conférencier(s) : </b><?php echo ucfirst($trouverEvenement['idIntervenant']); ?></p>

                                  </div>
                                  <div class="modal-body">
                                    <?php echo $trouverEvenement['descriptionConf']; ?>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                  </div>
                                </div>
                              </div>
                            </div>


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
    <?php
}

// Afficher les Ateliers
function afficherAteliers(){
    global $db;

    ?>
    <!-- ATELIERS -->
  		<div class="conteneur conteneur-colloque conteneur-colloque-ateliers" id="ateliers">
  			<h2>Ateliers</h2>
  			<?php
                $req = $db->prepare("SELECT interrupteur FROM configs WHERE nom = 'afficherProgramme'");
                $req->execute();
                $bool = $req->fetch();
                if($bool['interrupteur'] == 1){

  				$chaqueJourDuCongres = $db->prepare('SELECT * FROM joursColloque');
  				$chaqueJourDuCongres->execute();

  				while ($trouverJour = $chaqueJourDuCongres->fetch()) {	?>
  					<h3><?php echo convertirDate($trouverJour['dateColloque']); ?></h3>
  					<table class="table table-striped planing">
  						<tr>
  							<th>Heures</th>
  							<th>Ateliers</th>
  							<th>Salle</th>
  							<th>Intervenant(s)</th>
  						</tr>
  						<?php
  	//Liste des ATELIERS du jour
  							$ateliersDuJour = $db->prepare('SELECT * FROM ateliers WHERE dateA = :dateColloque ORDER BY horaireA ASC');
  							$ateliersDuJour->execute(array("dateColloque" => $trouverJour['dateColloque']));
  							while ($trouverEvenement = $ateliersDuJour->fetch()){	?>
  								<tr>
  									<td width="10%"><?php echo ucfirst($trouverEvenement['horaireA']); ?></td>
  									<td><a href="#" data-toggle="modal" data-target="#modalAtelier<?php echo $trouverEvenement['idA'] ?>"><?php echo $trouverEvenement['titreA'];?></a></td>
  									<td><?php echo ucfirst($trouverEvenement['salleA']); ?></td>
  									<td><?php echo ucfirst($trouverEvenement['responsableA']); ?></td>

                    <!-- Modal -->
                    <div class="modal fade" id="modalAtelier<?php echo $trouverEvenement['idA'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                            <h5 class="modal-title"><b><?php echo $trouverEvenement['titreA']; ?></b></h5>
                            <br>
                            <p><b>Horaire : </b><?php echo trim_signum($trouverEvenement['horaireA']); ?></p>
                            <p><b>Salle : </b><?php echo ucfirst($trouverEvenement['salleA']); ?></p>
                            <p><b>Responsable(s) : </b><?php echo ucfirst($trouverEvenement['responsableA']); ?></p>

                          </div>
                          <div class="modal-body">
                            <?php echo $trouverEvenement['descriptionA']; ?>
                          </div>
                          <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                          </div>
                        </div>
                      </div>
                    </div>

  								</tr>
  						<?php	}
  							$ateliersDuJour->closeCursor();
  						?>
  					</table>
  			<?php	}
  				$chaqueJourDuCongres->closeCursor();
                }else{
                    ?>
                    <p class = "alert" style="background-color: #cac7ed;"> Indisponible
                      <!--Icone renvoyant vers le pdf contennant le planning-->
                    </p>
                    <?php
                }
  			?>

  		</div>

    <?php


}

?>
