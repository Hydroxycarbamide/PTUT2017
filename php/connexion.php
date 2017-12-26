
<?php

	# Connexion	à la BDD
try{
	$db= new PDO('mysql:host=localhost;dbname=Colloque2018-b;charset=UTF8', 'root');
}
catch(exeption $e){
	die('Erreur : ' . $e->getMessage());
}

?>
<?php
		# On vérifie si le pseudo et le mot de passe existent bien et s'ils sont bons
if (isset($_POST['connexion'])){

	if (!empty($_POST['pseudo']) || !empty($_POST['mdp'])) {

		$pseudo = $_POST['pseudo'];
		$mdp = $_POST['mdp'];

		$seco = $db->prepare('SELECT * FROM connexion WHERE pseudo = :pseudo AND mdp = :mdp');
		$seco->execute(array(
			"pseudo" => $pseudo,
			"mdp" => $mdp
			));

		$co = $seco->fetch();

		if (!$co){
			?>
			<div class="alert alert-danger">Veuillez entrer des informations correctes</div>
			<?php
		} else {

					# Création de la session 1
			$_SESSION['id'] = $co['id'];
			$_SESSION['pseudo'] = $co['pseudo'];
			$_SESSION['nom'] = $co['nom'];
			$_SESSION['prenom'] = $co['prenom'];
			?>
			<div class="alert alert-success">Vous vous êtes bien connecté !</div>
			<?php
			header("Refresh:2;url=accueil.php");
		}

	} else {
		?>
		<div class="alert alert-danger">Veuillez renseigner tous les champs</div>
		<?php		}
	}
	?>
