
<?php

	# Connexion	à la BDD
try{
	$db= new PDO('mysql:host=localhost;dbname=Colloque2018-b;charset=UTF8', 'root');
}
catch(exeption $e){
	die('Erreur : ' . $e->getMessage());
}

include('traitementconnexion.php');
?>
