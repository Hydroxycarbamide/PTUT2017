<!-- Modifier pdf -->
						<div  style="text-align: left;">
							<div class="present-text">
								<p>
									<em class="em">Lien du PDF contenant le planning: </em>
									<span class="glyphicon glyphicon-file"></span>
									<?php echo str_replace(array("\r\n","\n", '\n'),"<br />", $valeur['lien']); ?>

									<label for="lien">Lien du fichier</label>
									<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
									<input style="display: block;" type="file" name="lien" />

									<input type="submit" name="modifier" value="Modifier le PDF" class="btn btn-primary btn-lg" />
								</p>
							</div>

			<!-- Formulaire de modification -->




							<?php
								$lien='lien';
								if (isset($_POST['modifier'])) {

									if (empty($lien)) {
										echo '<div class="alert alert-danger">Veuillez remplir tous les champs obligatoires</div>';
									}else {
										unlink('../'.$valeur['lien']);

										$suppressionCharte = $db->prepare('DELETE FROM plan WHERE id = 1');
										$supprimerCharte = $suppressionCharte->execute();

										if (!$supprimerCharte) {
											echo '<div class="alert alert-danger">Probleme lors de la suppression</div>';
										} else {
											echo '<div class="alert alert-success">Suppression de lancien document effectuée</div>';
										}

										# Gestion de l'image --------------------------------->
										$extensions_valides = array('pdf');

										// Gestion d'erreur
										if ($_FILES[$lien]['error'] > 0){
											$erreur = "Erreur lors du transfert";
										}

										// Récupération de l'extension
										$extension_upload = strtolower(  substr(  strrchr($_FILES[$lien]['name'], '.') , 1)  );
										$pdf = 'images/planning'.$_FILES[$lien]['name']."." . $extension_upload;
										$loc = "../". $pdf;

										// Stockaque de l'image
										$resultat = move_uploaded_file($_FILES[$lien]['tmp_name'], $loc);

										// Ajout
										$ajoutCharte = $db->prepare('INSERT INTO plan (lien, boo, id) VALUES (:lien, :boo, 1)');
										$ajouterCharte = $ajoutCharte->execute(array("lien"=> $pdf, "boo"=> $boo));

										if (!$ajouterCharte) {
											echo '<div class="alert alert-danger">Non ajouté</div>';?>
											<meta http-equiv="refresh" content="2;url=accueil.php" /><?php
										} else {
											echo '<div class="alert alert-success">Modification effectuée</div>';?>
											<meta http-equiv="refresh" content="2;url=accueil.php" /><?php
										}
									}
								}
							?>
						</div>
