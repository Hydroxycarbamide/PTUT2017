<?php
// Fonction permettant d'échanger un élément par son suivant
function swaptodown($id){
    global $db;
    $searchNext = $db->prepare('SELECT idPC FROM presentationColloque WHERE idPC > :id ORDER BY idPC LIMIT 1');
    $err = $searchNext->execute(array('id'=>$id));
    if(!$err){
        echo 'Echec de la sélection du suivant';
    } else {
        $row = $searchNext->fetch();
        $next = $row['idPC'];
        //Update par le suivant par un dummy
        $res = $db->prepare('UPDATE presentationColloque as t, presentationColloque as t2
            SET t.idPC =  -1
            WHERE t.idPC = :next');
        $err = $res->execute(array('next'=>$next));
        if(!$err){
            echo "Echec de l'échange du dummy";
        }
        //Update le courant
        $res = $db->prepare('UPDATE presentationColloque as t, presentationColloque as t2
            SET t.idPC = :next
            WHERE t.idPC = :id');
        $err = $res->execute(array('id'=>$id,
                                    'next'=>$next));
        if(!$err){
            echo "Echec de l'échange du courant";
        }
        //Update le suivant
        $res = $db->prepare('UPDATE presentationColloque as t, presentationColloque as t2
            SET t.idPC = :id
            WHERE t.idPC = -1');
        $err = $res->execute(array('id'=>$id));
        if(!$err){
            echo "Echec de l'échange du suivant";
        }
    }
}

// Fonction permettant d'échanger un élément par son précédant
function swaptoup($id){
    global $db;
    $searchPrevious = $db->prepare('SELECT idPC FROM presentationColloque WHERE idPC < :id ORDER BY idPC DESC LIMIT 1');
    $err = $searchPrevious->execute(array('id'=>$id));
    if(!$err){
        echo 'Echec de la sélection du précédent';
    } else {
        $row = $searchPrevious->fetch();
        $previous = $row['idPC'];
        //Update par le précedent par un dummy
        $res = $db->prepare('UPDATE presentationColloque as t, presentationColloque as t2
            SET t.idPC =  -1
            WHERE t.idPC = :previous');
        $err = $res->execute(array('previous'=>$previous));
        if(!$err){
            echo "Echec de l'échange du dummy";
        }
        //Update le courant
        $res = $db->prepare('UPDATE presentationColloque as t, presentationColloque as t2
            SET t.idPC = :previous
            WHERE t.idPC = :id');
        $err = $res->execute(array('id'=>$id,
                                    'previous'=>$previous));
        if(!$err){
            echo "Echec de l'échange du courant";
        }
        //Update le précédent
        $res = $db->prepare('UPDATE presentationColloque as t, presentationColloque as t2
            SET t.idPC = :id
            WHERE t.idPC = -1');
        $err = $res->execute(array('id'=>$id));
        if(!$err){
            echo "Echec de l'échange du suivant";
        }
    }
}
/*


SELECT * FROM images WHERE image_id < 3 ORDER BY image_id DESC LIMIT 1 -- Previous
SELECT * FROM images WHERE image_id > 3 ORDER BY image_id LIMIT 1 -- Next


*/
?>
