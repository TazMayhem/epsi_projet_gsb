<?php 
	
	require('include/_entete.inc.php');
	require('include/_sommaire.inc.php');
	if($_SESSION['rank'] == 1) { 
		if(isset($_POST['ok'])){
			if((isset($_POST['nomvis'])) AND (isset($_POST['date'])) AND (empty($_POST['hfLib']))) {
				header('Location:valide.php?id='.$_POST['nomvis'].'&mois='.$_POST['date']);
			}
			if(isset($_POST['situ'])){
				$id = $_GET['id'];
				$mois = $_GET['mois'];
				$etat = $_POST['situ'];
				$pdo->exec("UPDATE `lignefraisforfait` SET `etat`='$etat' WHERE `idVisiteur` = '$id' AND `mois`= $mois");
			}
		}

?>


<div id="contenu">
<h2>Validation des Frais</h2>
<form name="formValidFrais" method="post" action="">
	<label class="titre">Choisir le visiteur :</label>
			<select name="nomvis" class="zone">
			<?php
			$sql = $pdo->query("SELECT * FROM visiteur WHERE rank = 0");
			$req = $sql->fetchAll();
			foreach ($req as $key) {
				echo '<option value="'.$key['id'].'">'.$key['nom'].'</option>';
			}
			?>
				
			</select>
	<label class="titre">Mois :</label> <input class="zone" type="text" <?php echo 'value="'.$mois = date("Ym").'"';?> name="date" size="12" />


	<h2 style="margin-top:20px">Frais au forfait </h2><br>
		<table style="color:white;" border="1">
			<tr><th>Repas midi</th><th>Nuitée </th><th>Etape</th><th>Km </th><th>Situation</th></tr>
			<tr align="center">

<?php	
		if(isset($_GET['id'])){				
		$id = $_GET['id'];
		$mois = $_GET['mois'];
							$req = $pdo->query("SELECT * FROM lignefraisforfait WHERE `idVisiteur` = '$id' AND mois = '$mois'");
             				$res = $req->fetchAll();
							foreach ($res as $key) {
                            $idFraisForfait = $key["idFraisForfait"];
                            $quantite = $key["quantite"];
                            if($idFraisForfait == 'ETP') {$libelle = 'Forfait Etape';}
                            else if($idFraisForfait == 'KM') {$libelle = 'Frais Kilométrique';}
                            else if($idFraisForfait == 'NUI') {$libelle = 'Nuitée Hôtel';}
                            else if($idFraisForfait == 'REP') {$libelle = 'Repas Restaurant';}
            echo '
            <td width="80" ><input type="text" disabled size="3"  value = "'.$quantite.'" name="'.$idFraisForfait.'"/></td>
            ';
              } 
              echo '<td><select size="3" name="situ">
						<option value="E">Enregistré</option>
						<option value="V">Validé</option>
						<option value="R">Remboursé</option>
					</select></td>
				</tr></table>';
$req = $pdo->query("SELECT * FROM lignefraishorsforfait WHERE `idVisiteur`='$id' AND `mois` ='$mois'");
    	$res = $req->fetchAll();
    	echo '<h2 style="margin-top:20px">Hors Forfait</h2><br>
		<table style="color:white;" border="1">
			<tr><th>Date</th><th>Libellé </th><th>Montant</th><th>Situation</th></tr>';
     	foreach ($res as $fin ) {
          $date1 = $fin["date"];
          $date = date("d/m/Y", strtotime($date1));
     			echo ' <tr align="center"><td width="100" ><input type="text" size="12" disabled value="'.$date.'" name="hfDate1"/></td>
				<td width="220"><input type="text" size="30" name="hfLib1" disabled value="'.$fin["libelle"].'"/></td> 
				<td width="90"> <input type="text" size="10" name="hfMont1" disabled value ="'.$fin["montant"].'"/></td>
				<td width="80"> 
					<select size="3" name="hfSitu1">
						<option value="E">Enregistré</option>
						<option value="V">Validé</option>
						<option value="R">Remboursé</option>
					</select></td>
				</tr>';
     	}
      echo '</table>'; 
      }?>

		
			
		</table>		
		<div class="titre" style="margin-top:20px" >Nb Justificatifs</div><input type="text" class="zone"name="hcMontant"/>		

		<div style="text-align: center;"><p class="titre" /><label class="titre">&nbsp;</label><input class="zone"type="reset" /><input class="zone"type="submit" name="ok" /></div>
	</form>

</div>



<?php 
} else {echo 'Vous ne pouvez pas acceder a la page'; }
	require('include/_pied.inc.html');

?>