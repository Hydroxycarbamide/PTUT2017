<?php
function convertirNoteHotels($allHotels){
	global $db;

	switch ($allHotels) {
		case 1:
			$note = "*";
		break;
		case 2:
			$note = "**";
		break;
		case 3:
			$note = "***";
		break;
		case 4:
			$note = "****";
		break;
		case 5:
			$note = "*****";
		break;
		default:
			$note = " ";
		break;
	}
	return $note;
}

# Ajout d'une image dans le carrousel ------->
function ajoutCar($sousTitreCar, $imgCar){
	global $db;

	if (empty($sousTitreCar) || empty($_FILES[$imgCar]['name'])) {
		echo '<div class="alert alert-danger">Veuillez remplir les champs (image et sous-titre)</div>';
	} else {

		# Gestion de l'image --------------------------------->
		$extensions_valides = array('jpg', 'jpeg', 'gif', 'png');
		// Gestion d'erreur
		if ($_FILES[$imgCar]['error'] > 0){
			$erreur = "Erreur lors du transfert";
		}
		// Récupération de l'extension
		$extension_upload = strtolower(  substr(  strrchr($_FILES[$imgCar]['name'], '.') , 1)  );
		$image = 'images/imgCar' . md5(uniqid(rand(), true)) . "." . $extension_upload;
		$loc = "../". $image;
		// Stockaque de l'image
		$resultat = move_uploaded_file($_FILES[$imgCar]['tmp_name'], $loc);

		// Ajout
		$ajoutImageCarrousel = $db->prepare('INSERT INTO carrousel (imageCar, sousTitreCar) VALUES (:imc, :stc)');
		$ajouterImageCarrousel = $ajoutImageCarrousel->execute(array(
			"imc"	=> $image,
			"stc"	=> $sousTitreCar
			));

		if (!$ajouterImageCarrousel) {
			echo '<div class="alert alert-danger">Non ajouté</div>';
			?>
			<meta http-equiv="refresh" content="2;url=accueil.php" />
			<?php
		} else {
			echo '<div class="alert alert-success">Modification effectuée</div>';
			?>
			<meta http-equiv="refresh" content="2;url=accueil.php" />
			<?php
		}

	}
}
# -------------------------------------------<>

# Modification d'une image du carrousel ------->
function modifCar($idCar, $sousTitreCar, $imgCar){

	global $db;

	if (empty($sousTitreCar)) {
		echo '<div class="alert alert-danger">Veuillez remplir les champs</div>';
	} else {

		# Gestion de l'image --------------------------------->
		$extensions_valides = array('jpg', 'jpeg', 'gif', 'png');

		if (!empty($_FILES[$imgCar]['name'])) {
			if ($_FILES[$imgCar]['error'] > 0){
				$erreur = "Erreur lors du transfert";
			}
			$extension_upload = strtolower(  substr(  strrchr($_FILES[$imgCar]['name'], '.') , 1)  );
			$image = 'images/imgCar' . $idCar . "." . $extension_upload;
			$loc = "../". $image;


			$suppressionOldImage = $db->prepare('SELECT imageCar FROM carrousel WHERE idCar = :idCar');
			$suppressionOldImage->execute(array("idCar"	=> $idCar));
			$supprimerOldImage = $suppressionOldImage->fetch();
			$oldImage = "images/" . $supprimerOldImage['imageCar'];

			# Vérifie si le fichier
			if (is_file($oldImage)) {
				unlink($oldImage);
				echo '<div class="alert alert-success">Ancienne image supprimée</div>';
			}

			$resultat = move_uploaded_file($_FILES[$imgCar]['tmp_name'], $loc);

			$img_on_same_folder = 'images/' . $_FILES[$imgCar]['name'];
			if (is_file($img_on_same_folder)) {
				if (!copy($img_on_same_folder, $loc)) {
					echo '<div class="alert alert-danger">Transfert échoué ! Veuillez réessayer ou changer de photo.</div>';
				}
			}

			$modifIA = $db->prepare('UPDATE carrousel SET sousTitreCar = :sousTitreCar, imageCar = :imageCar WHERE idCar = :idCar;');
			$modExe = $modifIA->execute(array(
				"sousTitreCar"	=> $sousTitreCar,
				"imageCar"	=> $image,
				"idCar"	=> $idCar
				));

			if (!$modExe) {
				echo '<div class="alert alert-danger">Non modifié</div>';
			} else {
				echo '<div class="alert alert-success">Modification effectuée</div>';
				?>
				<meta http-equiv="refresh" content="2;url=accueil.php" />
				<?php
			}
		} else {
			$modifIA = $db->prepare('UPDATE carrousel SET sousTitreCar = :sousTitreCar WHERE idCar = :idCar;');
			$modExe = $modifIA->execute(array(
				"sousTitreCar"	=> $sousTitreCar,
				"idCar"	=> $idCar
				));

			if (!$modExe) {
				echo '<div class="alert alert-danger">Non modifié</div>';
			} else {
				echo '<div class="alert alert-success">Modification effectuée</div>';
				?>
				<meta http-equiv="refresh" content="2;url=accueil.php" />
				<?php
			}
		}

	}
}
# ---------------------------------------------<>

# Suppression d'une image dans le carrousel ------->
function suppressionCar($idCar, $imgCar){
	global $db;

	// Suppression
	unlink('../' . $imgCar);


	$suppressionImageCarrousel = $db->prepare('DELETE FROM carrousel WHERE idCar = :idc');
	$supprimerImageCarrousel = $suppressionImageCarrousel->execute(array(
		"idc"	=> $idCar
		));
	$imagesCarrousel = $db->prepare('SELECT idCar FROM carrousel WHERE idCar> :idc '); //Ajout de condition
    $imagesCarrousel->execute(array('idc'=> $idCar));

    while($i = $imagesCarrousel->fetch()) {

        $decalage = $db->prepare('UPDATE carrousel SET carrousel.idCar = ? WHERE carrousel.idCar = ?');
        $decalage = $decalage->execute(array($i[0]-1,$i[0]));

    }
	$valeur = $db->prepare('SELECT COUNT(*) FROM carrousel');
	$valeur->execute(array());
	$a = $valeur->fetch();

    $decalageCarrousel = $db->exec("ALTER TABLE `carrousel` AUTO_INCREMENT = $a[0]");

	if (!$supprimerImageCarrousel) {
		echo '<div class="alert alert-danger">Non supprimé</div>';
		?>
		<meta http-equiv="refresh" content="2;url=accueil.php" />
		<?php
	} else {
		echo '<div class="alert alert-success">Suppression effectuée</div>';
		?>
		<meta http-equiv="refresh" content="2;url=accueil.php" />
		<?php
	}

}
# -------------------------------------------<>

# Ajout d'une image dans le carrousel ------->
function ajoutMentions($nomM, $descriptionM){
	global $db;

	if (empty($nomM) || empty($descriptionM)) {
		echo '<div class="alert alert-danger">Veuillez remplir les champs (image et sous-titre)</div>';
	} else {

		// Ajout
		$ajoutMentionsLegales = $db->prepare('INSERT INTO mentionslegales (nomM, descriptionM) VALUES (:nomM, :descriptionM)');
		$ajouterMentionsLegales = $ajoutMentionsLegales->execute(array(
			"nomM"	=> $nomM,
			"descriptionM"	=> $descriptionM
			));

		if (!$ajouterMentionsLegales) {
			echo '<div class="alert alert-danger">Non ajouté</div>';
			?>
			<meta http-equiv="refresh" content="2;url=mentions.php">
			<?php
		} else {
			echo '<div class="alert alert-success">Modification effectuée</div>';
			?>
			<meta http-equiv="refresh" content="2;url=mentions.php" />
			<?php
		}

	}
}
# -------------------------------------------<>

# A la validation du formulaire ------->
function modifMentions($id, $titreId, $textId){
	global $db;

	$textId = str_replace(array("\r\n","\n"),'\n',$textId);

	if (empty($_POST[$textId]) || empty($_POST[$titreId])) {
		echo '<div class="alert alert-danger">Veuillez remplir les champs</div>';
	} else {
		$modificationMentionsLegales = $db->prepare('UPDATE mentionslegales SET nomM = :nomM, descriptionM = :descriptionM WHERE idM = :idM;');
		$modifierMentionsLegales = $modificationMentionsLegales->execute(array(
			"nomM"	=> $_POST[$titreId],
			"descriptionM"	=> $_POST[$textId],
			"idM"	=> $id
			));

		if (!$modifierMentionsLegales) {
			echo '<div class="alert alert-danger">Non modifié</div>';
		} else {
			echo '<div class="alert alert-success">Modification effectuée</div>';
			?>
			<meta http-equiv="refresh" content="1;url=mentions.php" />
			<?php
		}
	}

}
# -------------------------------------<>

# Suppression d'une image dans le carrousel ------->
function suppressionMentions($idMentions){
	global $db;

	// Suppression
	$suppressionMentionsLegales = $db->prepare('DELETE FROM mentionslegales WHERE idM = :idM');
	$supprimerMentionsLegales = $suppressionMentionsLegales->execute(array(
		"idM"	=> $idMentions
		));

	if (!$supprimerMentionsLegales) {
		echo '<div class="alert alert-danger">Non supprimé</div>';
		?>
		<meta http-equiv="refresh" content="2;url=mentions.php" />
		<?php
	} else {
		echo '<div class="alert alert-success">Suppression effectuée</div>';
		?>
		<meta http-equiv="refresh" content="2;url=mentions.php" />
		<?php
	}

}
# -------------------------------------------<>

# Ajout d'un paragraphe 'Accès à l'IUT ------->
function ajoutAccesIUT($sousTitreAcces, $texteAcces, $lienA){
	global $db;

	if (empty($sousTitreAcces) || empty($texteAcces)) {
		echo '<div class="alert alert-danger">Veuillez remplir les champs (sous-titre et texte)</div>';
	} else {

		// Ajout
		$ajoutAccesIUT = $db->prepare('INSERT INTO accesIUT (sousTitreAcces, texteAcces, lien) VALUES (:sousTitreAcces, :texteAcces, :lienA)');
		$ajouterAccesIUT = $ajoutAccesIUT->execute(array(
			"sousTitreAcces"	=> $sousTitreAcces,
			"texteAcces"		=> $texteAcces,
			"lienA"				=> $lienA
			));

		if (!$ajouterAccesIUT) {
			echo '<div class="alert alert-danger">Non ajouté</div>';
			?>
			<meta http-equiv="refresh" content="2;url=infoP.php#accesiut" />
			<?php
		} else {
			echo '<div class="alert alert-success">Ajout effectué</div>';
			?>
			<meta http-equiv="refresh" content="2;url=infoP.php#accesiut" />
			<?php
		}

	}
}
# -------------------------------------------<>

# A la validation du formulaire ------->
function modifAccesIUT($idAcces, $sousTitreAccesIUT, $texteAccesIUT, $lienA){
	global $db;

	$texteAccesIUT = str_replace(array("\r\n","\n"),'\n',$texteAccesIUT);

	if (empty($_POST[$sousTitreAccesIUT]) || empty($_POST[$texteAccesIUT])) {
		echo '<div class="alert alert-danger">Veuillez remplir les champs</div>';
	} else {
		$modificationAccesIUT = $db->prepare('UPDATE accesIUT SET sousTitreAcces = :sousTitreAcces, texteAcces = :texteAcces, lien = :lienA WHERE idAcces = :idAcces;');
		$modifierAccesIUT = $modificationAccesIUT->execute(array(
			"sousTitreAcces"	=> $_POST[$sousTitreAccesIUT],
			"texteAcces"	=> $_POST[$texteAccesIUT],
			"idAcces"	=> $idAcces
			"lienA"		=> $lienA
			));

		if (!$modifierAccesIUT) {
			echo '<div class="alert alert-danger">Non modifié</div>';
		} else {
			echo '<div class="alert alert-success">Modification effectuée</div>';
			?>
			<meta http-equiv="refresh" content="1;url=infoP.php#accesiut" />
			<?php
		}
	}

}
# -------------------------------------------<>

# Suppression d'une image dans le carrousel ------->
function suppressionAccesIUT($idAccesIUT){
	global $db;

	// Suppression
	$suppressionAccesIUT = $db->prepare('DELETE FROM accesIUT WHERE idAcces = :idAccesIUT');
	$supprimerAccesIUT = $suppressionAccesIUT->execute(array(
		"idAccesIUT"	=> $idAccesIUT
		));

	if (!$supprimerAccesIUT) {
		echo '<div class="alert alert-danger">Non supprimé</div>';
		?>
		<meta http-equiv="refresh" content="2;url=infoP.php#accesiut" />
		<?php
	} else {
		echo '<div class="alert alert-success">Suppression effectuée</div>';
		?>
		<meta http-equiv="refresh" content="2;url=infoP.php#accesiut" />
		<?php
	}

}
# -------------------------------------------<>
function ajoutPartie($Titre, $Texte, $Video, $Lien){
	global $db;
	if (isset($Titre) && isset($Texte) && isset($Video) && isset($Lien)) {
		//Insert les informations de la partie dans la BDD
		$lienVideo = NULL;
		if (!($_FILES[$Video]['size'] == 0)&&file_exists('../videos/'.$_FILES["videoPC"]["name"]))
		{
			$lienVideo = 'videos/'.$_FILES["videoPC"]["name"];
		}
		if(strlen($Lien)==0){
			$Lien=NULL;
		}
		//$extension_upload = strtolower(  substr(  strrchr($_FILES['video']['name'], '.') , 1)  );
		$insertPC = $db-> prepare('INSERT INTO presentationColloque(sousTitrePC,textePC,video,lien) VALUES(:titrePC,:textePC,:video,:lien)');
		$BienInsertPC=$insertPC ->execute(array(
		'titrePC'=>$Titre,
		'textePC'=>$Texte,
		'video'=>$lienVideo,
		'lien'=>$Lien
		));
		//si l'telier a bien été enregistrée
		if ($BienInsertPC) {
			echo"<p> L'ajout de la partie a bien été fait.<br/></p>";
			//rafraichir la page
			echo"<META http-EQUIV=\"Refresh\" CONTENT=\"0; url=colloque2018.php\">";
		} else {
			echo"<p>Erreur lors de l'insertion de la partie dans la Base de données</p>";
		}
	}//fin if
	else {
		echo"<p>Veuiilez remplir tous les champs munis d'un *</p>";
	}
}
# Ajout d'un hôtel ------->
function ajoutHotel($nomH, $photoH, $noteH, $adresseH, $telH, $faxH, $descriptionH, $tarifsH, $lienH){
	global $db;

	if (empty($nomH) || empty($photoH) || empty($noteH) || empty($adresseH) || empty($telH) || empty($descriptionH) || empty($tarifsH) || empty($lienH)) {
		echo '<div class="alert alert-danger">Veuillez remplir tous les champs obligatoires</div>';
	} else {

		# Gestion de l'image --------------------------------->
		$extensions_valides = array('jpg', 'jpeg', 'gif', 'png');
		// Gestion d'erreur
		if ($_FILES[$photoH]['error'] > 0){
			$erreur = "Erreur lors du transfert";
		}
		// Récupération de l'extension
		$extension_upload = strtolower(  substr(  strrchr($_FILES[$photoH]['name'], '.') , 1)  );
		$image = 'images/photoH' . md5(uniqid(rand(), true)) . "." . $extension_upload;
		$loc = "../". $image;
		// Stockaque de l'image
		$resultat = move_uploaded_file($_FILES[$photoH]['tmp_name'], $loc);

		// Ajout
		$ajoutHotel = $db->prepare('INSERT INTO hotels (photoH, nomH, descriptionH, telH, faxH, adresseH, noteH, tarifH, lienH) VALUES (:photoH, :nomH, :descriptionH, :telH, :faxH, :adresseH, :noteH, :tarifH, :lienH)');
		$ajouterHotel = $ajoutHotel->execute(array(
			"nomH"	=> $nomH,
			"photoH"	=> $image,
			"noteH"	=> $noteH,
			"adresseH"	=> $adresseH,
			"telH"	=> $telH,
			"faxH"	=> $faxH,
			"descriptionH"	=> $descriptionH,
			"tarifH"	=> $tarifsH,
			"lienH"	=> $lienH
			));

		if (!$ajouterHotel) {
			echo '<div class="alert alert-danger">Non ajouté</div>';
			?>
			<meta http-equiv="refresh" content="2;url=infoP.php#hotels" />
			<?php
		} else {
			echo '<div class="alert alert-success">Modification effectuée</div>';
			?>
			<meta http-equiv="refresh" content="2;url=infoP.php#hotels" />
			<?php
		}

	}
}
# -------------------------------------------<>

# Modification d'un hôtel ------->
function modifHotel($idH, $nomH, $photoH, $noteH, $adresseH, $telH, $faxH, $descriptionH, $tarifsH, $lienH){

	global $db;

	if (empty($nomH) || empty($noteH) || empty($adresseH) || empty($telH) || empty($descriptionH) || empty($tarifsH) || empty($lienH)) {
		echo '<div class="alert alert-danger">Veuillez remplir tous les champs obligatoires</div>';
	} else {

		# Gestion de l'image --------------------------------->
		$extensions_valides = array('jpg', 'jpeg', 'gif', 'png');

		if (!empty($_FILES[$photoH]['name'])) {
			if ($_FILES[$photoH]['error'] > 0){
				$erreur = "Erreur lors du transfert";
			}
			$extension_upload = strtolower(  substr(  strrchr($_FILES[$photoH]['name'], '.') , 1)  );
			$image = 'images/photoH' . $idH . "." . $extension_upload;
			$loc = "../". $image;
			$resultat = move_uploaded_file($_FILES[$photoH]['tmp_name'], $loc);

			$suppressionOldImage = $db->prepare('SELECT photoH FROM hotels WHERE idH = :idH');
			$suppressionOldImage->execute(array("idH"	=> $idH));
			$supprimerOldImage = $suppressionOldImage->fetch();
			$oldImage = "images/" . $supprimerOldImage['photoH'];

			# Vérifie si le fichier
			if (is_file($oldImage)) {
				unlink($oldImage);
				echo '<div class="alert alert-success">Ancienne image supprimée</div>';
			}

			$img_on_same_folder = 'images/' . $_FILES[$photoH]['name'];
			if (is_file($img_on_same_folder)) {
				if (!copy($img_on_same_folder, $loc)) {
					echo '<div class="alert alert-danger">Transfert échoué ! Veuillez réessayer ou changer de photo.</div>';
				}
			}

			$modificationH = $db->prepare('UPDATE hotels SET nomH = :nomH, photoH = :photoH, noteH = :noteH, adresseH = :adresseH, telH = :telH, faxH = :faxH, descriptionH = :descriptionH, tarifH = :tarifH, lienH = :lienH WHERE idH = :idH;');
			$modifierH = $modificationH->execute(array(
				"nomH"	=> $nomH,
				"photoH"	=> $image,
				"noteH"	=> $noteH,
				"adresseH"	=> $adresseH,
				"telH"	=> $telH,
				"faxH"	=> $faxH,
				"descriptionH"	=> $descriptionH,
				"tarifH"	=> $tarifsH,
				"lienH"	=> $lienH,
				"idH"	=> $idH
				));

			if (!$modifierH) {
				echo '<div class="alert alert-danger">Non modifié</div>';
			} else {
				echo '<div class="alert alert-success">Modification effectuée</div>';
				?>
				<meta http-equiv="refresh" content="2;url=infoP.php#hotels" />
				<?php
			}
		} else {
			$modificationH = $db->prepare('UPDATE hotels SET nomH = :nomH, noteH = :noteH, adresseH = :adresseH, telH = :telH, faxH = :faxH, descriptionH = :descriptionH, tarifH = :tarifH, lienH = :lienH WHERE idH = :idH;');
			$modifierH = $modificationH->execute(array(
				"nomH"	=> $nomH,
				"noteH"	=> $noteH,
				"adresseH"	=> $adresseH,
				"telH"	=> $telH,
				"faxH"	=> $faxH,
				"descriptionH"	=> $descriptionH,
				"tarifH"	=> $tarifsH,
				"lienH"	=> $lienH,
				"idH"	=> $idH
				));

			if (!$modifierH) {
				echo '<div class="alert alert-danger">Non modifié</div>';
			} else {
				echo '<div class="alert alert-success">Modification effectuée</div>';
				?>
				<meta http-equiv="refresh" content="2;url=infoP.php#hotels" />
				<?php
			}
		}

	}
}
# ---------------------------------------------<>

# Suppression d'un hôtel ------->
function suppressionHotel($idHotel, $imgHotel){
	global $db;

	// Suppression
	unlink('../' . $imgHotel);


	$suppressionHotel = $db->prepare('DELETE FROM hotels WHERE idH = :idHotel');
	$supprimerHotel = $suppressionHotel->execute(array(
		"idHotel"	=> $idHotel
		));

	if (!$supprimerHotel) {
		echo '<div class="alert alert-danger">Non supprimé</div>';
		?>
		<meta http-equiv="refresh" content="2;url=infoP.php#hotels" />
		<?php
	} else {
		echo '<div class="alert alert-success">Suppression effectuée</div>';
		?>
		<meta http-equiv="refresh" content="2;url=infoP.php#hotels" />
		<?php
	}

}
# -------------------------------------------<>

# Ajout d'un restaurant ------->
function ajoutRestaurant($nomR, $photoR, $adresseR, $telR, $faxR, $descriptionR, $tarifsR, $lienR){
	global $db;

	if (empty($nomR) || empty($photoR) || empty($adresseR) || empty($telR) || empty($descriptionR) || empty($tarifsR) || empty($lienR)) {
		echo '<div class="alert alert-danger">Veuillez remplir tous les champs obligatoires</div>';
	} else {

		# Gestion de l'image --------------------------------->
		$extensions_valides = array('jpg', 'jpeg', 'gif', 'png');
		// Gestion d'erreur
		if ($_FILES[$photoR]['error'] > 0){
			$erreur = "Erreur lors du transfert";
		}
		// Récupération de l'extension
		$extension_upload = strtolower(  substr(  strrchr($_FILES[$photoR]['name'], '.') , 1)  );
		$image = 'images/photoR' . md5(uniqid(rand(), true)) . "." . $extension_upload;
		$loc = "../". $image;
		// Stockaque de l'image
		$resultat = move_uploaded_file($_FILES[$photoR]['tmp_name'], $loc);

		// Ajout
		$ajoutRestaurant = $db->prepare('INSERT INTO restaurants (photoR, nomR, descriptionR, telR, faxR, adresseR, tarifR, lienR) VALUES (:photoR, :nomR, :descriptionR, :telR, :faxR, :adresseR, :tarifR, :lienR)');
		$ajouterRestaurant = $ajoutRestaurant->execute(array(
			"nomR"	=> $nomR,
			"photoR"	=> $image,
			"adresseR"	=> $adresseR,
			"telR"	=> $telR,
			"faxR"	=> $faxR,
			"descriptionR"	=> $descriptionR,
			"tarifR"	=> $tarifsR,
			"lienR"	=> $lienR
			));

		if (!$ajouterRestaurant) {
			echo '<div class="alert alert-danger">Non ajouté</div>';
			?>
			<meta http-equiv="refresh" content="2;url=infoP.php#restauration" />
			<?php
		} else {
			echo '<div class="alert alert-success">Modification effectuée</div>';
			?>
			<meta http-equiv="refresh" content="2;url=infoP.php#restauration" />
			<?php
		}

	}
}
# -------------------------------------------<>

# Modification d'un restaurant ------->
function modifRestaurant($idR, $nomR, $photoR, $adresseR, $telR, $faxR, $descriptionR, $tarifsR, $lienR){

	global $db;

	if (empty($nomR) || empty($adresseR) || empty($telR) || empty($descriptionR) || empty($tarifsR) || empty($lienR)) {
		echo '<div class="alert alert-danger">Veuillez remplir tous les champs obligatoires</div>';
	} else {

		# Gestion de l'image --------------------------------->
		$extensions_valides = array('jpg', 'jpeg', 'gif', 'png');

		if (!empty($_FILES[$photoR]['name'])) {
			if ($_FILES[$photoR]['error'] > 0){
				$erreur = "Erreur lors du transfert";
			}
			$extension_upload = strtolower(  substr(  strrchr($_FILES[$photoR]['name'], '.') , 1)  );
			$image = 'images/photoR' . $idR . "." . $extension_upload;
			$loc = "../". $image;
			$resultat = move_uploaded_file($_FILES[$photoR]['tmp_name'], $loc);

			$suppressionOldImage = $db->prepare('SELECT photoR FROM restaurants WHERE idR = :idR');
			$suppressionOldImage->execute(array("idR"	=> $idR));
			$supprimerOldImage = $suppressionOldImage->fetch();
			$oldImage = "images/" . $supprimerOldImage['photoR'];

			# Vérifie si le fichier
			if (is_file($oldImage)) {
				unlink($oldImage);
				echo '<div class="alert alert-success">Ancienne image supprimée</div>';
			}

			$img_on_same_folder = 'images/' . $_FILES[$photoR]['name'];
			if (is_file($img_on_same_folder)) {
				if (!copy($img_on_same_folder, $loc)) {
					echo '<div class="alert alert-danger">Transfert échoué ! Veuillez réessayer ou changer de photo.</div>';
				}
			}

			$modificationR = $db->prepare('UPDATE restaurants SET nomR = :nomR, photoR = :photoR, adresseR = :adresseR, telR = :telR, faxR = :faxR, descriptionR = :descriptionR, tarifR = :tarifR, lienR = :lienR WHERE idR = :idR;');
			$modifierR = $modificationR->execute(array(
				"nomR"	=> $nomR,
				"photoR"	=> $image,
				"adresseR"	=> $adresseR,
				"telR"	=> $telR,
				"faxR"	=> $faxR,
				"descriptionR"	=> $descriptionR,
				"tarifR"	=> $tarifsR,
				"lienR"	=> $lienR,
				"idR" => $idR
				));

			if (!$modifierR) {
				echo '<div class="alert alert-danger">Non modifié</div>';
			} else {
				echo '<div class="alert alert-success">Modification effectuée</div>';
				?>
				<meta http-equiv="refresh" content="2;url=infoP.php#restaurants" />
				<?php
			}
		} else {
			$modificationR = $db->prepare('UPDATE restaurants SET nomR = :nomR, adresseR = :adresseR, telR = :telR, faxR = :faxR, descriptionR = :descriptionR, tarifR = :tarifR, lienR = :lienR WHERE idR = :idR;');
			$modifierR = $modificationR->execute(array(
				"nomR"	=> $nomR,
				"adresseR"	=> $adresseR,
				"telR"	=> $telR,
				"faxR"	=> $faxR,
				"descriptionR"	=> $descriptionR,
				"tarifR"	=> $tarifsR,
				"lienR"	=> $lienR,
				"idR" => $idR
				));

			if (!$modifierR) {
				echo '<div class="alert alert-danger">Non modifié</div>';
			} else {
				echo '<div class="alert alert-success">Modification effectuée</div>';
				?>
				<meta http-equiv="refresh" content="2;url=infoP.php#restaurants" />
				<?php
			}
		}

	}
}
# ---------------------------------------------<>

# Suppression d'un hôtel ------->
function suppressionRestaurant($idRestaurant, $imgRestaurant){
	global $db;

	// Suppression
	unlink('../' . $imgRestaurant);


	$suppressionRestaurant = $db->prepare('DELETE FROM restaurants WHERE idR = :idRestaurant');
	$supprimerRestaurant = $suppressionRestaurant->execute(array(
		"idRestaurant"	=> $idRestaurant
		));

	if (!$supprimerRestaurant) {
		echo '<div class="alert alert-danger">Non supprimé</div>';
		?>
		<meta http-equiv="refresh" content="2;url=infoP.php#restauration" />
		<?php
	} else {
		echo '<div class="alert alert-success">Suppression effectuée</div>';
		?>
		<meta http-equiv="refresh" content="2;url=infoP.php#restauration" />
		<?php
	}

}
# -------------------------------------------<>

# Ajout d'un paragraphe 'Accès à l'IUT ------->
function ajoutTransport($numeroLigne, $terminus, $lienTisseo){
	global $db;

	if (empty($numeroLigne) || empty($terminus) || empty($lienTisseo)) {
		echo '<div class="alert alert-danger">Veuillez remplir les champs (sous-titre et texte)</div>';
	} else {

		// Ajout
		$ajoutTransport = $db->prepare('INSERT INTO transports (numeroLigne, terminus, lienTisseo) VALUES (:numeroLigne, :terminus, :lienTisseo)');
		$ajouterTransport = $ajoutTransport->execute(array(
			"numeroLigne"	=> $numeroLigne,
			"terminus"		=> $terminus,
			"lienTisseo"	=> $lienTisseo
			));

		if (!$ajouterTransport) {
			echo '<div class="alert alert-danger">Non ajouté</div>';
			?>
			<meta http-equiv="refresh" content="2;url=infoP.php#transports" />
			<?php
		} else {
			echo '<div class="alert alert-success">Ajout effectué</div>';
			?>
			<meta http-equiv="refresh" content="2;url=infoP.php#transports" />
			<?php
		}

	}
}
# -------------------------------------------<>

# A la validation du formulaire ------->
function modifTransport($idTrans, $numeroLigne, $terminus, $lienTisseo){
	global $db;

	if (empty($_POST[$numeroLigne]) || empty($_POST[$terminus]) || empty($_POST[$lienTisseo])) {
		echo '<div class="alert alert-danger">Veuillez remplir les champs</div>';
	} else {
		$modificationTransport = $db->prepare('UPDATE transports SET numeroLigne = :numeroLigne, terminus = :terminus, lienTisseo = :lienTisseo WHERE idTrans = :idTrans;');
		$modifierTransport = $modificationTransport->execute(array(
			"numeroLigne"	=> $_POST[$numeroLigne],
			"terminus"		=> $_POST[$terminus],
			"lienTisseo"	=> $_POST[$lienTisseo],
			"idTrans"		=> $idTrans
			));

		if (!$modifierTransport) {
			echo '<div class="alert alert-danger">Non modifié</div>';
		} else {
			echo '<div class="alert alert-success">Modification effectuée</div>';
			?>
			<meta http-equiv="refresh" content="1;url=infoP.php#transports" />
			<?php
		}
	}

}
# -------------------------------------------<>

# Suppression d'une image dans le carrousel ------->
function suppressionTransport($idTrans){
	global $db;

	// Suppression
	$suppressionTransport = $db->prepare('DELETE FROM transports WHERE idTrans = :idTrans');
	$supprimerTransport = $suppressionTransport->execute(array(
		"idTrans"	=> $idTrans
		));

	if (!$supprimerTransport) {
		echo '<div class="alert alert-danger">Non supprimé</div>';
		?>
		<meta http-equiv="refresh" content="2;url=infoP.php#transports" />
		<?php
	} else {
		echo '<div class="alert alert-success">Suppression effectuée</div>';
		?>
		<meta http-equiv="refresh" content="2;url=infoP.php#transports" />
		<?php
	}

}
# -------------------------------------------<>

# Ajout d'un restaurant ------->
function ajoutTourisme($titreTourisme, $photoTourisme, $descriptionTourisme, $lienTourisme){
	global $db;

	if (empty($titreTourisme) || empty($photoTourisme) || empty($descriptionTourisme) || empty($lienTourisme)) {
		echo '<div class="alert alert-danger">Veuillez remplir tous les champs obligatoires</div>';
	} else {

		# Gestion de l'image --------------------------------->
		$extensions_valides = array('jpg', 'jpeg', 'gif', 'png');
		// Gestion d'erreur
		if ($_FILES[$photoTourisme]['error'] > 0){
			$erreur = "Erreur lors du transfert";
		}
		// Récupération de l'extension
		$extension_upload = strtolower(  substr(  strrchr($_FILES[$photoTourisme]['name'], '.') , 1)  );
		$image = 'images/photoTourisme' . md5(uniqid(rand(), true)) . "." . $extension_upload;
		$loc = "../". $image;
		// Stockaque de l'image
		$resultat = move_uploaded_file($_FILES[$photoTourisme]['tmp_name'], $loc);

		// Ajout
		$ajoutTourisme = $db->prepare('INSERT INTO tourisme (imageT, titreT, paragrapheT, lienT) VALUES (:imageT, :titreT, :paragrapheT, :lienT)');
		$ajouterTourisme = $ajoutTourisme->execute(array(
			"titreT"	=> $titreTourisme,
			"imageT"	=> $image,
			"paragrapheT"	=> $descriptionTourisme,
			"lienT"	=> $lienTourisme
			));

		if (!$ajouterTourisme) {
			echo '<div class="alert alert-danger">Non ajouté</div>';
			?>
			<meta http-equiv="refresh" content="2;url=infoP.php#tourisme" />
			<?php
		} else {
			echo '<div class="alert alert-success">Modification effectuée</div>';
			?>
			<meta http-equiv="refresh" content="2;url=infoP.php#tourisme" />
			<?php
		}

	}
}
# -------------------------------------------<>

# Modification d'un restaurant ------->
function modifTourisme($idT, $titreTourisme, $photoTourisme, $descriptionTourisme, $lienTourisme){

	global $db;

	if (empty($titreTourisme) || empty($photoTourisme) || empty($descriptionTourisme) || empty($lienTourisme)) {
		echo '<div class="alert alert-danger">Veuillez remplir tous les champs obligatoires</div>';
	} else {

		# Gestion de l'image --------------------------------->
		$extensions_valides = array('jpg', 'jpeg', 'gif', 'png');

		if (!empty($_FILES[$photoTourisme]['name'])) {
			if ($_FILES[$photoTourisme]['error'] > 0){
				$erreur = "Erreur lors du transfert";
			}
			$extension_upload = strtolower(  substr(  strrchr($_FILES[$photoTourisme]['name'], '.') , 1)  );
			$image = 'images/photoTourisme' . $idT . "." . $extension_upload;
			$loc = "../". $image;
			$resultat = move_uploaded_file($_FILES[$photoTourisme]['tmp_name'], $loc);

			$suppressionOldImage = $db->prepare('SELECT imageT FROM tourisme WHERE idT = :idT');
			$suppressionOldImage->execute(array("idT"	=> $idT));
			$supprimerOldImage = $suppressionOldImage->fetch();
			$oldImage = "images/" . $supprimerOldImage['imageT'];

			# Vérifie si le fichier
			if (is_file($oldImage)) {
				unlink($oldImage);
				echo '<div class="alert alert-success">Ancienne image supprimée</div>';
			}

			$img_on_same_folder = 'images/' . $_FILES[$photoTourisme]['name'];
			if (is_file($img_on_same_folder)) {
				if (!copy($img_on_same_folder, $loc)) {
					echo '<div class="alert alert-danger">Transfert échoué ! Veuillez réessayer ou changer de photo.</div>';
				}
			}

			$modificationTourisme = $db->prepare('UPDATE tourisme SET titreT = :titreTourisme, imageT = :photoTourisme, paragrapheT = :descriptionTourisme, lienT = :lienTourisme WHERE idT = :idT;');
			$modifierTourisme = $modificationTourisme->execute(array(
				"titreTourisme"	=> $titreTourisme,
				"photoTourisme"	=> $image,
				"descriptionTourisme"	=> $descriptionTourisme,
				"lienTourisme"	=> $lienTourisme,
				"idT" => $idT
				));

			if (!$modifierTourisme) {
				echo '<div class="alert alert-danger">Non modifié</div>';
			} else {
				echo '<div class="alert alert-success">Modification effectuée</div>';
				?>
				<meta http-equiv="refresh" content="2;url=infoP.php#tourisme" />
				<?php
			}
		} else {
			$modificationTourisme = $db->prepare('UPDATE tourisme SET titreT = :titreTourisme, paragrapheT = :descriptionTourisme, lienT = :lienTourisme WHERE idT = :idT;');
			$modifierTourisme = $modificationTourisme->execute(array(
				"titreTourisme"	=> $titreTourisme,
				"descriptionTourisme"	=> $descriptionTourisme,
				"lienTourisme"	=> $lienTourisme,
				"idT" => $idT
				));

			if (!$modifierTourisme) {
				echo '<div class="alert alert-danger">Non modifié</div>';
			} else {
				echo '<div class="alert alert-success">Modification effectuée</div>';
				?>
				<meta http-equiv="refresh" content="2;url=infoP.php#tourisme" />
				<?php
			}
		}

	}
}
# ---------------------------------------------<>

# Suppression d'un hôtel ------->
function suppressionTourisme($idTourisme, $imgTourisme){
	global $db;

	// Suppression
	unlink('../' . $imgTourisme);


	$suppressionTourisme = $db->prepare('DELETE FROM tourisme WHERE idT = :idT');
	$supprimerTourisme = $suppressionTourisme->execute(array(
		"idT"	=> $idTourisme
		));

	if (!$supprimerTourisme) {
		echo '<div class="alert alert-danger">Non supprimé</div>';
		?>
		<meta http-equiv="refresh" content="2;url=infoP.php#tourisme" />
		<?php
	} else {
		echo '<div class="alert alert-success">Suppression effectuée</div>';
		?>
		<meta http-equiv="refresh" content="2;url=infoP.php#tourisme" />
		<?php
	}

}
# -------------------------------------------<>

# Ajout d'un paragraphe 'Accès à l'IUT ------->
function ajoutAccesWifi($descriptionAccesWiFi, $lienAccesWiFi){
	global $db;

	if (empty($descriptionAccesWiFi) || empty($lienAccesWiFi)) {
		echo '<div class="alert alert-danger">Veuillez remplir les champs (description et lien)</div>';
	} else {

		// Ajout
		$ajoutAccesWifi = $db->prepare('INSERT INTO wifi (descriptionWifi, lienWifi) VALUES (:descriptionAccesWiFi, :lienAccesWiFi)');
		$ajouterAccesWifi = $ajoutAccesWifi->execute(array(
			"descriptionAccesWiFi"	=> $descriptionAccesWiFi,
			"lienAccesWiFi"			=> $lienAccesWiFi
			));

		if (!$ajouterAccesWifi) {
			echo '<div class="alert alert-danger">Non ajouté</div>';
			?>
			<meta http-equiv="refresh" content="2;url=infoP.php#acceswifi" />
			<?php
		} else {
			echo '<div class="alert alert-success">Ajout effectué</div>';
			?>
			<meta http-equiv="refresh" content="2;url=infoP.php#acceswifi" />
			<?php
		}

	}
}
# -------------------------------------------<>

# A la validation du formulaire ------->
function modifAccesWiFi($idAcces, $descriptionAccesWiFi, $lienAccesWiFi){
	global $db;

	$descriptionAccesWiFi = str_replace(array("\r\n","\n"),'\n',$descriptionAccesWiFi);

	if (empty($_POST[$descriptionAccesWiFi]) || empty($_POST[$lienAccesWiFi])) {
		echo '<div class="alert alert-danger">Veuillez remplir les champs</div>';
	} else {
		$modificationAccesWiFi = $db->prepare('UPDATE wifi SET descriptionWifi = :descriptionAccesWiFi, lienWifi = :lienWifi WHERE idWifi = :idAcces;');
		$modifierAccesWiFi = $modificationAccesWiFi->execute(array(
			"descriptionAccesWiFi"	=> $_POST[$descriptionAccesWiFi],
			"lienWifi"	=> $_POST[$lienAccesWiFi],
			"idAcces"	=> $idAcces
			));

		if (!$modifierAccesWiFi) {
			echo '<div class="alert alert-danger">Non modifié</div>';
		} else {
			echo '<div class="alert alert-success">Modification effectuée</div>';
			?>
			<meta http-equiv="refresh" content="1;url=infoP.php#accesWifi" />
			<?php
		}
	}

}
# -------------------------------------------<>

# Suppression d'un hôtel ------->
function suppressionAccesWifi($idWifi){
	global $db;

	// Suppression
	$suppressionAccesWifi = $db->prepare('DELETE FROM wifi WHERE idWifi = :idWifi');
	$supprimerAccesWifi = $suppressionAccesWifi->execute(array(
		"idWifi"	=> $idWifi
		));

	if (!$supprimerAccesWifi) {
		echo '<div class="alert alert-danger">Non supprimé</div>';
		?>
		<meta http-equiv="refresh" content="2;url=infoP.php#acceswifi" />
		<?php
	} else {
		echo '<div class="alert alert-success">Suppression effectuée</div>';
		?>
		<meta http-equiv="refresh" content="2;url=infoP.php#acceswifi" />
		<?php
	}

}
# -------------------------------------------<>

# Ajout d'un restaurant ------->
function ajoutCharte($descriptionCha, $lienCha){
	global $db;

	if (empty($descriptionCha) || empty($lienCha)) {
		echo '<div class="alert alert-danger">Veuillez remplir tous les champs obligatoires</div>';
	} else {

		# Gestion de l'image --------------------------------->
		$extensions_valides = array('pdf');
		// Gestion d'erreur
		if ($_FILES[$lienCha]['error'] > 0){
			$erreur = "Erreur lors du transfert";
		}
		// Récupération de l'extension
		$extension_upload = strtolower(  substr(  strrchr($_FILES[$lienCha]['name'], '.') , 1)  );
		$pdf = 'images/lienCha' . md5(uniqid(rand(), true)) . "." . $extension_upload;
		$loc = "../". $pdf;
		// Stockaque de l'image
		$resultat = move_uploaded_file($_FILES[$lienCha]['tmp_name'], $loc);

		// Ajout
		$ajoutCharte = $db->prepare('INSERT INTO chartes (lienCha, descriptionCha) VALUES (:lienCha, :descriptionCha)');
		$ajouterCharte = $ajoutCharte->execute(array(
			"lienCha"			=> $pdf,
			"descriptionCha"	=> $descriptionCha
			));

		if (!$ajouterCharte) {
			echo '<div class="alert alert-danger">Non ajouté</div>';
			?>
			<meta http-equiv="refresh" content="2;url=infoP.php#chartes" />
			<?php
		} else {
			echo '<div class="alert alert-success">Modification effectuée</div>';
			?>
			<meta http-equiv="refresh" content="2;url=infoP.php#chartes" />
			<?php
		}

	}
}
# -------------------------------------------<>

# Modification d'un restaurant ------->
function modifCharte($idCha, $descriptionCha, $lienCha){

	global $db;

	if (empty($descriptionCha) || empty($lienCha)) {
		echo '<div class="alert alert-danger">Veuillez remplir tous les champs obligatoires</div>';
	} else {

		# Gestion de l'image --------------------------------->
		$extensions_valides = array('pdf');

		if (!empty($_FILES[$lienCha]['name'])) {
			if ($_FILES[$lienCha]['error'] > 0){
				$erreur = "Erreur lors du transfert";
			}
			$extension_upload = strtolower(  substr(  strrchr($_FILES[$lienCha]['name'], '.') , 1)  );
			$pdf = 'images/lienCha' . $idCha . "." . $extension_upload;
			$loc = "../". $pdf;
			$resultat = move_uploaded_file($_FILES[$lienCha]['tmp_name'], $loc);

			$suppressionOldImage = $db->prepare('SELECT lienCha FROM chartes WHERE idCha = :idCha');
			$suppressionOldImage->execute(array("idCha"	=> $idCha));
			$supprimerOldImage = $suppressionOldImage->fetch();
			$oldImage = "images/" . $supprimerOldImage['lienCha'];

			# Vérifie si le fichier
			if (is_file($oldImage)) {
				unlink($oldImage);
				echo '<div class="alert alert-success">Ancien fichier PDF supprimé</div>';
			}

			$img_on_same_folder = 'images/' . $_FILES[$lienCha]['name'];
			if (is_file($img_on_same_folder)) {
				if (!copy($img_on_same_folder, $loc)) {
					echo '<div class="alert alert-danger">Transfert échoué ! Veuillez réessayer ou changer de fichier.</div>';
				}
			}

			$modificationCharte = $db->prepare('UPDATE chartes SET descriptionCha = :descriptionCha, lienCha = :lienCha WHERE idCha = :idCha;');
			$modifierCharte = $modificationCharte->execute(array(
				"descriptionCha"	=> $descriptionCha,
				"lienCha"			=> $pdf,
				"idCha"				=> $idCha
				));

			if (!$modifierCharte) {
				echo '<div class="alert alert-danger">Non modifié</div>';
			} else {
				echo '<div class="alert alert-success">Modification effectuée</div>';
				?>
				<meta http-equiv="refresh" content="2;url=infoP.php#chartes" />
				<?php
			}
		}

	}
}
# ---------------------------------------------<>

# Suppression d'un hôtel ------->
function suppressionCharte($idCha, $lienCha){
	global $db;

	// Suppression
	unlink('../' . $lienCha);


	$suppressionCharte = $db->prepare('DELETE FROM chartes WHERE idCha = :idCha');
	$supprimerCharte = $suppressionCharte->execute(array(
		"idCha"	=> $idCha
		));

	if (!$supprimerCharte) {
		echo '<div class="alert alert-danger">Non supprimé</div>';
		?>
		<meta http-equiv="refresh" content="2;url=infoP.php#chartes" />
		<?php
	} else {
		echo '<div class="alert alert-success">Suppression effectuée</div>';
		?>
		<meta http-equiv="refresh" content="2;url=infoP.php#chartes" />
		<?php
	}

}
# -------------------------------------------<>

# Modification d'un profil ------->
function modifProfil($id, $nom, $prenom, $pseudo, $mail, $mdp) {
	global $db;

	if (empty($nom) || empty($prenom) || empty($pseudo)) {
		echo '<div class="alert alert-danger">Veuillez remplir tous les champs obligatoires</div>';
	} else {
		$modificationProfil = $db->prepare('UPDATE connexion SET nom = :nom, prenom = :prenom, pseudo = :pseudo, mail = :mail, mdp = :mdp WHERE id = :id');
		$modifierProfil = $modificationProfil->execute(array(
			"id"		=> $id,
			"nom"		=> $nom,
			"prenom"	=> $prenom,
			"pseudo"	=> $pseudo,
			"mail"		=> $mail,
			"mdp"		=> $mdp
			));

		if (!$modifierProfil) {
			echo '<div class="alert alert-danger">Impossible de modifier le profil. Veuiller réessayer plus tard !</div>';
			?>
			<meta http-equiv="refresh" content="2;url=profil.php" />
			<?php
		} else {
			echo '<div class="alert alert-success">Modification du profil effectué</div>';
			?>
			<meta http-equiv="refresh" content="2;url=profil.php" />
			<?php
		}
	}

}

?>
