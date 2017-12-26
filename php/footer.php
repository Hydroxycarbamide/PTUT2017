

<div class="lienspratiques">
	<li><a href="../admin/choixSponsorPartenaire.php">Partenaires</a></li>
	<span class="separator-v" display="inline-block"></span>
	<li><a href="mentions.php">Mentions légales</a></li>
</div>
<div class="credits">
	<p>© 40ème Congrès de l'APLIUT 2018 - Tous droits réservés</p>
	<p>Créé par Glassite</p>
</div>
<div class="partenaires container">
	<div class=''>
	<?php
	include("connexion.php");
	$res = $db->prepare('SELECT * from partenaires where choix="p"');
	$res->execute();

	?><h3>Partenaires du Congrès</h3> <?php
	while($data = $res->fetch()) {
		?>
			<img src="<?php echo $data['photoP'];?>" width='auto' height="100px" style="margin-left:10px;"/>
		<?php
	}


	$res = $db->prepare('SELECT * from partenaires where choix="s"');
	$res->execute();

	?><h3>Sponsors du Congrès</h3><?php
	while($data = $res->fetch()) {
		?>
			<img src="<?php echo $data['photoP'];?>" width='auto' height="100px" style="margin-left:10px;"/>
		<?php
	}
	 ?>
	</div>
	<br/>
</div>
