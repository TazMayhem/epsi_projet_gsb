<?php

session_start();

require('fpdf.php');
require('_db.php');


$visiteur = $_SESSION['id'];
$mois = $_SESSION['mois'];

class PDF extends FPDF {

	// En-tête
    function Header() {
        // Logo
        $this->Image('../images/logo.jpg', 90, 6, 30);
    }

    // Pied de page
    function Footer() {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        $this->SetFont('Times', 'I', 8);
        // Numérotation des pages
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }


	
	function afficheFicheFrais($visiteur, $mois, $pdo)
	{
		$req=$pdo->query("SELECT * FROM Visiteur WHERE id='$visiteur'");
    $res=$req->fetch();
    echo $res['nom'];
    
	}
	

}



$fichier = '../pdf/' . $visiteur . $mois . '.pdf';

// Si le fichier n'existe pas encore, on le génère
if (!file_exists($fichier)) {
    // Instanciation de la classe dérivée
    $pdf = new PDF();
    $pdf->afficheFicheFrais($visiteur, $mois, $pdo);
    $pdf->Output($fichier);
    $pdf ->SetXY(330, 25);
    $pdf ->Cell(190,50,"texte dans le cadre",0,0, "L"); 
}


?>