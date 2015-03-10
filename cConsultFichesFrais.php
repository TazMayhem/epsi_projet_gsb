<?php 

	require('include/_entete.inc.php');
	require('include/_sommaire.inc.php');
	
	if(isset($_POST['liste'])) {
		header('location: cSaisieFicheFrais.php?type='.$_POST['liste']);
	}
?>
	<div id="contenu" >
      

	<?php
		if(isset($_POST['ok'])) {
			$date = $_POST['lstMois'];
			$mois = substr($date, -2);
			$mois .= ' / ';
			$mois .= substr($date, 0, -2);
		?>


		<?php 
  $id = $_SESSION['id'];
	echo '
	<form action="" method="post">
      	<div class="corpsForm">
           <input type="hidden" name="hd" value="validerSaisie" />
          		<fieldset>
            		<legend>Eléments forfaitisés du moi '.$mois.'</legend>';
     			
             					$req = $pdo->query("SELECT * FROM lignefraisforfait WHERE `idVisiteur` = '$id' AND mois = '$date'");
             					$res = $req->fetchAll();
            
                			foreach ($res as $key) {
                            $idFraisForfait = $key["idFraisForfait"];
                            $quantite = $key["quantite"];
                            if($idFraisForfait == 'ETP') {$libelle = 'Forfait Etape';}
                            else if($idFraisForfait == 'KM') {$libelle = 'Frais Kilométrique';}
                            else if($idFraisForfait == 'NUI') {$libelle = 'Nuitée Hôtel';}
                            else if($idFraisForfait == 'REP') {$libelle = 'Repas Restaurant';}
            echo '
            <p>
              <label for="'.$idFraisForfait.'">*'.$libelle.' : </label>
              <input type="text" id="'.$idFraisForfait.'" 
                    name="'.$idFraisForfait.'" 
                    size="10" maxlength="5"
                    title="Entrez la quantité de l\'élément forfaitisé" 
                    value="'.$quantite.'" disabled />
            </p>'; } 
            
            

?>
			</fieldset>
            </div>
            </form>










	   <table class="listeLegere">
  	   <caption>Descriptif des éléments hors forfait du mois <?php echo $mois; ?></caption>
       </caption>
             <tr>
                <th class="date">Date</th>
                <th class="libelle">Libellé</th>
                <th class="montant">Montant</th>                
             </tr>
             	<?php 


        $id = $_SESSION['id'];
     	$req = $pdo->query("SELECT * FROM lignefraishorsforfait WHERE idVisiteur ='$id' AND mois ='$date'");
    	$res = $req->fetchAll();
     	foreach ($res as $fin ) {
          $date1 = $fin["date"];
          $date = date("d/m/Y", strtotime($date1));
     			echo '<tr>
     			      <td>'.$date.'</td>
                <td>'.$fin["libelle"].'</td>
                <td>'.$fin["montant"].'</td>
              </tr>';
     	}
             	?>
        </table>



		<?php

		} else {
	?>

	  <h2>Mes fiches de frais</h2>
      <h3>Mois à sélectionner : </h3>
      <form action="" method="post" name="frm">
      <div class="corpsForm">
          <input type="hidden" name="hd" value="validerConsult" />
      <p>
        <label for="lstMois">Mois : </label>
        <select id="lstMois" name="lstMois" title="Sélectionnez le mois souhaité pour la fiche de frais">
        	<?php 
        	$id = $_SESSION['id'];
        	$req = $pdo->query("SELECT DISTINCT mois FROM lignefraisforfait WHERE idVisiteur = '$id'");
        	$res = $req->fetchAll();
        	foreach ($res as $key) {
        		echo $an = substr($key['mois'], 0, -2); 
        		$Mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
				$mois = substr($key['mois'], -2);
        		echo '<option value="'.$key['mois'].'">'.$mois.' / '.$an.'</option>';
        	}
        	
        	?>
        </select>
      </p>
      </div>
      <div class="piedForm">
      <p>
        <input id="ok" type="submit" value="Valider" size="20" name="ok"
               title="Demandez à consulter cette fiche de frais" />
        <input id="annuler" type="reset" value="Effacer" size="20" name="br" />
      </p> 
      </div>
        
      </form>
      <?php } ?>
 	</div>
<?php 

	require('include/_pied.inc.html');
?>