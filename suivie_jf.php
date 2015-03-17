<?php 
	
	require('include/_entete.inc.php');
	require('include/_sommaire.inc.php');
	$visiteur = $_SESSION['id'];
	if(isset($_GET['mois'])){
	$mois = $_GET['mois'];
	}

	if(isset($_POST['search'])){
		header('Location:suivie.php?mois='.$_POST['search']);
	}
?>


<div id="contenu">
	<?php if(empty($_GET['mois'])){ ?>
	<form name="formConsultFrais" method="post" action="">
		<h1> Suivie fiche frais </h1>
			<label class="titre" >Mois/Année :</label> <input name="search" class="zone" type="text" name="dateConsult" size="12" />
			<input  class="zone"type="submit" value="Chercher" />
	</form>
	<?php }else {?>
		
		
		<h2>Frais au forfait </h2>
		<table style="color:white;" border="1">
			<tr><th>Repas midi</th><th>Nuitée </th><th>Etape</th><th>Km </th><th>Situation</th><th>Date opération</th><th>Remboursement</th></tr>
			<tr align="center"><td width="80"><label  size="3" name="repas"/></td>
				<td width="80"><label size="3" name="nuitee"/></td> 
				<td width="80"> <label size="3" name="etape"/></td>
				<td width="80"> <label size="3" name="km" /></td>
				<td width="80"> <label size="3" name="situation" /></td>	
				<td width="80"> <label size="3" name="dateOper" /></td>	
				<td width="80"> <label size="3" name="dateOper" /></td>						
			</tr>
			<?php 

				$req=$pdo->query("SELECT * FROM `lignefraisforfait` WHERE `idVisiteur` = '$visiteur' AND `mois` = '$mois'");
				$res=$req->fetchAll();
				foreach ($res as $key) {
                            $idFraisForfait = $key["idFraisForfait"];
                            $quantite = $key["quantite"];
                            if($idFraisForfait == 'ETP') {$libelle = 'Forfait Etape';}
                            else if($idFraisForfait == 'KM') {$libelle = 'Frais Kilométrique';}
                            else if($idFraisForfait == 'NUI') {$libelle = 'Nuitée Hôtel';}
                            else if($idFraisForfait == 'REP') {$libelle = 'Repas Restaurant';}
            echo '
            <td width="80" ><center><input type="text" disabled size="5"  value = "'.$quantite.'" name="'.$idFraisForfait.'"/></center></td>';
            
          
       
        }
        	if(isset($res['etat'])){
            	echo '<td><center><input type="text" disabled size="5"  value = "Non defini"/></center></td>';
            }else {
            	echo '<td><center><input type="text" disabled size="5"  value = "'.$key['etat'].'"/></center></td>';
            }
			?>
			<td><center><input type="text" disabled size="5"  value = "Date"/></center></td>
			<td><center><input type="text" disabled size="15"  value = "Remboursement"/></center></td>
		</table>
		<br>


<?php	$req = $pdo->query("SELECT * FROM lignefraishorsforfait WHERE `idVisiteur`='$visiteur' AND `mois` ='$mois'");
    	$res = $req->fetchAll(); 
		echo '<h2>Hors Forfait</h2><table style="color:white;" border="1">
		<tr><th>Date</th><th>Libellé </th><th>Montant</th><th>Situation</th><th>Date opération</th></tr>';
     	foreach ($res as $fin ) {
          $date1 = $fin["date"];
          $date = date("d/m/Y", strtotime($date1)); ?>

     			<tr align="center"><td width="100" ><input type="text" size="12" disabled value="<?php echo $date ?>" name="hfDate1"/></td>
				<td width="220"><input type="text" size="30" name="id" disabled value="<?php echo $fin["libelle"] ?>"/></td> 
				<td width="90"> <input type="text" size="10" name="hfMont" disabled value ="<?php echo $fin["montant"] ?>"/></td>
				<td width="90"> <input type="text" size="10" name="hfMont" disabled value ="<?php echo $fin["etat"] ?>"/></td>	
				<td width="90"> <input type="text" size="10" name="hfMont" disabled value ="Date"/>
			<?php  }?>
		
			
		</tr></table>	
		<p class="titre"></p>
		<div class="titre">Nb Justificatifs</div><input type="text" class="zone" size="4" name="hcMontant"/>
	<?php } ?>
</div>

<?php 
	require('include/_pied.inc.html');
?>