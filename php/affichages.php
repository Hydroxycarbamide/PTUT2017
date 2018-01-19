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
?>
