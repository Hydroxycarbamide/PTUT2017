<?php
session_start();
require("../php/connexion.php");
if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']) AND isset($_SESSION['nom']) AND isset($_SESSION['prenom']))
{
	?>
	<!DOCTYPE html>
	<html lang="fr">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
		<!-- FEUILLES DE STYLE -->
		<link rel="icon" type="text/css" href="../images/favicon.ico"></link>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"></link>
		<link rel="stylesheet" type="text/css" href="../css/style.css"></link>
		<link rel="stylesheet" type="text/css" href="../css/carrousel.css"></link>
		<link rel="stylesheet" type="text/css" href="../css/menu.css"></link>
		<link rel="stylesheet" type="text/css" href="../css/footer.css"></link>
		<link rel="stylesheet" type="text/css" href="../css/main.css"></link>
		<!-- STYLE DU RESPONSIVE DESIGN -->
		<link rel="stylesheet" type="text/css" href="../css/max1630px.css" media="screen and (min-width: 1445px) and (max-width: 1630px)"></link>
		<link rel="stylesheet" type="text/css" href="../css/max1445px.css" media="screen and (min-width: 1280px) and (max-width: 1445px)"></link>
		<link rel="stylesheet" type="text/css" href="../css/max1280px.css" media="screen and (min-width: 1032px) and (max-width: 1280px)"></link>
		<link rel="stylesheet" type="text/css" href="../css/max1032px.css" media="screen and (min-width: 768px) and (max-width: 1032px)"></link>
		<link rel="stylesheet" type="text/css" href="../css/mobile.css" media="screen and (max-width: 768px)"></link>
		<!-- ************************** -->
		<title>Session admin | Partenaires</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery-2-1-4-min.js"></script>
	</head>
	<body>
		<!-- EN-TETE -->
		<header>
			<?php
			include('menu.php'); 						// Importation du menu
			include('../php/convertirDate.php');		// Importation de la fonction de convertion de date
			include('../php/reponse_formulaire.php');	// Importation de la fonction de modification des images
			?>
		</header>
		
		<!-- PAGE PRINCIPALE -->
		<div class="page-principale">

			<!-- GRAND TITRE -->
			<div class="conteneur conteneur-colloque conteneur-colloque-h1">
				<h1>Partenaires</h1>
			</div>

			<!-- Partenaires -->
			<div class="conteneur conteneur-colloque conteneur-colloque-div" id="partenaires">
				<?php
				//selectionne tous les partenaires
				$allpartenaires= $db->prepare('SELECT * FROM partenaires');
				$allpartenairesExecute=$allpartenaires->execute();
				if(!$allpartenairesExecute){
					echo"<p> Erreur lors de la recherche des partenaires existants.</p>";
				}	
				
				//si on a appuyé sur le bouton modifier
				if(isset($_POST['modifierPartenaire'])) {
					//donne la possibilté de modifier les images et les noms des partenaires
					?>		<form method="post" action="partenaires.php" enctype="multipart/form-data"><!-- par default enctype  est de type tetxe. ici précise qu'il y a un fichier-->>
					<?php		$i=0;
					foreach($allpartenaires as $chaqueP){	
						?>				<input type="hidden" name="<?php echo 'id'.$i; ?>" value="<?php echo $chaqueP['idP']; ?>"><br/>
						<textarea cols="100" rows ="1"  name="<?php echo 'nom'.$i;?>"><?php echo $chaqueP['nomP'];?></textarea>	<br/>
						<input type="file" name="<?php echo 'imageModifiee'.$i; ?>"/><br/>
						<img src="<?php echo "../".$chaqueP['photoP'];?>"/><br/>
						<?php			$i++;
					}	
					?>  		 <button type="submit" name="EnregistrerPartenaire"> Enregistrer les partenaires</button>
				</form>
				<?php }
				else{
					//affiche normallement
					?>			<form method="post" action="partenaires.php">
					<?php			$i=0;
					foreach($allpartenaires as $chaqueP){
						?>				<input type="radio" name="PartenaireASupprimer" value="<?php echo $chaqueP[0];?>"/>
						<p> <img src="<?php echo "../".$chaqueP[1];?>"/> </p><br/>
						<p> <?php echo $chaqueP[2];?> </p>
						<?php					$i++;		
					}	
					?>				 <button type="submit" name="modifierPartenaire" >Modifier</button>
					<button type="submit" name="AjouterPartenaire" >Ajouter un partenaire</button>
					<button type="submit" name="SupprimerPartenaire" >Supprimer un partenaire</button>
				</form>		
				<?php	}
				//si on a cliqué sur "enregistrer les partenaires
				if(isset($_POST['EnregistrerPartenaire'])){
					//compte le nombre de partenaires
					$nombrePartenaire = $db->prepare('SELECT count(*)FROM partenaires');
					$nombrePartenaireExecute=$nombrePartenaire->execute();
					if(!$nombrePartenaireExecute){
						echo"<p> Erreur pour compter des partenaires existants.</p>";
					}	
					$nbPartenaires=$nombrePartenaire->fetch();
					//pour chaque partenaires
			$ChampsVides=0;//compte les champs vides
			$BienEnregistrerPartenaire=0;//compte le nombre de partenaires bien enregistrés
			for($i=0;$i<$nbPartenaires[0];$i++){
				$idPartenaire="id".$i;
				$nomPartenaire = "nom".$i;	
				//si les champs sont remplis	
				if(!empty($_POST[$nomPartenaire])){
						//modifie la BDD
					$modificationPartenaire = $db->prepare('UPDATE partenaires SET nomP = :nom WHERE idP = :id');
					$modP = $modificationPartenaire->execute(array(  "nom"	=> $_POST[$nomPartenaire],
						"id"	=> $_POST[$idPartenaire]));	
					
					if(!$modP){
						echo '<p>Erreur lors de la requête de modification</p>';
					}
					else{
							//si il y a une image à modifer
						$NomImageChoisie="imageModifiee".$i;
						$imaageChoisie=$_FILES[$NomImageChoisie];
						if($imaageChoisie['error']== 0){
								//verifie si contient .jpg
								$pattern='/(.jpg)$/i'; //$= oblige en fin de chaine./i indiférent à la casse
								if(preg_match($pattern,$imaageChoisie['name'])==1) {    //analyse le nom de l'image pour trouver $pattern. si oui  return 1
									//insérer l'image dans le dossier
									$nomP=str_replace(' ','',$_POST[$nomPartenaire]);//enlève les espaces dans le nom
									$nameImage="images/$nomP.jpg";//chemin de l'image
									$reussi=move_uploaded_file($imaageChoisie["tmp_name"],$nameImage);//télécharge l'image de l'utilisateur dans le dossier images en écrasant l'existante
									if(!$reussi){
										echo"<p>Erreur lors du téléchargement de l'image. Veuillez réessayer</p>";
									}
									else{
										//modifie dans la base de données
										$enregistrementImage = $db-> prepare('UPDATE partenaires SET photoP=:photo WHERE idP=:id ;');
										$BienEnregistrerImage=$enregistrementImage ->execute(array('photo'=>$nameImage,
											'id'=>$_POST[$idPartenaire]));		
										if($BienEnregistrerImage){
											$BienEnregistrerPartenaire++;
										}
										else{	
											echo"<p> Erreur lors de l'enregistrement de l'image dans la base de données.</p>";
										}
									}						
								}
								else{
									echo"Format de l'image incorrect. Le format doit être <b>JPG</b>.";
								}
							}
						}
					}
					else{
						$ChampsVides++;
					}
			}//fin for
			//si il y a au moins  des champs vides pour au moins  1 partenaire on affiche un message d'avertissement
			if($ChampsVides>0){
				echo '<p>Veuillez remplir les champs!</p>';
			}
			if($BienEnregistrerPartenaire==$nbPartenaires[0]){
				echo"<p> L'enregistrement à bien été effectué</p>";
				//rafraichir la page
				echo"<meta http-EQUIV=\"Refresh\" CONTENT=\"0; url=partenaires.php\"/>";
			}
	}	//fin bouton enregistrer


	if(isset($_POST['AjouterPartenaire'])){
		?>		<form action ="partenaires.php" method="post"  enctype="multipart/form-data"><!-- enctype par default tetxe. ici précise que il y a un fichier-->
		<INPUT TYPE="file" NAME="imageA"/>	<br/>
		<div class="figcaption-div figcaption-div-gauche">
			<h4 class="conferencies-h4">Nom</h4>
			<p class="figcaption-p-info conferencies-nom"> <textarea cols="20" rows ="1"  name="nomA"></textarea> </p>
		</div>
		<button type="submit" name="ajouterP">Enregistrer le partenaire</button> 				
	</form>
	<?php
}
if(isset($_POST['ajouterP'])){
	if(!empty($_POST["nomA"])){
			//si le partenaire n'existe pas déja . on insere dans BDD
		$partenaire=$db->prepare("SELECT * from partenaires WHERE nomP=:nom ");
		$RbienExec4=$partenaire->execute(array('nom'=>$_POST['nomA']));
		if($RbienExec4){
			if($partenaire->fetch()!=false){
				echo"<p>Un partenaire de ce nom existe déjà. veuillez réessayer avec un autre nom.</p> ";
			}
			else{						
					//insérer dans BDD	
					$nomP=str_replace(' ','',$_POST['nomA']);//enlève les espaces dans le nom
					$nameImage="images/$nomP.jpg";//chemin de l'image
					$ajouterligne = $db-> prepare('INSERT INTO partenaires(nomP,photoP) VALUES (:nom, :photo)');
					$RbienExec3=$ajouterligne->execute(array('nom'=>$_POST['nomA'],
						'photo'=>$nameImage));
					if(!$RbienExec3){
						echo"<p>Erreur lors de l'insertion du partenaire. Veuillez réessayer</p>";
					}
					else{	
						echo"<p>L'enregistrement des données à bien éré fait.</p>";
						//si il y a une image à ajouter
						if($_FILES['imageA']['error'] == 0){
							//verifie si contient .jpg/.gif/.png
							$pattern='/(.jpg)$/i'; //$= oblige en fin de chaine./i indiférent à la casse
							if(preg_match($pattern,$_FILES['imageA']['name'])==1) {    //preg_match :analyse le nom de l'image pour trouver $pattern. si oui  return 1
								//insérer l'image dans le dossier
								$reussi=move_uploaded_file($_FILES['imageA']["tmp_name"],$nameImage);//télécharge l'image de l'utilisateur dans le dossier images 
								//si le tranfert n'a pas reussi
								if(!$reussi){
									echo"Erreur lors du téléchargement de l'image. Veuillez réessayer";
								}
								else{
									echo"<p>L'enregistrement  de l'image à bien été effectué</p>";
										//recharger la page
									echo"<meta http-EQUIV=\"Refresh\" CONTENT=\"0; url=partenaires.php\">";
								}		
							}
							else{
								echo"Le format de l'image doit etre <n>JPG</b>.";		
							}
						}
					}
				}
			}
		}//fin if
		else{	
			echo"<p>Veuillez remplir le champ nom.</p>";
		}	
	}//fin  enregistrer d'ajouter
	if(isset($_POST['SupprimerPartenaire'])){
		if(!empty($_POST['PartenaireASupprimer'])){
					//chercher le chemin	de l'image
			$cheminP = $db-> prepare('SELECT photoP FROM partenaires WHERE idP=:id ');
			$cheminP->execute(array('id'=>$_POST['PartenaireASupprimer']));
			$cheminASupprimer=$cheminP->fetch();
					//Supprimer la ligne concernant le partenaire dans la BDD
			$SupprimerP = $db-> prepare('DELETE FROM partenaires WHERE idP=:id ');
			$BienSupprP=$SupprimerP->execute(array('id'=>$_POST['PartenaireASupprimer']));							
			if($BienSupprP){
				unlink($cheminASupprimer[0]);
				echo"<p> L'enregistrement à bien été supprimé.<br/></p>";
						//rafraichir la page
				echo"<meta http-EQUIV=\"Refresh\" CONTENT=\"0; url=partenaires.php\">";		
			}
			else{		
				echo"<p>Erreur lors de la suppression du partenaire dans la Base de données</p>";
			}	
		}//fin if	
		else{
			echo"<p>Veuiilez cocher un partenaire pour supprimer un partenaire</p>";
		}		
}// fin  bouton supprimer
?>

</div>
<script type="text/javascript" src="../js/menu.js"></script>
<script type="text/javascript" src="../js/bootstrap.js"></script>
<script type="text/javascript" src="../js/colloque2018.js"></script>

<!-- PIED DE PAGE -->
<footer>
	<?php include('../php/footer.php'); ?>
</footer>		

<body/>
<html/>
<?php
}
else {
	echo "Redirection vers la page de connexion";
	header("Refresh:0;url=index.php");
}
?>
