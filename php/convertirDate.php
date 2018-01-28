 <?php
 function convertirDate($dateAConvertir){
	//converti la date  lettre en anglais ex :en "Monday 12 january"
 	$dateConvertiEnAnglais=strftime("%A %d %B", strtotime($dateAConvertir));
	//coupe la date en  différente parties selon le caractère espace.
 	$chaine = explode(" ", $dateConvertiEnAnglais);

	//converti le jour en lettre
 	$jourEnLettre="";
 	switch($chaine[0]){
 		case "Monday": $jourEnLettre="Lundi"; break;
 		case "Tuesday": $jourEnLettre="Mardi";break;
 		case "Wednesday": $jourEnLettre="Mercredi";break;
 		case "Thursday": $jourEnLettre="Jeudi";break;
 		case "Friday": $jourEnLettre="Vendredi";break;
 		case "Saturday": $jourEnLettre="Samedi";break;
 		case "Sunday": $jourEnLettre="Dimanche";break;
 		default: $jourEnLettre="aucun jour de la semaine. $chaine[0]";
 	}
	$numero= trim_signum($chaine[1]); // numuero du jour
	//converti le mois en lettre
	$moisEnLettre="";
	switch($chaine[2]){
		case "January": $moisEnLettre="Janvier";break;
		case "February": $moisEnLettre="Février";break;
		case "March": $moisEnLettre="Mars";break;
		case "April": $moisEnLettre="Avril";break;
		case "May": $moisEnLettre="Mai";break;
		case "June": $moisEnLettre="Juin";break;
		case "July": $moisEnLettre="Juillet";break;
		case "August": $moisEnLettre="Août";break;
		case "September": $moisEnLettre="Septembre";break;
		case "October": $moisEnLettre="Octobre";break;
		case "November": $moisEnLettre="Novembre";break;
		case "December": $moisEnLettre="Décembre";break;
		default : $moisEnLettre="aucun mois de l'année";
	}
	$dateconvertie="$jourEnLettre $numero $moisEnLettre";
	return $dateconvertie;
}
?>
