<?php 
	require('include/_entete.inc.php');
	require('include/_sommaire.inc.php'); ?>
	<div id="contenu">

<?php
	if($_GET['type'] != ''){

		$type = $_GET['type'];
		$lib = $_GET['libelle'];
		$montant = $_GET['montant'];
		$personne = $_SESSION['recherche'];
		$mois = $_SESSION['recherche1'];

			if($type == 'E') {
				$pdo->exec("UPDATE `lignefraishorsforfait` SET `etat`='Enregistré' WHERE `idVisiteur` = '$personne' AND `montant` = '$montant' AND `libelle` = '$lib'");
				header('Location:valide.php?id='.$personne.'&mois='.$mois);
			}

			if($type == 'V') {
				$pdo->exec("UPDATE `lignefraishorsforfait` SET `etat`='Validé' WHERE `idVisiteur` = '$personne' AND `montant` = '$montant' AND `libelle` = '$lib'");
				header('Location:valide.php?id='.$personne.'&mois='.$mois);
			}

			if($type == 'R') {
				$pdo->exec("UPDATE `lignefraishorsforfait` SET `etat`='Remboursé' WHERE `idVisiteur` = '$personne' AND `montant` = '$montant' AND `libelle` = '$lib'");
				header('Location:valide.php?id='.$personne.'&mois='.$mois);
			}

			if($type == 'A') {
				$sql = $pdo->query("SELECT libelle FROM lignefraishorsforfait WHERE `idVisiteur` = '$personne' AND `montant` = '$montant' AND `libelle` = '$lib'");
				$rep = $sql->fetch();
				$libelle = '[Refusé]'.$rep['libelle'];
				$pdo->exec("UPDATE `lignefraishorsforfait` SET `etat`='Refusé', `libelle`='$libelle' WHERE `idVisiteur` = '$personne' AND `montant` = '$montant' AND `libelle` = '$lib'");
				header('Location:valide.php?id='.$personne.'&mois='.$mois);
			}

	}else {
		echo 'Action non permis';
	}
echo '</div>';
require('include/_pied.inc.html');
?>