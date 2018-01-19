<?php
// Permet de gérer l'affichage du programme
function afficherProgramme(){
    global $db;
    $req = $db->prepare("SELECT interrupteur FROM configs WHERE nom = 'afficherProgramme'");
    $req->execute();
    $bool = $req->fetch();
    if($bool['interrupteur'] == 1){
        ?>
        <p>Consultez le planing du congrès et son déroulement.</p>
        <?php
        # Affichage des dates du congrès
        $datesCongres2 = $db->prepare('SELECT * FROM joursColloque');
        $datesCongres2->execute();

        while ($chaqueDate2 = $datesCongres2->fetch()) {
            ?>
            <!-- Événement # -->
            <figure class="fig-img fig-img<?php echo $chaqueDate2['idColloque']; ?>">
                <figcaption><?php echo convertirDate($chaqueDate2['dateColloque']); ?></figcaption>
            </figure>
            <?php
        }


        $datesCongres2->closeCursor();
    } else {
        ?>
        <p class = "alert alert-warning"> Programme bientôt en ligne </p>
        <?php
    }
}

function afficherProgrammeColloque(){
    global $db;
    $req = $db->prepare("SELECT interrupteur FROM configs WHERE nom = 'afficherProgramme'");
    $req->execute();
    $bool = $req->fetch();
    if($bool['interrupteur'] == 1){
        $ateliersDuJour = $db->prepare('SELECT * FROM ateliers WHERE dateA = :dateColloque ORDER BY horaireA, responsableA ASC');
        $conferencesDuJour = $db->prepare('SELECT * FROM conferences WHERE dateConf = :dateColloque ORDER BY horaireConf ASC');
        $evenementsDuJour = $db->prepare('SELECT * FROM evenements WHERE dateEvent = :dateColloque ORDER BY horaireEvent ASC');
        ?>
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
                            if ($trouver['0'] == 1) {
                                echo "une_conference";
                            } else {
                                echo "un_atelier";
                            } ?>
                            ">
                                <p class="une_liste_details theme" title="<?php echo $trouver['titreA'] ?>"><strong><?php echo trim_text($trouver['titreA'], 50, $ellipses = true, $strip_html = true); ?></strong></p>
                                <p class="une_liste_details horaire"><?php echo trim_signum($trouver['horaireA']); ?></p>
                                <p class="une_liste_details salle"><?php echo ucfirst($trouver['salleA']); ?></p>
                            </div>
                            <?php
                        } ?>
                    </td>
                <?php
                }
            $chaqueJourDuCongres->closeCursor();
            ?>
            </tr>
        </table>
    <?php
    } else {
        ?>
        <p class = "alert alert-warning"> Programme bientôt en ligne </p>
        <?php
    }
}
?>
