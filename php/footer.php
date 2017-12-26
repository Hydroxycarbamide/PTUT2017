<div class="lienspratiques">
	<li><a href="partenaires.php">Partenaires</a></li>
	<span class="separator-v" display="inline-block"></span>
	<li><a href="mentions.php">Mentions légales</a></li>
</div>
<div class="credits">
	<p>© 40ème Congrès de l'APLIUT 2018 - Tous droits réservés</p>
	<p>Créé par Glassite</p>
</div>
<div class="partenaires container">
	<h3>Partenaires du Congrès</h3>
	<div class=''>
	<?php
	include("connexion.php");
	$res = $db->prepare('SELECT * from partenaires');
	$res->execute();


	while($data = $res->fetch()) {
	?>

	<img src="<?php echo $data['photoP'];?>" width='auto' height="100px" style="margin-left:10px;"/>
	<!--<p><?php echo $data['nomP']; ?></p>-->

	<?php
	}
	?>
	</div>
	<br/>
</div>
