<?php
session_start();
require("../php/connexion.php");
if (isset($_SESSION['id']) and isset($_SESSION['pseudo']) and isset($_SESSION['nom']) and isset($_SESSION['prenom'])) {
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
		<title>Session admin | Congrès APLIUT 2018</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script type="text/javascript" src="../js/jquery-2-1-4-min.js"></script>
	</head>
	<body>
		<!-- EN-TETE -->
		<header>
			<?php
            include('menu.php'); 						// Importation du menu
            include('../php/convertirDate.php');		     // Importation de la fonction de convertion de date
            include('../php/reponse_formulaire.php');	     // Importation de la fonction de modification des images
            include('../php/convertirHoraire.php');		// Importation de la fonction de conversion d horaire
            include('../php/swap.php');
            include('../php/trim_text.php');
            ?>
		</header>

		<!-- PAGE PRINCIPALE -->
		<div class="page-principale page-colloque">
            <div id="push" style="padding-top:60px;"></div>
			<!-- GRAND TITRE -->
			<div class="conteneur conteneur-colloque conteneur-colloque-h1">
				<h1>Congrès de l'APLIUT - 40ème édition</h1>
			</div>

			<!-- PRÉSENTATION -->
			<div class="conteneur conteneur-colloque conteneur-colloque-presentation" id="presentation">
				<h2>Présentation du 40e congrès de l'APLIUT </h2>

			<?php
                    $presentation = $db-> prepare('SELECT sousTitrePC,textePC,idPC,video,lien FROM presentationColloque;');
                    $presentationExecute=$presentation ->execute();
                    if (!$presentationExecute) {
                         echo"<p> Erreur lors de la recherche des textes existants</p>";
                    }
                    $presentationColloque=$presentation->fetchAll();

                    if (isset($_POST['SupprimerPresentation'])) {
                         if (!empty($_POST['PartieASupprimer'])) {
                              //Supprimer la ligne concernant la partie dans la BDD
                              $SupprimerPC = $db-> prepare('DELETE FROM presentationColloque WHERE idPC=:id ');
                              $BienSupprPC=$SupprimerPC ->execute(array('id'=>$_POST['PartieASupprimer']));
                              if ($BienSupprPC) {
                                   echo"<p> L'enregistrement à bien été supprimé.<br/></p>";
                                   //rafraichir la page
                                   echo"<META http-EQUIV=\"Refresh\" CONTENT=\"0; url=colloque2018.php#presentation\">";
                              } else {
                                   echo"<p>Erreur lors de la suppression de la partie dans la Base de données</p>";
                              }
                         }//fin if
                         else {
                              echo"<p>Veuillez cocher une partie</p>";
                         }
                    } // fin  bouton supprimer
                    // Echange avec la valeur du haut
                    if (isset($_POST['descendre'])) {
                        swaptodown($_POST['descendre']);
                        echo"<META http-EQUIV=\"Refresh\" CONTENT=\"0; url=colloque2018.php#presentation\">";
                    }
                    // Echange avec la valeur du haut
                    if (isset($_POST['monter'])) {
                        swaptoup($_POST['monter']);
                        echo"<META http-EQUIV=\"Refresh\" CONTENT=\"0; url=colloque2018.php#presentation\">";
                    }
                    if (isset($_POST['boutonModifPresentation'])) {
                    //affiche le texte en text area et un bouton enregistrer
                    ?>
                         <form action ="colloque2018.php#presentation" enctype="multipart/form-data" method="post">
		               <?php
                              $n=0;
                              foreach ($presentationColloque as $pre) { ?>
                              	<textarea cols="100" rows ="1"  name="<?php echo 'titremodifier'.$n; ?>"><?php echo "$pre[0]"; ?></textarea>
                                   <br/>
			                    <textarea cols="100" rows ="6"  name="<?php echo 'textemodifier'.$n; ?>"><?php echo "$pre[1]"; ?></textarea>
			                    <input type="hidden" name="<?php echo 'idPC'.$n; ?>" value="<?php echo $pre[2]; ?>"/>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">https://www.youtube.com/watch?v=</span>
                                        <input class="form-control" name="<?php echo 'Lien'.$n; ?>" value = "<?php echo $pre['lien']; ?>" placeholder="AABBccdd">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="file" class="form-control-file" name="<?php echo 'videoPC'.$n; ?>"/>
                                </div><br/>
			          <?php
                              $n++;
                              } ?>
		                    <br/><button class="btn btn-success" type="submit" name="enregistrerPresentation">Enregistrer</button>
	                    </form>
	                    <?php
                    } else {
                         //récupère toute la présentation du colloque?>
               		<form action="colloque2018.php#presentation" method="post" name="bouton">
	                         <button class="btn" type="submit" name="boutonModifPresentation">Modifier</button>
	                         <button class="btn btn-primary" type="submit" name="AjouterPresentation">Ajouter une partie</button>
	                         <button class="btn btn-danger" type="submit" name="SupprimerPresentation">Supprimer une partie</button><br/>
                             <br>
                             <?php
                             $presentationIntro = $db->prepare('SELECT * FROM presentationColloque');
                             $presentationIntro->execute();


                 			//Panneaux
                 			while ($pres = $presentationIntro->fetch()){
                 				echo "<div class='panel-group'>";
                 				echo "<div class='panel panel-default'>";
                 				echo "<div class = 'panel-heading'>";
                                ?>
                                    <input type="radio" name="PartieASupprimer" value= "<?php echo $pres['idPC']; ?>" />
                                    <button type="submit" class="btn" name="descendre" value="<?php echo $pres['idPC']; ?>">▼</button>
                                    <button type="submit" class="btn" name="monter" value="<?php echo $pres['idPC']; ?>">▲</button>
                                <?php
                 				echo "<h4><a data-toggle='collapse' href='#presentation".$pres['idPC']."'>".
                                    str_replace(array("\r\n","\n"),"<br/>",$pres['sousTitrePC']." ▼")."
                                </a></h4>
                 				</div>";

                 				echo "<div id=presentation".$pres['idPC']." class = 'panel-collapse collapse'>";
                 				echo "<div class='panel-body'>";
                 				if(!is_null($pres['video'])){
                 					echo "<div class='embed-responsive embed-responsive-16by9'>";
                 					echo "<video class='embed-responsive-item' src='../".$pres['video']."' controls preload='none'></video>";
                 					echo "</div>";
                 				}

                 				if(!is_null($pres['lien'])){
                 					echo "<div class='embed-responsive embed-responsive-16by9'>";
                 					echo "<iframe class='embed-responsive-item' src='https://www.youtube.com/embed/".$pres['lien']."'allowfullscreen></iframe>";
                 					echo "</div>";
                 				}
                 				echo str_replace(array("\r\n","\n"),"<br/>",$pres['textePC'])."</div></div>";
                 				echo "</div>";
                 				echo "</div>";
                 			}
                            ?>
                    </form>
                    <?php

                    }

                    //si on a appuyé sur le bouton enregistrer
                    if (isset($_POST['enregistrerPresentation'])) {
                         //compte le nombre de parties
                         $nombrePartie = $db-> prepare('SELECT count(*) FROM presentationColloque');
                         $nombrePartieExecute=$nombrePartie ->execute();
                         if ($nombrePartieExecute) {
                              $nbP=$nombrePartie->fetch();
                              for ($i=0;$i<$nbP[0];$i++) {
                                   $titre="titremodifier".$i;
                                   $texte="textemodifier".$i;
                                   $id="idPC".$i;
                                   $lien="Lien".$i;
                                   $Video="videoPC".$i;
                                   if(strlen($_POST[$lien])==0){
                                       $lienamodifier = NULL;
                                   } else {
                                       $lienamodifier = $_POST[$lien];
                                   }
                                   //modifie la BD avec le nouveau texte et la date
                                   $enregistrementPresentation = $db-> prepare('UPDATE presentationColloque SET sousTitrePC=:titre, textePC=:texte, lien=:lien WHERE idPC=:id');
                                   $enregistrementP =$enregistrementPresentation ->execute(array('titre'=>$_POST[$titre],
                                                                                                 'texte'=>$_POST[$texte],
                                                                                                 'id'=>$_POST[$id],
                                                                                                 'lien'=>$lienamodifier));

                                    if (!($_FILES[$Video]['size'] == 0))
                            		{

                            			$infosfichier = pathinfo($_FILES[$Video]['name']);
                            			$lienVideo = 'videos/videoH'.md5(uniqid(rand(), true)).".".$infosfichier['extension'];
                            			$loc = "../". $lienVideo;
                            			$resultat = move_uploaded_file($_FILES[$Video]['tmp_name'], $loc);
                                        $enregistrementVideo = $db->prepare('UPDATE presentationColloque SET video=:video WHERE idPC=:id');
                                        $enregistrementV = $enregistrementVideo->execute(array('id'=>$_POST[$id],
                                                                                                'video'=>$lienVideo));
                                        if (!$enregistrementP) {
                                             echo "<p>erreur d'enregistrement d'un fichier vidéo. veuillez réessayez</p>";
                                        }
                            		}


                                    //si il n'y a pas d'erreur dans l'enregistrement on affiche le nouveau texte
                                   if (!$enregistrementP) {
                                        echo "<p>erreur d'enregistrement. veuillez réessayez</p>";
                                   } else {
                                        $nouveautexte = $db->prepare('SELECT sousTitrePC,textePC FROM presentationColloque');
                                        $nouveautexteExecute = $nouveautexte->execute();
                                        if ($nouveautexteExecute) {
                                             while ($nouvText = $nouveautexte->fetch()) {
                                                  echo"<h3>".$nouvText[0]."</h3>
                    							<p>".$nouvText[1]."</p> <br/>";
                                             }
                                             echo"<p> Les modifications ont bien été faites.</p>";
                                             //rafraichir la page
                                             echo"<META http-EQUIV=\"Refresh\" CONTENT=\"0; url=colloque2018.php#presentation\">";
                                        } else {
                                             echo "<p>Erreur lors de la recherche des textes existants</p>";
                                        }
                                   }
                              }
                         }
                    }

                    if (isset($_POST['AjouterPresentation'])) {
                         ?>
               		<h3>Ajouter une partie</h3>
               		<form method="post" enctype="multipart/form-data" action="colloque2018.php#presentation">

                        <div class="form-group">
                            <label>Titre *</label>
                            <input type="texte" class="form-control" name="Titre" required>
                        </div>
                        <div class="form-group">
                            <label>Texte</label>
                            <textarea class="form-control" rows="3" name="Texte"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Fichier vidéo</label>
                            <input type="file" class="form-control-file" name="videoPC" id="videoPC"/>
                            <small id="passwordHelpInline" class="text-muted">
                            10Mo maximum. Retirez les caractères spéciaux s'il y en a. Contactez l'administrateur du serveur pour changer la taille maximum.
                        </small><br/>
                            <input type="button" value="Upload File" onclick="uploadFile()">
                            <progress id="progressBar" value="0" max="100" style="width:300px;"></progress>
                            <h3 id="status"></h3>
                            <p id="loaded_n_total"></p>
                        </div>
                        <div class="form-group">
                            <label>Lien YouTube</label>
                            <div class="input-group">
                                <span class="input-group-addon">https://www.youtube.com/watch?v=</span>
                                <input class="form-control" name="Lien" placeholder="AABBccdd">
                            </div>

                        </div>
               			<button class="btn btn-success" type="submit" name="EnregistrerNouvellePartie">Enregistrer la nouvelle partie</button>
               		</form>
               	<?php
                    }
                    if (isset($_POST['EnregistrerNouvellePartie'])) {
                        $Titre = $_POST['Titre'];
                        $Texte = $_POST['Texte'];
                        $Video = 'videoPC';
                        $Lien = $_POST['Lien'];
                        ajoutPartie($Titre, $Texte, $Video, $Lien);
                    }// fin  bouton enregistrer
                    ?>
               </div>
               <span class="separerHorizontal"></span>


               <!-- INTERVENANTS -->
               <div class="conteneur conteneur-colloque conteneur-colloque-conferencies" id="conferencies">
	               <h2>Intervenants</h2>
	               <?php
                    //selectionner tous les intervenants
                    $Intervenant = $db-> prepare('SELECT * FROM intervenants');
                    $IntervenantExecute=$Intervenant ->execute();
                    if (!$IntervenantExecute) {
                         echo"<p> Erreur lors de la recherche des Intervenants existants</p>";
                    }
                    $Intervenants=$Intervenant->fetchAll();
                    if (isset($_POST['ModifierIntervenant'])) {
                         //affiche le texte en text area et un boutton enregistrer?>
                         <form action ="colloque2018.php#conferencies" method="post"  enctype="multipart/form-data"><!-- enctype par default tetxe. ici précise que il y a un fichier-->
     		          <?php
                              $i=0;
                              foreach ($Intervenants as $data) {
                                   ?>
                                   <input TYPE="file" NAME="<?php echo'imageChoisie'.$i; ?>" />
                                   <br/>
          			          <img src="<?php echo '../'.$data[4]; ?>" class="conferencies-photo conferencies-photo1" width='200px' height="200px" />
          			          <input value="<?php echo $data[0]; ?>" name="<?php echo'id'.$i; ?>" type="hidden" />

          		 	          <div class="figcaption-div figcaption-div-gauche">
               				     <h4 class="conferencies-h4">Nom</h4>
               			     	<p class="figcaption-p-info conferencies-nom"> <input class="form-control"  name="<?php echo'nom'.$i; ?>" value = "<?php echo $data[1]; ?>"></textarea> </p>
          		          	</div>

                    			<div class="figcaption-div figcaption-div-droite">
                    				<h4 class="conferencies-h4">Prenom</h4>
                    				<p class="figcaption-p-info conferencies-prenom"> <input class="form-control" name="<?php echo'prenom'.$i; ?>" value = <?php echo $data[2]; ?>></p>
                    			</div>
                    			<div class="figcaption-div">
                    				<h4 class="conferencies-h4">Biographie</h4>
                    				<p class="conferencies-biographie"> <textarea cols="100" rows ="10"  name="<?php echo'des'.$i; ?>"><?php echo $data[3]; ?></textarea> </p>
                    			</div>
          			          <?php
                    		     $i++;
                              } ?>
          				<button class="btn btn-success" type="submit" name="EnregitrerIntervenant">Enregistrer</button>
     	               </form>
	               <?php
                    } else {
                    ?>



                        <form action ="colloque2018.php" method="post" >
                            <button class="btn" type="submit" name="ModifierIntervenant">Modifier</button>
                            <button class="btn btn-primary" type="submit" name="AjouterIntervenant">Ajouter un intervenant</button>
                            <button class="btn btn-danger" type="submit" name="SupprimerIntervenant">Supprimer un intervenant</button><br/>
                               <?php
                               $conferencies = $db->prepare('SELECT * FROM intervenants ORDER BY nom, prenom;');
                               $conferencies->execute();
                               while ($resConf = $conferencies->fetch()) { ?>

                                <figure class="conferencies-fig">
                                    <input type="radio" name="IntervenantASupprimer" value= "<?php echo $resConf['id']; ?>" />
                                    <img src=".<?php echo ($resConf['photo']); ?>" class="conferencies-photo conferencies-photo1">
                                    <figcaption>
                                        <div class="figcaption-div figcaption-div-gauche">
                                            <h4 class="conferencies-h4">Nom</h4><p class="figcaption-p-info conferencies-nom"><?php echo $resConf['nom']; ?></p>
                                        </div>
                                        <div class="figcaption-div figcaption-div-droite">
                                            <h4 class="conferencies-h4">Prénom</h4><p class="figcaption-p-info conferencies-prenom"><?php echo $resConf['prenom']; ?></p>
                                        </div>
                                        <div class="figcaption-div">

                                            <div class = 'panel-heading'>
                                                <a class='btn btn-default' data-toggle="modal" data-target="#modalIntervenant<?php echo $resConf['id'] ?>">Afficher la biographie</a>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="modalIntervenant<?php echo $resConf['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h5 class="modal-title"><b><?php echo $resConf['prenom']." ".$resConf['nom']; ?></b></h5>

                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="<?php echo "../".$resConf['photo']; ?>" class="conferencies-photo"><br>
                                                        <p><?php echo $resConf['biographie'] ?></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                    </div>
                                                </div>
                                              </div>
                                            </div>
                                        </div>

                                    </figcaption>
                                </figure>
                                <?php
                            } ?>
                         </form>
       		     </form>

			          <?php
                    }
                    if (isset($_POST['EnregitrerIntervenant'])) {
                         //compte le nombre d'intervenant
                         $nbI = $db-> prepare('SELECT count(*) FROM intervenants;');
                         $nbI ->execute();
                         $nbIntervenant = $nbI->fetch();
                         $BienEnregistrerIntervenant=0;
                         for ($i=0;$i<$nbIntervenant[0];$i++) {
                              $nom="nom".$i;
                              $prenom="prenom".$i;
                              $bio="des".$i;
                              $id="id".$i;

                              if (!empty($_POST[$nom]) && !empty($_POST[$prenom])) {
                                   //modifie la BD avec le nouveau texte pour chaque champ

                                   $enregistrement = $db-> prepare('UPDATE intervenants SET nom=:nom, prenom=:prenom, biographie=:bio WHERE id=:idi ;');
                                   $BienEnregistrerI=$enregistrement ->execute(array('nom'=>$_POST[$nom],
                                                                                     'prenom'=>$_POST[$prenom],
                                                                                     'bio'=>$_POST[$bio],
                                                                                     'idi'=>$_POST[$id]));
                                   if ($BienEnregistrerI) {
                                        //si il y a une image à modifer
                                        $NomImageChoisie="imageChoisie".$i;
                                        $imaageChoisie=$_FILES[$NomImageChoisie];
                                        if ($imaageChoisie['error']== 0) {
                                             //verifie si contient .jpg
                                             $pattern='/(.jpg)$/i'; //$= oblige en fin de chaine./i indiférent à la casse
                                             if (preg_match($pattern, $imaageChoisie['name'])==1) {    //analyse le nom de l'image pour trouver $pattern. si oui  return 1
                                                  //insérer l'image dans le dossier
                                                  $nameImage="./images/".$_POST[$prenom].$_POST[$nom].".jpg";
                                                  $reussi=move_uploaded_file($imaageChoisie["tmp_name"], "../".$nameImage);//télécharge l'image de l'utilisateur dans le dossier images en écrasant l'existante
                                                  if (!$reussi) {
                                                       echo"<p>Erreur lors du téléchargement de l'image. Veuillez réessayer</p>";
                                                  } else {
                                                       $enregistrementImage = $db-> prepare('UPDATE intervenants SET photo=:photo WHERE id=:idi ;');
                                                       $BienEnregistrerImage=$enregistrementImage ->execute(array('photo'=>$nameImage,
                                                                                                                   'idi'=>$_POST[$id]));
                                                       if ($BienEnregistrerImage) {
                                                            $BienEnregistrerIntervenant++;
                                                       } else {
                                                            echo"<p> Erreur lors de l'enregistrement de l'image dans la base de données.</p>";
                                                       }
                                                  }
                                             } else {
                                                  echo"Format de l'image incorrect. Le format doit être <b>JPG</b>.";
                                             }
                                        }
                                   } else {
                                        echo" <p>Erreur de l'enregistrement. veuillez reessayer.</p>";
                                   }
                              } else {
                                   echo"<p>veuillez remplir les champs nom et prenom.</p>";
                              }
                         }
                         if ($BienEnregistrerIntervenant==$nbIntervenant[0]) {
                              echo " <p>L'enregistrement à bien été effectué.</p>";
                              //recharger la page
                              echo"<META http-EQUIV=\"Refresh\" CONTENT=\"0; url=colloque2018.php#conferencies\">";
                         }
                    }
                    if (isset($_POST['AjouterIntervenant'])) {
                         ?>
                         <form action ="colloque2018.php#conferencies" method="post"  enctype="multipart/form-data"><!-- enctype par default tetxe. ici précise que il y a un fichier-->
     		               <input TYPE="file" NAME="imageA"/>	<br/>
     		               <div class="figcaption-div figcaption-div-gauche">
     			               <h4 class="conferencies-h4">Nom</h4>
     			               <p class="figcaption-p-info conferencies-nom"> <textarea cols="20" rows ="1"  name="nomA"></textarea> </p>
     		               </div>
                    		<div class="figcaption-div figcaption-div-droite">
                    			<h4 class="conferencies-h4">Prenom</h4>
                    			<p class="figcaption-p-info conferencies-prenom"> <textarea cols="20" rows ="1"  name="prenomA"></textarea> </p>
                    		</div>
                    		<div class="figcaption-div">
                    			<h4 class="conferencies-h4">Biographie</h4>
                    			<p class="conferencies-biographie"> <textarea cols="20" rows ="10"  name="desA"></textarea></p>
                    		</div>
     		               <button class="btn btn-success" type="submit" name="ajouterconf">Enregistrer conferencier</button>
	                    </form>
	                    <?php
                    }
                    if (isset($_POST['ajouterconf'])) {
                         if (!empty($_POST["nomA"]) && !empty($_POST["prenomA"])) {
                              //si l'internant existe pas déja . on insere dans BDD
                              $internant=$db->prepare("SELECT * from intervenants WHERE nom=:nom AND prenom=:prenom");
                              $RbienExec4=$internant->execute(array('nom'=>$_POST['nomA'],
                                                                    'prenom'=>$_POST['prenomA']));
                              if ($RbienExec4) {
                                   if ($internant->fetch()!=false) {
                                        echo"<p>Un intervenant de ce nom existe déjà. veuillez réessayer avec un autre nom.</p> ";
                                   } else {
                                        //insérer dans BDD
                                        $nameImage="./images/".$_POST['prenomA'].$_POST['nomA'].'.jpg';
                                        $ajouterligne = $db-> prepare('INSERT INTO intervenants(nom,prenom,biographie,photo) VALUES (:nom,:prenom, :bio, :photo)');
                                        $RbienExec3=$ajouterligne->execute(array('nom'=>$_POST['nomA'],
                                                                                 'prenom'=>$_POST['prenomA'],
                                                                                 'bio'=>$_POST['desA'],
                                                                                 'photo'=>$nameImage));
                                        if (!$RbienExec3) {
                                             echo"<p>Erreur lors de l'insertion du conferencier. Veuillez réessayer</p>";
                                        } else {
                                             echo"<p>L'enregistrement des données à bien éré fait.</p>";
                                             //si il y a une image à ajouter
                                             if ($_FILES['imageA']['error'] == 0) {
                                                  //verifie si contient .jpg/.gif/.png
                                                  $pattern='/(.jpg)$/i'; //$= oblige en fin de chaine./i indiférent à la casse
                                                  if (preg_match($pattern, $_FILES['imageA']['name'])==1) {    //preg_match :analyse le nom de l'image pour trouver $pattern. si oui  return 1
                                                       //insérer l'image dans le dossier
                                                       $reussi=move_uploaded_file($_FILES['imageA']["tmp_name"], "../".$nameImage.'.jpg');//télécharge l'image de l'utilisateur dans le dossier images
                                                       //si le tranfert n'a pas reussi
                                                       if (!$reussi) {
                                                            echo"Erreur lors du téléchargement de l'image. Veuillez réessayer";
                                                       } else {
                                                            echo"<p>L'enregistrement  de l'image à bien été effectué</p>";
                                                            //recharger la page
                                                            echo"<META http-EQUIV=\"Refresh\" CONTENT=\"0; url=colloque2018.php#conferencies\">";
                                                       }
                                                  } else {
                                                       echo"Le format de l'image doit etre <n>JPG</b>.";
                                                  }
                                             }
                                        }
                                   }
                              }
                         } else {
                              echo"<p>Veuillez remplir les champs nom et prenom.</p>";
                         }
                    }

                    if (isset($_POST['SupprimerIntervenant'])) {
                         if (!empty($_POST['IntervenantASupprimer'])) {
                              //Supprimer la ligne concernant l'internant dans la BDD
                              $SupprimerI = $db-> prepare('DELETE FROM intervenants WHERE id=:id ');
                              $BienSupprI=$SupprimerI->execute(array('id'=>$_POST['IntervenantASupprimer']));
                              if ($BienSupprI) {
                                   echo"<p> L'enregistrement à bien été supprimé.<br/></p>";
                                   //rafraichir la page
                                   echo"<META http-EQUIV=\"Refresh\" CONTENT=\"0; url=colloque2018.php#conferencies\">";
                              } else {
                                   echo"<p>Erreur lors de la suppression de l'intervenant dans la Base de données</p>";
                              }
                         }//fin if
                         else {
                              echo"<p>Veuillez cocher un internant</p>";
                         }
                    }// fin  bouton supprimer?>
		          <br/><span class="separerHorizontal"></span>

		          <!-- ATELIERS -->
                  <div class="" id="programme">
                      <h2>Ateliers</h2>
                      <?php
                      if (isset($_POST['modifierAteliers'])) {
                          //affiche le texte en text area et un boutton enregistrer
                          ?>
                          <!--<p>-->
                              <form action ="colloque2018.php#programme" method="post">
                                  <?php
                                  //selectionne les dates des Ateliers
                                  $dateAteliers = $db-> prepare('SELECT * FROM joursColloque');
                                  $dateAteliersExecute=$dateAteliers->execute();
                                  if (!$dateAteliersExecute) {
                                      echo"<p> Erreur lors de la recherche de la date des Ateliers existants</p>";
                                  } else {
                                      while ($dateAtelier= $dateAteliers->fetch()) {
                                          //selectionner tous les Ateliers avec la date $dateAtelier[1]
                                          $Atelier = $db-> prepare('SELECT horaireA, titreA, salleA, responsableA, descriptionA, idA FROM ateliers WHERE dateA=:date');
                                          $AtelierExecute=$Atelier ->execute(array('date'=>$dateAtelier[1]));
                                          if (!$AtelierExecute) {
                                              echo"<p> Erreur lors de la recherche des Ateliers existantes</p>";
                                          } else {
                                              ?>
                                              <h3><?php echo convertirDate($dateAtelier[1]); ?></h3>
                                              <table class="table table-striped">
                                                  <!--titre des colonnes-->
                                                  <tr>
                                                      <th>Horaire</th>
                                                      <th>Thème</th>
                                                      <th>Salle</th>
                                                      <th>Responsable</th>
                                                      <th>Description</th>
                                                  </tr>
                                                  <?php
                                                  $i=0;
                                                  while ($infoAtelier=$Atelier->fetch()) {
                                                      ?>
                                                      <tr>
                                                          <?php									$ligne="Ligne".$i.$dateAtelier[1]; ?>
                                                          <td><textarea cols="20" rows ="2"  name="<?php echo"textmodifier1".$ligne; ?>"><?php echo "$infoAtelier[0]"; ?></textarea></td>
                                                          <td><textarea cols="20" rows ="2"  name="<?php echo"textmodifier2".$ligne; ?>"><?php echo "$infoAtelier[1]"; ?></textarea></td>
                                                          <td><textarea cols="20" rows ="2"  name="<?php echo"textmodifier3".$ligne; ?>"><?php echo "$infoAtelier[2]"; ?></textarea></td>
                                                          <td><textarea cols="30" rows ="2"  name="<?php echo"textmodifier4".$ligne; ?>"><?php echo "$infoAtelier[3]"; ?></textarea></td>
                                                          <td><textarea cols="30" rows ="10"  name="<?php echo"textmodifier5".$ligne; ?>"><?php echo "$infoAtelier[4]"; ?></textarea></td>
                                                          <input type="hidden" name="<?php echo 'idA'.$ligne; ?>" value="<?php echo $infoAtelier[5]; ?>"/>
                                                      </tr>
                                                      <?php								$i++;
                                                  } ?>							</table>
                                                  <?php
                                              }
                                          }//fin while
                                      }//fin else
                                      ?>				<button class="btn btn-success" type="submit" name="EnregistrerAtelier">Enregistrer</button>
                                  </form>
                              </p>
                              <?php
            }//fin bouton modifier
else {
    ?>			<!--bouton modifier-->
	<form action ="colloque2018.php#programme" method="post"name="Ateliers">
		<button class="btn" type="submit" name="modifierAteliers">Modifier</button>
		<button class="btn btn-primary" type="submit" name="AjouterAtelier">Ajouter un atelier</button>
		<button class="btn btn-danger" type="submit" name="SupprimerAtelier">Supprimer un atelier</button>

<?php		//selectionne les dates des Ateliers
$dateAteliers = $db-> prepare('SELECT * FROM joursColloque');
    $dateAteliersExecute=$dateAteliers->execute();
    if (!$dateAteliersExecute) {
        echo"<p> Erreur lors de la recherche de la date des ateliers existants</p>";
    } else {
        while ($dateAtelier= $dateAteliers->fetch()) {
            //selectionner tous les ateliers avec la date $dateAtelier[1]
            $Atelier = $db-> prepare('SELECT * FROM ateliers WHERE dateA=:date');
            $AtelierExecute=$Atelier ->execute(array('date'=>$dateAtelier[1]));
            if (!$AtelierExecute) {
                echo"<p> Erreur lors de la recherche des ateliers existantes</p>";
            } else {
                ?>						<h3><?php echo convertirDate($dateAtelier[1]); ?></h3>
			<table class="table table-striped" >
				<!--titre des colonnes-->
				<tr>
					<th>Supprimer</th>
					<th>Horaire</th>
					<th>Thème</th>
					<th>Salle</th>
					<th>Responsable</th>
				</tr>
				<?php						while ($infoAtelier=$Atelier->fetch()) {
                    ?>							<tr>
					<td><input type="radio" name="AtelierASupprimer" value="<?php echo $infoAtelier[0]; ?>"/></td>
					<td><?php echo $infoAtelier[1]; ?></td>
					<td><?php echo"<a  href='#' data-toggle='modal' data-target='#modalAtelier".$infoAtelier['idA']."'>". $infoAtelier[4]."<a/>"; ?></td>
					<td><?php echo $infoAtelier[2]; ?></td>
					<td><?php echo str_replace(array("\r\n","\n"), "<br/>", $infoAtelier[6]); ?></td>

                    <!-- Modal -->
                    <div class="modal fade" id="modalAtelier<?php echo $infoAtelier['idA'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h5 class="modal-title"><b><?php echo $infoAtelier['titreA']; ?></b></h5>
                            <br>
                            <p><b>Horaire : </b><?php echo trim_signum($infoAtelier['horaireA']); ?></p>
                            <p><b>Salle : </b><?php echo ucfirst($infoAtelier['salleA']); ?></p>
                            <p><b>Responsable(s) : </b><?php echo ucfirst($infoAtelier['responsableA']); ?></p>

                          </div>
                          <div class="modal-body">
                            <?php echo $infoAtelier['descriptionA']; ?>
                          </div>
                          <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                          </div>
                        </div>
                      </div>
                    </div>
				</tr>
				<?php
                } ?>						</table>
<?php
            }//fin else
        }//fin while
    }//fin else
            ?>		</form>
<?php
}//fin  else

if (isset($_POST['SupprimerAtelier'])) {
    if (!empty($_POST['AtelierASupprimer'])) {
        //Supprimer la ligne concernant l'atelier dans la BDD
        $SupprimerA = $db-> prepare('DELETE FROM ateliers WHERE idA=:id ');
        $BienSupprA=$SupprimerA ->execute(array('id'=>$_POST['AtelierASupprimer']));
        if ($BienSupprA) {
            echo"<p> L'enregistrement à bien été supprimé.<br/></p>";
            //rafraichir la page
            echo"<META http-EQUIV=\"Refresh\" CONTENT=\"0; url=colloque2018.php#programme\">";
        } else {
            echo"<p>Erreur lors de la suppression de l'atelier dans la Base de données</p>";
        }
    }//fin if
    else {
        echo"<p>Veuillez cocher un atelier</p>";
    }
}// fin  bouton supprimer
    if (isset($_POST['EnregistrerAtelier'])) {
        //selectionne les dates du colloque
        $dateAteliers2 = $db-> prepare('SELECT * FROM joursColloque ORDER BY dateColloque DESC');
        $dateAteliersExecute2=$dateAteliers2->execute();
        if (!$dateAteliersExecute2) {
            echo"<p> Erreur lors de la recherche de la date du colloque</p>";
        } else {
            //Pour chaque date du colloque
            while ($dateAtelier= $dateAteliers2->fetch()) {
                //compte le nombre d"atelier du jour
                $Atelier = $db-> prepare('SELECT count(*) FROM ateliers WHERE dateA=:date');
                $AtelierExecute=$Atelier ->execute(array('date'=>$dateAtelier[1]));
                if (!$AtelierExecute) {
                    echo"<p> Erreur lors de la recherche du nombre d'atelier </p>";
                } else {
                    $nbA=$Atelier->fetch();
                    $AEnregitree=0;
                    //Pour chaque atelier de la journée
                    for ($j=0;$j<$nbA[0];$j++) {
                        $champs1="textmodifier1Ligne".$j.$dateAtelier[1];
                        $champs2="textmodifier2Ligne".$j.$dateAtelier[1];
                        $champs3="textmodifier3Ligne".$j.$dateAtelier[1];
                        $champs4="textmodifier4Ligne".$j.$dateAtelier[1];
                        $champs5="textmodifier5Ligne".$j.$dateAtelier[1];
                        $idA='idALigne'.$j.$dateAtelier[1];
                        //met à jour les informations de l'atelier
                        $enregistrement = $db-> prepare('UPDATE ateliers SET horaireA=:hc, titreA=:tc , salleA=:sc, responsableA=:resA, descriptionA=:desA WHERE idA=:id  AND dateA=:date');
                        $_POST[$champs1]=convertirHoraire($_POST[$champs1]);
                        $BienExecute=$enregistrement ->execute(array('hc'=>$_POST[$champs1],
                        'tc'=>$_POST[$champs2],
                        'sc'=>$_POST[$champs3],
                        'resA'=>$_POST[$champs4],
                        'desA'=>$_POST[$champs5],
                        'id'=>$_POST[$idA],
                        'date'=>$dateAtelier[1]));
                        //si l'telier a bien été enregistrée on incrémente la variable $AEnregitree
                        if ($BienExecute) {
                            $AEnregitree++;
                        }
                    }//fin for
                }//fin else
            }//fin while
        if ($AEnregitree== $nbA[0]) {
            echo"<p> Les modifications ont bien été faites.<br/></p>";
            //rafraichir la page
            echo"<META http-EQUIV=\"Refresh\" CONTENT=\"0; url=colloque2018.php#programme\">";
        }
        }//fin else
    }//fin bouton enregistrer

if (isset($_POST['AjouterAtelier'])) {
    ?>
	<h3>Ajouter un atelier</h3>
	<form method="post" action="colloque2018.php#programme">
		<table class="table table-striped" >
			<!--titre des colonnes-->
			<tr>
				<th>Horaire *</th>
				<th>Salle</th>
				<th>Date *</th>
				<th>Thème *</th>
				<th>Description</th>
				<th>Responsable *</th>
			</tr>
			<tr>
				<td><textarea cols="20" rows ="2"  name="Horaire"></textarea></td>
				<td><textarea cols="6" rows ="2"  name="Salle"></textarea></td>
                <td><input class="form-control" type="Date" cols="15" rows ="2"  name="Date" placeholder="ex: 2018-05-31" required></td>
				<td><textarea cols="40" rows ="2"  name="Theme"></textarea></td>
				<td><textarea cols="20" rows ="10"  name="Description"></textarea></td>
				<td><textarea cols="20" rows ="2"  name="Responsable"></textarea></td>
			</tr>
		</table>
		<button class="btn btn-success" type="submit" name="EnregistrerNouvelAtelier">Enregistrer le nouvel atelier</button>
	</form>
	<?php
}
    if (isset($_POST['EnregistrerNouvelAtelier'])) {
        if (!empty($_POST['Horaire']) && !empty($_POST['Theme']) && !empty($_POST['Date']) && !empty($_POST['Responsable'])) {
            //vérifie que la date soit valide
            $dateAtelier = $db-> prepare('SELECT * FROM joursColloque WHERE dateColloque=:date');
            $dateAtelierExecute=$dateAtelier->execute(array('date'=>$_POST['Date']));
            if (!$dateAtelierExecute) {
                echo"<p> Erreur lors de la recherche de la date du colloque</p>";
            } else {
                $dateValide= $dateAtelier->fetch();
                if ($dateValide!=false) {
                    //converti l'horaire si necessaire
                    $_POST['Horaire'] = convertirHoraire($_POST['Horaire']);
                    //Insert les informations de l'atelier dans la BDD
                    $insertA = $db-> prepare('INSERT INTO ateliers(horaireA,dateA,titreA,descriptionA,salleA,responsableA) VALUES(:hA,:dateA, :tA ,:desA, :sA, :resA)');
                    $BienInsertA=$insertA ->execute(array('hA'=>$_POST['Horaire'],
                    'dateA'=>$_POST['Date'],
                    'tA'=>$_POST['Theme'],
                    'desA'=>$_POST['Description'],
                    'sA'=>$_POST['Salle'],
                    'resA'=>$_POST['Responsable']));
                    //si l'telier a bien été enregistrée
                    if ($BienInsertA) {
                        echo"<p> L'ajout de l'atelier a bien été fait.<br/></p>";
                        //rafraichir la page
                        echo"<META http-EQUIV=\"Refresh\" CONTENT=\"0; url=colloque2018.php#programme\">";
                    } else {
                        echo"<p>Erreur lors de l'insertion de l'atelier dans la Base de données</p>";
                    }
                }//fin if
                else {
                    echo"<p>La date n'est pas valide. Veuillez réessayer</p>";
                }
            }//fin else
        } else {
            echo"<p>Veuillez remplir tous les champs munis d'un *</p>";
        }
    }// fin  bouton enregistrer?></div>

<br/><span class="separerHorizontal"></span>

<!-- CONFÉRENCES -->
<div class="" id="conferences">
	<h2>Conférences</h2>
	<?php
    if (isset($_POST['modifierConferences'])) {
        //affiche le texte en text area et un boutton enregistrer
        ?>
        <p>
		<form action ="colloque2018.php#conferences" method="post">

        <?php			//selectionne les dates des Conferences
        $dateConferences = $db-> prepare('SELECT * FROM joursColloque');
        $dateConferencesExecute=$dateConferences->execute();
        if (!$dateConferencesExecute) {
            echo"<p> Erreur lors de la recherche de la date des Conferences existants</p>";
        } else {
            while ($dateConference= $dateConferences->fetch()) {
                //selectionner tous les Conferences avec la date $dateConference[1]
                $Conference = $db-> prepare('SELECT horaireConf, salleConf, titreConf, descriptionConf, idIntervenant, idConf FROM conferences WHERE dateConf=:date');
                $ConferenceExecute=$Conference ->execute(array('date'=>$dateConference[1]));
                if (!$ConferenceExecute) {
                    echo"<p> Erreur lors de la recherche des Conferences existantes</p>";
                } else {
                    ?>
            <h3><?php echo convertirDate($dateConference[1]); ?></h3>
			<table class="table table-striped">
				<!--titre des colonnes-->
				<tr>
					<th>Horaire</th>
					<th>Thème</th>
					<th>Salle</th>
					<th>Intervenant(s)</th>
                    <th>Description</th>
				</tr>
				<?php
                    $i=0;
                    while ($infoConference=$Conference->fetch()) {

                ?>
				<tr>
					<?php
                        $ligne="Ligne".$i.$dateConference[1];
                    ?>
					<input type="hidden" name="<?php echo 'idConf'.$ligne; ?>" value="<?php echo $infoConference[5]; ?>"/>
                    <td><textarea cols="20" rows ="1"  name="<?php echo"textmodifier1".$ligne; ?>"><?php echo $infoConference[0]; ?></textarea></td>
					<td><textarea cols="20" rows ="4"  name="<?php echo"textmodifier2".$ligne; ?>"><?php echo $infoConference[2]; ?></textarea></td>
					<td><textarea cols="20" rows ="1"  name="<?php echo"textmodifier3".$ligne; ?>"><?php echo $infoConference[1]; ?></textarea></td>
					<td><textarea cols="30" rows ="2"  name="<?php echo"textmodifier4".$ligne; ?>"><?php echo $infoConference['idIntervenant']; ?></textarea></td>
                    <td><textarea cols="40" rows ="4"  name="<?php echo"textmodifier5".$ligne; ?>"><?php echo $infoConference['descriptionConf']; ?></textarea></td>
                </tr>
						<?php
                        $i++;
                    }//fin while?>
            </table>
	<?php
                }//fin else
            }//fin while
        }	//fin else
            ?>			<button class="btn btn-success" type="submit" name="EnregistrerConference">Enregistrer</button>
		</form>
	</p>
	<?php
    }//fin bouton enregistrer
    else {
        ?>		<!--bouton modifier-->
		<form action ="colloque2018.php#conferences" method="post"name="Conferences">
			<button class="btn" type="submit" name="modifierConferences">Modifier</button>
			<button class="btn btn-primary" type="submit" name="AjouterConference">Ajouter une conférence</button>
			<button class="btn btn-danger" type="submit" name="SupprimerConference">Supprimer une conférence</button>
            <?php		//selectionne les dates des Conferences
            $dateConferences = $db-> prepare('SELECT * FROM joursColloque');
            $dateConferencesExecute=$dateConferences->execute();
            if (!$dateConferencesExecute) {
            echo"<p> Erreur lors de la recherche de la date des Conferences existants</p>";
            } else {
            while ($dateConference= $dateConferences->fetch()) {
                //selectionner tous les Conferences avec la date $dateConference[1]
                $Conference = $db-> prepare('SELECT * FROM conferences WHERE dateConf=:date');
                $ConferenceExecute=$Conference ->execute(array('date'=>$dateConference[1]));
                if (!$ConferenceExecute) {
                    echo"<p> Erreur lors de la recherche des Conferences existantes</p>";
                } else {
                    ?>
                <h3><?php echo convertirDate($dateConference[1]); ?></h3>
			    <table class="table table-striped" >
				<!--titre des colonnes-->
				<tr>
					<th>Supprimer</th>
					<th>Horaire</th>
					<th>Thème</th>
					<th>Salle</th>
					<th>Intervenant(s)</th>
				</tr>
				<?php
                while ($infoConference=$Conference->fetch()) {
                        ?>
                    <tr>
					<td><input type="radio" name="ConferenceASupprimer" value="<?php echo $infoConference[0]; ?>"/></td>
					<td><?php echo $infoConference[1]; ?></td>
					<td><?php echo"<a href='#' data-toggle='modal' data-target='#modalConf".$infoConference['idConf']."'>". $infoConference[4]."<a/>"; ?></td>
					<td><?php echo $infoConference[2]; ?></td>
					<td><?php echo $infoConference['idIntervenant']; ?></td>

                    <!-- Modal -->
                    <div class="modal fade" id="modalConf<?php echo $infoConference['idConf'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                            <h5 class="modal-title"><b><?php echo $infoConference['titreConf']; ?></b></h5>
                            <br>
                            <p><b>Horaire : </b><?php echo trim_signum($infoConference['horaireConf']); ?></p>
                            <p><b>Salle : </b><?php echo ucfirst($infoConference['salleConf']); ?></p>
                            <p><b>Conférencier(s) : </b><?php echo ucfirst($infoConference['idIntervenant']); ?></p>

                          </div>
                          <div class="modal-body">
                            <?php echo $infoConference['descriptionConf']; ?>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                          </div>
                        </div>
                      </div>
                    </div>
                 </tr>
<?php
                    }//fin while
?>						</table>
<?php
                }//fin else
            }//fin while
        }//fin else
            ?>		</form>
<?php
    }//fin else

if (isset($_POST['SupprimerConference'])) {
    if (!empty($_POST['ConferenceASupprimer'])) {
        //Supprimer la ligne concernant l'atelier dans la BDD
        $SupprimerConf = $db-> prepare('DELETE FROM conferences WHERE idConf=:id ');
        $BienSupprConf=$SupprimerConf ->execute(array('id'=>$_POST['ConferenceASupprimer']));
        if ($BienSupprConf) {
            echo"<p> L'enregistrement à bien été supprimé.<br/></p>";
            //rafraichir la page
            echo"<META http-EQUIV=\"Refresh\" CONTENT=\"0; url=colloque2018.php#conferences\">";
        } else {
            echo"<p>Erreur lors de la suppression de la conférence dans la Base de données</p>";
        }
    }//fin if
    else {
        echo"<p>Veuillez cocher une conférence</p>";
    }
}// fin  bouton supprimer
    if (isset($_POST['EnregistrerConference'])) {
        //selectionne les dates des Conferences
        $dateConferences2 = $db-> prepare('SELECT * FROM joursColloque ORDER BY dateColloque DESC');
        $dateConferencesExecute2=$dateConferences2->execute();
        if (!$dateConferencesExecute2) {
            echo"<p> Erreur lors de la recherche de la date des Conferences existants</p>";
        } else {
            //Pour chaque date du colloque
            while ($dateConference= $dateConferences2->fetch()) {
                //compte le nombre de conférence du jour
                $conference = $db-> prepare('SELECT count(*) FROM conferences WHERE dateConf=:date');
                $conferenceExecute=$conference ->execute(array('date'=>$dateConference[1]));
                if (!$conferenceExecute) {
                    echo"<p> Erreur lors de la recherche du nom et prénom de l'intervenant </p>";
                } else {
                    $nbConf=$conference->fetch();
                    $ConfEnregitree=0;
                    //Pour chaque onférence de la journée
                    for ($j=0;$j<$nbConf[0];$j++) {
                        $champs1="textmodifier1Ligne".$j.$dateConference[1];
                        $champs2="textmodifier2Ligne".$j.$dateConference[1];
                        $champs3="textmodifier3Ligne".$j.$dateConference[1];
                        $champs4="textmodifier4Ligne".$j.$dateConference[1];
                        $champs5="textmodifier5Ligne".$j.$dateConference[1];
                        $idConf='idConfLigne'.$j.$dateConference[1];



                            //met à jour les informations de la conférence
                            $_POST[$champs1] = convertirHoraire($_POST[$champs1]);
                            $enregistrement = $db-> prepare('UPDATE conferences SET descriptionConf=:descriptionConf, horaireConf=:hc, titreConf=:tc , salleConf=:sc, idintervenant=:idI WHERE idConf=:id  AND dateConf=:date');
                            $BienExecute=$enregistrement ->execute(array(
                            'hc'=>$_POST[$champs1],
                            'tc'=>$_POST[$champs2],
                            'sc'=>$_POST[$champs3],
                            'idI'=>$_POST[$champs4],
                            'id'=>$_POST[$idConf],
                            'date'=>$dateConference[1],
                            'descriptionConf'=>$_POST[$champs5]));
                            //si la conference a bien été enregistrée on incrémente la variable $ConfEnregitree
                            if ($BienExecute) {
                                $ConfEnregitree++;
                            }

                    }//fin for
                }//fin else
            }//fin while
        if ($ConfEnregitree== $nbConf[0]) {
            echo"<p> Les modifications ont bien été faites.<br/> </p>";
            //rafraichir la page
            echo"<META http-EQUIV=\"Refresh\" CONTENT=\"0; url=colloque2018.php#conferences\">";
        }
        }//fin else
    }//fin bouton enregistrer
if (isset($_POST['AjouterConference'])) {
    ?>
	<h3>Ajouter une conférence</h3>
	<form method="post" action="colloque2018.php#conferences">
		<table class="table table-striped" >
			<!--titre des colonnes-->
			<tr>
				<th>Horaire *</th>
				<th>Salle</th>
				<th>Date *</th>
				<th>Thème *</th>
				<th>Description</th>
				<th>intervenant *</th>
			</tr>
			<tr>
				<td><textarea cols="20" rows ="2"  name="Horaire" required></textarea></td>
				<td><textarea cols="6" rows ="2"  name="Salle"></textarea></td>
				<td><input class="form-control" type="date" cols="15" rows ="2"  name="Date" placeholder="ex: 2018-05-31" required></td>
				<td><textarea cols="40" rows ="2"  name="Theme" required></textarea></td>
				<td><textarea cols="20" rows ="10"  name="Description"></textarea></td>
				<td><textarea cols="20" rows ="2"  name="Intervenant"  placeholder="ex: nom prénom" required></textarea></td>
			</tr>
		</table>
		<button class="btn btn-success" type="submit" name="EnregistrerNouvelleConference">Enregistrer la nouvelle conference</button>
	</form>
	<?php
}
    if (isset($_POST['EnregistrerNouvelleConference'])) {
        if (!empty($_POST['Horaire']) && !empty($_POST['Theme']) && !empty($_POST['Date']) && !empty($_POST['Intervenant'])) {
            //vérifie que la date soit valide
            $dateConference = $db-> prepare('SELECT * FROM joursColloque WHERE dateColloque=:date');
            $dateConferenceExecute=$dateConference->execute(array('date'=>$_POST['Date']));
            if (!$dateConferenceExecute) {
                echo"<p> Erreur lors de la recherche de la date du colloque</p>";
            } else {
                $dateValide= $dateConference->fetch();
                //si la date est valide
                if ($dateValide!=false) {
                    //Insert les informations de l'Conference dans la BDD
                    $_POST['Horaire'] = convertirHoraire($_POST['Horaire']);
                    $insertConf = $db-> prepare('INSERT INTO conferences(horaireConf,dateConf,titreConf,descriptionConf,salleConf,idintervenant) VALUES(:hConf,:dateConf, :tConf ,:desConf, :sConf, :iConf)');
                    $BienInsertConf=$insertConf ->execute(array('hConf'=>$_POST['Horaire'],
                    'dateConf'=>$_POST['Date'],
                    'tConf'=>$_POST['Theme'],
                    'desConf'=>$_POST['Description'],
                    'sConf'=>$_POST['Salle'],
                    'iConf'=>$_POST['Intervenant']));
                    //si l'telier a bien été enregistrée
                    if ($BienInsertConf) {
                        echo"<p> L'ajout de la conférence a bien été fait.<br/></p>";
                        //rafraichir la page
                        echo"<META http-EQUIV=\"Refresh\" CONTENT=\"0; url=colloque2018.php#conferences\">";
                    } else {
                        echo"<p>Erreur lors de l'insertion de la conférence dans la base de données</p>";
                    }
                } else {
                    echo"<p>La date n'est pas valide. Veuillez réessayer</p>";
                }
            }
        } else {
            echo"<p>Veuillez remplir tous les champs munis d'un *</p>";
        }
    }// fin  bouton enregisrer?></div>


               </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery-2-1-4-min.js"></script>
<script type="text/javascript" src="../js/menu.js"></script>
<script type="text/javascript" src="../js/bootstrap.js"></script>
<script type="text/javascript" src="../js/uploadbar.js"></script>
<script type="text/javascript" src="../js/colloque2018.js"></script>


<!-- PIED DE PAGE -->
<footer>
	<?php include('./footer_admin.php'); ?>
</footer>
</div>
<body/>
<html/>
<?php
} else {
        echo "Redirection vers la page de connexion";
        header("Refresh:0;url=index.php");
    }
?>
