<?php
// Permet de gérer l'affichage du programme
function afficherProgramme(){

    global $db;
    $req = $db->prepare("SELECT interrupteur FROM configs WHERE nom = 'afficherProgramme'");
    $req->execute();
    $bool = $req->fetch();
    if($bool['interrupteur'] == 1){
        ?>
            <a href="colloque2018.php#programme" >
              <strong><p style="color:#6B63CA;font-size:large;">Programme</p></strong>
            </a>
        <?php
    } else {
        ?>
          <strong><p style="color:#6B63CA; font-size:large;">Programme bientot disponible</p></strong>
        <?php
    }
}

function afficherProgrammeColloque(){
    global $db;
    $req = $db->prepare("SELECT interrupteur FROM configs WHERE nom = 'afficherProgramme'");
    $req->execute();
    $bool = $req->fetch();
    if($bool['interrupteur'] == 1){

//CODE POUR TELECHARGER LE PRGRAMME EN PDF

      //$v_chartes = $db->prepare('SELECT * FROM plan;');
      //$v_chartes->execute();
      //while ($allChartes=$v_chartes->fetch()) {	?>
        <!--<p>Plan du colloque telechargeable au format PDF:
          <a href="<?php //echo $allChartes['lien']; ?>" target="_blank">
            <span class="glyphicon glyphicon-download-alt btn-pdf">
            </span>
          </a>
        </p>--><?php
      //}
      //$v_chartes->closeCursor();?>

      <table class="planing">
        <p>Survolez le planning avec la souris pour plus d'informations.</p>
        <tr><?php
          $chaqueJourDuCongres = $db->prepare('SELECT * FROM joursColloque');
          $chaqueJourDuCongres->execute();
          while ($trouverJour = $chaqueJourDuCongres->fetch()) {?>
            <th><?php echo convertirDate($trouverJour['dateColloque']); ?></th><?php
          }
          $chaqueJourDuCongres->closeCursor();?>
        </tr>
        <tr><?php
          $chaqueJourDuCongres->execute();
          while ($trouverJour = $chaqueJourDuCongres->fetch()) {?>
            <td><?php
              # Liste des ateliers du jour
              $ACEDuJour = $db->prepare('SELECT horaireA, salleA, titreA, 0 FROM ateliers WHERE dateA = :dateColloque UNION ALL SELECT horaireConf, salleConf, titreConf, 1 FROM conferences WHERE dateConf = :dateColloque ORDER BY horaireA');
              $ACEDuJour->execute(array("dateColloque" => $trouverJour['dateColloque']));
              while ($trouver = $ACEDuJour->fetch()) {?>
                <div data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="<?php echo $trouver['titreA'] ?>">
                <div class="une_liste <?php  if ($trouver['0'] == 1) { echo "une_conference";} else {echo "un_atelier";} ?>">
                  <p class="une_liste_details theme" title="<?php echo $trouver['titreA'] ?>"><strong><?php echo trim_text($trouver['titreA'], 50, $ellipses = true, $strip_html = true); ?></strong></p>
                  <p class="une_liste_details horaire"><?php echo trim_signum($trouver['horaireA']); ?></p>
                  <p class="une_liste_details salle"><?php echo ucfirst($trouver['salleA']); ?></p>
                </div>
                </div><?php
              } ?>
            </td><?php
          }
          $chaqueJourDuCongres->closeCursor();?>
        </tr>
      </table>

      <!-- SCRIPT POUR POPOVER (BOOTSTRAP) -->
      <script>
      $(document).ready(function(){
        $('[data-toggle="popover"]').popover();});
      </script><?php
    } else {?>
      <p class = "alert alert-warning">Le programme du colloque sera bientôt mis en ligne.</p><?php
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

          <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample1">Lire la suite</button>
          <div class="collapse" id="collapseExample1">
            <p><?php echo str_replace(array("\r\n","\n"),"<br/>",$texte); ?></p>
            <button type="button" class="btn btn-warning">Fermer</button>
          </div>

          <script>
          $(document).ready(function(){
            $(".btn-warning").click(function(){
              $(".collapse").collapse('hide');
            });
          });
          </script><?php

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
  									<td><a href="afficherPDF.php#page=6" Target="_blank"><?php echo $trouverEvenement['titreA'];?></a></td>
  									<td><?php echo ucfirst($trouverEvenement['salleA']); ?></td>
  									<td><?php echo ucfirst($trouverEvenement['responsableA']); ?></td>
  								</tr>
  						<?php	}
  							$ateliersDuJour->closeCursor();
  						?>
  					</table>
  			<?php	}
  				$chaqueJourDuCongres->closeCursor();
  			?>

  		</div>

    <?php
}

?>
