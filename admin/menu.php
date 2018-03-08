<nav id="themenu" class="navbar navbar-default navbar-admin navbarBlue" role="navigation">
	<div class="container-fluid">
		<!-- LOGO -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="profil.php">
				<p class="p_logo"><span class="glyphicon glyphicon-user" style="margin-right: 10px;"></span><?php echo $_SESSION['nom']; ?></p>
				<!--img alt="40e Congrès de l'APLIUT" class="nav-logo" src="images/apliut-logo.jpg"-->
			</a>
		</div>

		<!-- MENU DE NAVIGATION -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="navbar-nav" id="bs-example-navbar-collapse-1">
				<li class="active"><a href="accueil.php">Accueil<span class="sr-only">(current)</span></a></li>
				<li class="dropdown">
					<a href="colloque2018.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Congrès APLIUT 2018<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="colloque2018.php#presentation">Présentation</a></li>
						<li><a href="colloque2018.php#conferencies">Conférenciers</a></li>
						<li><a href="colloque2018.php#conferences">Conférences</a></li>
						<li><a href="colloque2018.php#programme">Ateliers</a></li>
					</ul>
				</li>
				<li><a href="inscription.php">Inscription</a></li>
				<li class="dropdown">
					<a href="infoP.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Informations pratiques<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="infoP.php#">Accès à l'IUT</a></li>
						<li><a href="infoP.php#hotels" >Hébergement</a></li>
						<li><a href="infoP.php#cocktails">Cocktails</a></li>
						<li><a href="infoP.php#restauration">Diner</a></li>
						<li><a href="infoP.php#marche">Marché Régional</a></li>
						<li><a href="infoP.php#toulouse">A faire à Toulouse</a></li>
						<li><a href="infoP.php#tourisme">Tourisme</a></li>
						<li><a href="infoP.php#acceswifi">Accès au Wi-Fi</a></li>
						<li><a href="infoP.php#chartes">Charte de l'IUT et d'UPS</a></li>
					</ul>
				</li>
				<li><a href="contact.php">Contact</a></li>
			</ul>
		</div><!-- /.navbar-collapse -->
		<a class="btn-deconnect" href="../php/deconnexion.php"><span class="glyphicon glyphicon-log-out"></span></a>
	</div><!-- /.container-fluid -->
</nav>
