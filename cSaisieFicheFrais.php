<?php 

	require('include/_entete.inc.php');
	require('include/_sommaire.inc.php');
	
	if(isset($_POST['liste'])) {
		header('location: cSaisieFicheFrais.php?type='.$_POST['liste']);
	}
?>
	<div id="contenu" >
      	<?php 
      	if(empty($_GET['type'])) {
      		// Appel de la fonction permettant d'afficher le formulaire de selection
      		select();
      	}
      	
		elseif($_GET['type'] =='forf') {
			// Appel de la fonction permettant d'afficher le formulaire si l'utilisateur a choisi forfaitisés
			// Avec passage en argument de la variable de connexion a la base de données.
			forfaitises($pdo);
			if(isset($_POST['valide'])){
			ajouterforfait($pdo);
			}
		}

		elseif($_GET['type'] == 'hforf') {
			// Dans les derniers cas, nous appelons la fonction lié a un formulaire non forfaitisés
			non_forfaitises($pdo);
		}

		if(isset($_GET['etape'])) {
			supprimerligne($pdo,$_GET['idLigneHF']);
			header('Location:cSaisieFicheFrais.php');
		}

		if(isset($_POST['cmd'])) {
			$id = $_SESSION['id'];
			$date1 = $_POST['txtDateHF'];
			$mois = date("Ym");
			$date1 = $_POST['txtDateHF'];
			$date = date("Y/m/d", strtotime($date1));

			$libelle = $_POST['txtLibelleHF'];
			$montant = $_POST['txtMontantHF'];
			ajouterhorsforfait($pdo,$id,$mois,$date,$libelle,$montant);

		}

		?>
		
	


 	</div>
<?php 
	require('include/_pied.inc.html');
?>