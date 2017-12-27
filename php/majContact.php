<?php
    if(isset($_POST['newmail'])&&isset($_SESSION['id'])){
        $res = $db->prepare('UPDATE connexion SET mail = :newmail WHERE id = :id');
        $res->execute(array(
            "newmail"=>$_POST['newmail'],
            "id"=>$_SESSION['id'])
        );
    }
?>
