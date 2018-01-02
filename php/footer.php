
<!-- Liens pratiques -->
<div class="lienspratiques">
	<li>	<a href="./partenaires.php">Partenaires</a></li>
	<span class="separator-v" display="inline-block"></span>
	<li><a href="sponsor.php">Sponsors</a></li>
	<span class="separator-v" display="inline-block"></span>
	<li><a href="mentions.php">Mentions légales</a></li>
</div>
<div class="credits">
	<p>© 40ème Congrès de l'APLIUT 2018 - Tous droits réservés</p>
</div>
<div class="partenaires container">
	<div class=''>
	<?php
	include("connexion.php");
	$res = $db->prepare('SELECT * from partenaires where choix="p"');
	$res->execute();

	?><h3>Partenaires du Congrès</h3> <?php
	//Affichage de tout les partenaires dans le footer
	while($data = $res->fetch()) {
		?>
			<img src="<?php echo $data['photoP'];?>" width='auto' height="100px" style="margin-left:10px;"/>
		<?php
	}
	?>
	<br/>
</div>
