<?php

function affichagePartenaires($choix){
    global $db;
    $resultats = $db->prepare('SELECT * FROM partenaires WHERE choix=:choix');
    $execute = $resultats->execute(array("choix"=>$choix));
    if(!$execute){
        echo "Erreur recherche partenaires";
    }
    while($row = $resultats->fetch()){
        echo '<div class="col-sm-6">';
        echo '<p style="text-align: center;">'.$row['nomP']."</p>";
        echo '<img src="'.$row['photoP'].'" style="height: 100px; width: auto; max-width:500px; display: block; margin-left: auto;margin-right: auto;" ><br/>';
        echo "</div>";
    }
}

?>
