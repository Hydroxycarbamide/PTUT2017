
<!-- Liens pratiques de redirection vers partenaire et mentions légales -->
<div class="lienspratiques">
	<li>
	<a href="partenaires.php">Partenaires</a></li>
	<span class="separator-v" display="inline-block"></span>
	<li><a href="sponsor.php">Sponsors</a></li>
	<span class="separator-v" display="inline-block"></span>
	<li><a href="mentions.php">Mentions légales</a></li>
</div>
<br/>
<div class="partenaires container-fluid">
	<div class=''>
	<?php
	include("../php/connexion.php");
	$res = $db->prepare('SELECT * from partenaires where choix="p"');
	$res->execute();
	//Affichage des partenaires dans le footer
	//Si vous souhaitez arrondir les logos, ajoutez "border-radius:15px;" dans le style
	while($data = $res->fetch()) {
		?>
			<img src="<?php echo "../".$data['photoP'];?>" width='auto' height="65px" style="margin-left:10px; margin-bottom:10px;"/>
		<?php
	}
	 ?>
	</div>
	<div class="credits">
		<p>© 40<sup>e</sup> Congrès de l'APLIUT 2018 - Tous droits réservés</p>
	</div>
</div>
