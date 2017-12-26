<?php

function affichagePartenaires($choix){
    global $db;
    $resultats = $db->prepare('SELECT * FROM partenaires WHERE choix=:choix');
    $execute = $resultats->execute(array("choix"=>$choix));
    if(!$execute){
        echo "Erreur recherche partenaires";
    }
    while($row = $resultats->fetch()){
        echo "<div>";
        echo "<h3>".$row['nomP']."</h3>";
        echo "<img src='".$row['photoP']." 'width='300px' height='auto' >";
        echo "</div>";
    }
}

?>
