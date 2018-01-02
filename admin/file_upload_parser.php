<?php
$fileName = $_FILES["videoPC"]["name"]; // The file name
//$infosfichier = pathinfo($_FILES["videoPC"]['name']);
//$fileName = 'videoH'.md5(uniqid(rand(), true)).".".$infosfichier['extension'];
$fileTmpLoc = $_FILES["videoPC"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["videoPC"]["type"]; // The type of file it is
$fileSize = $_FILES["videoPC"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["videoPC"]["error"]; // 0 for false... and 1 for true

if (!$fileTmpLoc) { // if file not chosen
    echo "ERREUR: Recherchez un fichier avant d'appuyer sur upload";
    exit();
}
if(move_uploaded_file($fileTmpLoc, "../videos/$fileName")){
    echo "$fileName upload is complete";
} else {
    echo "move_uploaded_file function failed";
}
?>
