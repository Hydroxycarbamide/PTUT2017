
<?php

	# Connexion	à la BDD
try{
	$db= new PDO('mysql:host=localhost;dbname=Colloque2018-b;charset=UTF8', 'ptute3b', 'Mdp2ptute3b-2017');
}
catch(exeption $e){
	die('Erreur : ' . $e->getMessage());
}

include('traitementconnexion.php');
?>
