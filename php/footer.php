<div class="lienspratiques">
	<li><a href="partenaires.php">Partenaires</a></li>
	<span class="separator-v" display="inline-block"></span>
	<li><a href="mentions.php">Mentions légales</a></li>
</div>
<div class="credits">
	<p>© 40ème Congrès de l'APLIUT 2018 - Tous droits réservés</p>
	<p>Créé par Glassite</p>
</div>
<div class="partenaires">
	<h3>Partenaires du Congrès</h3>

	<?php
	include("connexion.php");
	$res = $db->prepare('SELECT * from partenaires');
	$res->execute();


	while($data = $res->fetch()) {
	?>

	<img src="<?php echo $data['photoP'];?>" width='300px' height="200px"/><br/>
	<p><?php echo $data['nomP']; ?></p>

	<?php
	}
	?>
