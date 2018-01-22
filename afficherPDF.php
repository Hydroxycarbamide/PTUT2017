<?php
require("php/connexion.php");
//présentation colloque
$presentation=$db-> prepare('SELECT sousTitrePC,textePC,idPC FROM presentationColloque;');
$presentationExecute=$presentation->execute();
$presentationColloque=$presentation->fetchAll();

//jours du collloque
$dateAteliers = $db-> prepare('SELECT * FROM joursColloque');
$dateAteliersExecute=$dateAteliers->execute();
$datesA=$dateAteliers->fetchAll();

//ateliers
$Atelier = $db-> prepare('SELECT * FROM ateliers');
$AtelierExecute=$Atelier ->execute();
$ateliers=$Atelier->fetchAll();

//conférences
$conferences= $db-> prepare('SELECT * FROM conferences');
$ConférencesExecute=$conferences ->execute();
$conference=$conferences->fetchAll();

//intervenants
$intervenants= $db-> prepare('SELECT * FROM intervenants');
$intervenantsExecute=$intervenants ->execute();
$intervenant=$intervenants->fetchAll();

//avec  la class à télécharger : fphp
require('fpdf/fpdf.php');
//les pages sont en portrait A4 et l unité de mesure est le millimètre.
$pdf = new FPDF('P','mm','A4');
//ajoute une page dans le PDF
$pdf->AddPage();

class PDF extends FPDF
{
	// En-tête
	function Header()
	{
		// Logo
		$this->Image('images/apliut-logo.jpg',10,6,20);
		// Police Arial gras 22
		$this->SetFont('Arial','B',22);
		// Décalage à droite
		$this->Cell(80);
		// Titre
		$this->Cell(30,10,utf8_decode("40e édition du congrès de l'APLIUT !"),0,0,'C');
		// Saut de ligne
		$this->Ln(20);
	}

	// Pied de page
	function Footer()
	{
		// Positionnement à 1,5 cm du bas
		$this->SetY(-15);
		// Police Arial italique 8
		$this->SetFont('Arial','I',8);
		// Numéro de page. pageNo()= numero de page actuelle/nb de page totale
		$this->Cell(0,10,utf8_decode("Créé par glassite. Modifié par le groupe de projet tuteuré 2017.  ").$this->PageNo().'/{nb}',0,0,'C');
	}


	//corps de texte
	function CorpsChapitre($texte)
	{
		// Lecture du fichier texte
		$txt = $texte;
		// Arial 12 et couleur noir
		$this->SetFont('Arial','',12);
		$this->SetTextColor(0);
		// Sortie du texte justifié
		$this->MultiCell(0,5,utf8_decode($texte));
		// Saut de ligne
		$this->Ln();
	}
	//creer unn lien
	function PutLink($URL, $txt)
	{
		// Place un hyperlien
		$this->SetTextColor(0,0,255);
		$this->SetFont('Arial','U',12);
		$this->Write(5,utf8_decode($txt),$URL);
		$this->SetTextColor(0);
	}
	//afficher  sous titre
	function Titre($txt)
	{
		$this->Ln(50);
		//couleur du tetxe
		$this->SetTextColor(255,0,0);
		//police d'écriture
		$this->SetFont('Arial','B',21);
		// Couleur de fond
		$this->SetFillColor(255,255,255);
		//afficher texte : largeur cellule, hauteur, texte à afficher, bordure ou pas,  texte centré, fons transparent
		$this->MultiCell(190,20,utf8_decode($txt),0,'C',false);
		$this->SetTextColor(0);
	}
	//titres des parties
	function sousTitre($txt)
	{
		//couleur du tetxe
		$this->SetTextColor(255,0,0);
		//police d'écriture
		$this->SetFont('Arial','B',18);
		// Couleur de fond blanc
		$this->SetFillColor(255,255,255);
		//afficher texte : largeur cellule, hauteur, texte à afficher, bordure ou pas,  texte centré, fons transparent
		$this->MultiCell(190,20,utf8_decode($txt),0,'C',false);
		$this->SetTextColor(0);
		//saut de ligne
		$this->Ln(10);
	}
	//titre des ateliers/conférences
	function titreAteliersConf($txt)
	{
		//couleur du tetxe
		$this->SetTextColor(0,0,0);
		//police d'écriture
		$this->SetFont('Arial','B',16);
		// Couleur de fond blanc
		$this->SetFillColor(255,255,255);
		//afficher texte : largeur cellule, hauteur, texte à afficher, bordure ou pas,  texte centré, fons transparent
		$this->MultiCell(190,10,utf8_decode($txt),0,'C',false);
		$this->SetTextColor(0);
	}
	//titre des ateliers/conférences
	function SoustitreAteliersConf($txt)
	{
		//couleur du tetxe
		$this->SetTextColor(0,0,0);
		//police d'écriture
		$this->SetFont('Arial','B',14);
		// Couleur de fond blanc
		$this->SetFillColor(255,255,255);
		//afficher texte : largeur cellule, hauteur, texte à afficher, bordure ou pas,  texte centré, fons transparent
		$this->MultiCell(190,5,utf8_decode($txt),0,'C',false);
		$this->SetTextColor(0);
	}
}


$pdf = new PDF();// Instanciation de la classe dérivée
$pdf->AliasNbPages();
$pdf->AddPage();
//afficher TITRE
$pdf->Titre("40e édition du congrès \n de l'APLIUT 2018 \n à l'IUT Informatique de Rangueil à Toulouse. \n");
//cherche la date de debut et de fin
foreach($datesA as $dateA){
	if($dateA[0]==0){
		$datedebut=$dateA[1];
	}
	if($dateA[0]==2){
		$datefin=$dateA[1];
	}
}
$pdf->SetFont('Arial','',16);
$pdf->Ln(10);
$pdf->SoustitreAteliersConf("Du $datedebut au $datefin ");


//2e page : sommaire
$pdf->AddPage();
//lien présentation colloque
$pdf->putLink('http://intra.info.iut-tlse3.fr/~ptute3b/afficherPDF.php#page=4','Présentation du congrès 2018 ');
//saut de ligne
$pdf->Ln(5);
//lien pour chaque atelier
foreach($datesA as $D){
	$pdf->SetFont('Arial','',12);
	$pdf->Ln(5);
	$pdf->MultiCell(0,5,utf8_decode("Ateliers du $D[1] \n"));

	foreach($ateliers as $A){
		//si l'atelier à lieu ce jour la
		if($D[1]==$A[3]){
			//titre de l'atelier
			$pdf->Ln(1);
			//$pdf->MultiCell(0,5,$pdf->putLink('http://intra.info.iut-tlse3.fr/~ptute3b/afficherPDF.php#page=6',"$A[4]"));
		}
	}
}
//saut de ligne
$pdf->Ln(5);
//lien pour chaque conférences triés par jours
foreach($datesA as $D){
	$pdf->SetFont('Arial','',12);
	$pdf->Ln(5);
	$pdf->MultiCell(0,5,utf8_decode("Conférences du $D[1] \n"));

	foreach($conference as $A){
		//si la conference à lieu ce jour la
		if($D[1]==$A[3]){
			//titre de la conférence
			$pdf->Ln(1);
			//$pdf->MultiCell(0,5,$pdf->putLink('http://intra.info.iut-tlse3.fr/~ptute3b/afficherPDF.php#page=13',"$A[4]"));
		}
	}
}

//affiche la présentation du congrès sur une nouvelle page
$pdf->AddPage();
foreach($presentationColloque as $pre){
	//sous titres
	$pdf->sousTitre($pre[0]);
	//textes
	$pdf->CorpsChapitre($pre[1]);
}


//Ateliers sur une nouvelle page
$pdf->AddPage();
$pdf->sousTitre("LES ATELIERS");

//parcours les dates du colloque et les ateliers
foreach($datesA as $date){
	foreach($ateliers as $atelier){
		//si l'atelier à lieu ce jour la
		if($date[1]==$atelier[3]){
			//titre de l'atelier
			$pdf->titreAteliersConf($atelier[4]);
			//date de l'atelier
			$pdf->SoustitreAteliersConf("Cet atelier aura lieu le $atelier[3] à  $atelier[1]");
			//intervenant
			$pdf->SoustitreAteliersConf("Cet atelier sera encadré par $atelier[6]");
			//salle
			$pdf->SoustitreAteliersConf("Cet atelier se déroulera dans la salle $atelier[2]");
			//description
			$pdf->CorpsChapitre($atelier[5]);
		}
	}
}



//4e page affiche Conférences
$pdf->AddPage();
$pdf->sousTitre("LES CONFERENCES");

//parcours les dates du colloque et les conférence
foreach($datesA as $date){
	foreach($conference as $conf){
		//si la conference à lieu ce jour la
		if($date[1]==$conf[3]){
			//titre de la conference
			$pdf->titreAteliersConf($conf[4]);
			//date de la conference
			$pdf->SoustitreAteliersConf("Cette conférence aura lieu le $conf[3] à  $conf[1]");
			// trouver identité intervenant
			foreach($intervenant as $inter){
				if($inter[0]==$conf[6]){
					$pdf->SoustitreAteliersConf("Cette conférence sera encadré par $inter[1] $inter[2]");
				}
			}
			//salle
			$pdf->SoustitreAteliersConf("Cette conférence se déroulera dans la salle $conf[2]");
			//description
			$pdf->CorpsChapitre($conf[5]);
		}
	}
}


// affiche intervenants sur une nouvelle page
$pdf->AddPage();
$pdf->sousTitre("LES INTERVENANTS");

//parcours des intervenants
foreach($intervenant as $inter){
	//nom prénom de l'intervenant
	$pdf->titreAteliersConf("$inter[1] $inter[2]");
	//biographie
	$pdf->CorpsChapitre($inter[3]);
}
//page de fin
$pdf->AddPage();
$pdf->Titre("Nous vous souhaitons un bon congrès !");

$html = '<a href="#conference">conf</a>';
$pdf->write(5,$html);


//sortie sur le navigateur
$pdf->Output();



?>
