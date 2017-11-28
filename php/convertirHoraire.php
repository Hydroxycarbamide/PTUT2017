<?php
	function convertirHoraire($horaire){
		$verifhoraire = mb_substr($horaire, 0,1);
		if ($verifhoraire > 2){
			$horaire = "0".$horaire;
		}
		return $horaire;
	}
?>
