<?php
	# A la validation du formulaire
if (isset($_POST['modifierac2'])) {

	$id = $_POST['idp'];
	$textId = $_POST['textac2'];
	$lmId = 'lmac2';
	$ajd = date("Y-m-d");

	if (empty($textId)) {
		echo '<div class="danger">Veuillez remplir les champs</div>';
	} else {
		/* Gestion de l'image */
		$extensions_valides = array('jpg', 'jpeg', 'gif', 'png');

		if (!empty($_FILES[$lmId]['name'])) {
			if ($_FILES[$lmId]['error'] > 0){
				$erreur = "Erreur lors du transfert";
			}
			$extension_upload = strtolower(  substr(  strrchr($_FILES[$lmId]['name'], '.')  ,1)  );
			$image = 'images/' . $id . "." . $extension_upload;
			$loc = "/". $image;
			$resultat = move_uploaded_file($_FILES[$lmId]['tmp_name'], $loc);

			$supprEx = $db->prepare('SELECT lienPlus FROM paragraphes WHERE id = :idp');
			$supprEx->execute(array(
				"idp"	=> $id
				));
			$sup = $supprEx->fetch();
			$exImg = "/" . $sup['lienPlus'];

				# Vérifie si le fichier
			if (is_file($exImg)) {
				unlink($exImg);
			}
			$img_on_same_folder = '/images/' . $_FILES[$lmId]['name'];
			if (is_file($img_on_same_folder)) {
				if (!copy($img_on_same_folder, $loc)) {
					echo '<div class="danger">Transfert échoué ! Veuillez réessayer ou changer de photo.</div>';
				}
			}

			$modifIA = $db->prepare('UPDATE paragraphes SET texte = :txt, lienPlus = :lp, dateModif = :dt WHERE id = :id;');
			$modExe = $modifIA->execute(array(
				"txt"	=> $textId,
				"lp"	=> $image,
				"dt"	=> $ajd,
				"id"	=> $id
				));

			if (!$modExe) {
				echo "Non modifié";
			} else {
				echo '<div class="success">Modification effectuée</div>';
				?>
				<meta http-equiv="refresh" content="2;url=accueil.php">
				<?php
			}
		} else {
			$modifIA = $db->prepare('UPDATE paragraphes SET texte = :txt, dateModif = :dt WHERE id = :id;');
			$modExe = $modifIA->execute(array(
				"txt"	=> $textId,
				"dt"	=> $ajd,
				"id"	=> $id
				));

			if (!$modExe) {
				echo "Non modifié";
			} else {
				echo '<div class="success">Modification effectuée</div>';
				?>
				<meta http-equiv="refresh" content="2;url=accueil.php">
				<?php
			}
		}
		
	}
}


/******************************************************************************************************/
/******************************************************************************************************/
/******************************************************************************************************/
/******************************************************************************************************/


		# A la validation du formulaire
if (isset($_POST['modifierac3'])) {

	$id = $_POST['idp'];
	$textId = $_POST['textac3'];
	$lmId = 'lmac3';
	$ajd = date("Y-m-d");

	if (empty($textId)) {
		echo '<div class="danger">Veuillez remplir les champs</div>';
	} else {
		/* Gestion de l'image */
		$extensions_valides = array('jpg', 'jpeg', 'gif', 'png');

		if (!empty($_FILES[$lmId]['name'])) {
			if ($_FILES[$lmId]['error'] > 0){
				$erreur = "Erreur lors du transfert";
			}
			$extension_upload = strtolower(  substr(  strrchr($_FILES[$lmId]['name'], '.')  ,1)  );
			$image = 'images/' . $id . "." . $extension_upload;
			$loc = "/". $image;
			$resultat = move_uploaded_file($_FILES[$lmId]['tmp_name'], $loc);

			$supprEx = $db->prepare('SELECT lienPlus FROM paragraphes WHERE id = :idp');
			$supprEx->execute(array(
				"idp"	=> $id
				));
			$sup = $supprEx->fetch();
			$exImg = "/" . $sup['lienPlus'];

				# Vérifie si le fichier
			if (is_file($exImg)) {
				unlink($exImg);
			}
			$img_on_same_folder = '/images/' . $_FILES[$lmId]['name'];
			if (is_file($img_on_same_folder)) {
				if (!copy($img_on_same_folder, $loc)) {
					echo '<div class="danger">Transfert échoué ! Veuillez réessayer ou changer de photo.</div>';
				}
			}

			$modifIA = $db->prepare('UPDATE paragraphes SET texte = :txt, lienPlus = :lp, dateModif = :dt WHERE id = :id;');
			$modExe = $modifIA->execute(array(
				"txt"	=> $textId,
				"lp"	=> $image,
				"dt"	=> $ajd,
				"id"	=> $id
				));

			if (!$modExe) {
				echo "Non modifié";
			} else {
				echo '<div class="success">Modification effectuée</div>';
				?>
				<meta http-equiv="refresh" content="2;url=accueil.php">
				<?php
			}
		} else {
			$modifIA = $db->prepare('UPDATE paragraphes SET texte = :txt, dateModif = :dt WHERE id = :id;');
			$modExe = $modifIA->execute(array(
				"txt"	=> $textId,
				"dt"	=> $ajd,
				"id"	=> $id
				));

			if (!$modExe) {
				echo "Non modifié";
			} else {
				echo '<div class="success">Modification effectuée</div>';
				?>
				<meta http-equiv="refresh" content="2;url=accueil.php">
				<?php
			}
		}
		
	}
}


/******************************************************************************************************/
/******************************************************************************************************/
/******************************************************************************************************/
	/******************************************************************************************************/	# A la validation du formulaire
	if (isset($_POST['modifierac4'])) {

		$id = $_POST['idp'];
		$textId = $_POST['textac4'];
		$lmId = 'lmac4';
		$ajd = date("Y-m-d");

		if (empty($textId)) {
			echo '<div class="danger">Veuillez remplir les champs</div>';
		} else {
			/* Gestion de l'image */
			$extensions_valides = array('jpg', 'jpeg', 'gif', 'png');

			if (!empty($_FILES[$lmId]['name'])) {
				if ($_FILES[$lmId]['error'] > 0){
					$erreur = "Erreur lors du transfert";
				}
				$extension_upload = strtolower(  substr(  strrchr($_FILES[$lmId]['name'], '.')  ,1)  );
				$image = 'images/' . $id . "." . $extension_upload;
				$loc = "/". $image;
				$resultat = move_uploaded_file($_FILES[$lmId]['tmp_name'], $loc);

				$supprEx = $db->prepare('SELECT lienPlus FROM paragraphes WHERE id = :idp');
				$supprEx->execute(array(
					"idp"	=> $id
					));
				$sup = $supprEx->fetch();
				$exImg = "/" . $sup['lienPlus'];

				# Vérifie si le fichier
				if (is_file($exImg)) {
					unlink($exImg);
				}
				$img_on_same_folder = '/images/' . $_FILES[$lmId]['name'];
				if (is_file($img_on_same_folder)) {
					if (!copy($img_on_same_folder, $loc)) {
						echo '<div class="danger">Transfert échoué ! Veuillez réessayer ou changer de photo.</div>';
					}
				}

				$modifIA = $db->prepare('UPDATE paragraphes SET texte = :txt, lienPlus = :lp, dateModif = :dt WHERE id = :id;');
				$modExe = $modifIA->execute(array(
					"txt"	=> $textId,
					"lp"	=> $image,
					"dt"	=> $ajd,
					"id"	=> $id
					));

				if (!$modExe) {
					echo "Non modifié";
				} else {
					echo '<div class="success">Modification effectuée</div>';
					?>
					<meta http-equiv="refresh" content="2;url=accueil.php">
					<?php
				}
			} else {
				$modifIA = $db->prepare('UPDATE paragraphes SET texte = :txt, dateModif = :dt WHERE id = :id;');
				$modExe = $modifIA->execute(array(
					"txt"	=> $textId,
					"dt"	=> $ajd,
					"id"	=> $id
					));

				if (!$modExe) {
					echo "Non modifié";
				} else {
					echo '<div class="success">Modification effectuée</div>';
					?>
					<meta http-equiv="refresh" content="2;url=accueil.php">
					<?php
				}
			}
			
		}
	}


	/******************************************************************************************************/
	/******************************************************************************************************/
	/******************************************************************************************************/
	/******************************************************************************************************/

	?>