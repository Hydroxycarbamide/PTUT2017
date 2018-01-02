

<div class="lienspratiques">
	<li>
	<a href="
	<?php
	if(isset($_SESSION['id'])){
		echo "../admin/partenaires.php";
	}else{
		echo "./partenaires.php";
	}
	?>
	">Partenaires</a>
</li>
	<span class="separator-v" display="inline-block"></span>
	<li><a href="mentions.php">Mentions légales</a></li>
</div>
<div class="credits">
	<p>© 40ème Congrès de l'APLIUT 2018 - Tous droits réservés</p>
</div>
<div class="partenaires container">
	<div class=''>
	<?php
	include("../php/connexion.php");
	$res = $db->prepare('SELECT * from partenaires where choix="p"');
	$res->execute();

	?><h3>Partenaires du Congrès</h3> <?php
	while($data = $res->fetch()) {
		?>
			<img src="<?php echo "../".$data['photoP'];?>" width='auto' height="100px" style="margin-left:10px;"/>
		<?php
	}

	 ?>
	</div>
	<br/>
</div>
