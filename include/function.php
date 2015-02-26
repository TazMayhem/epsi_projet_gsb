<?php 
function select() {

	echo '
	<h2 style="margin-bottom:50px;">Sasie Fiche Frais</h2>
		<form action="" method="post" name="frm">
	      		Quel type de saisie voulez-vous faire : 
	      		<select name="liste">
				   <option value="forf">Eléments forfaitisés</option>
				   <option value="hforf">éléments hors forfait</option>
				</select> 
			<input id="ajouter" type="submit" value="Choix" size="20" name="choix" />
		</form>';

}

function forfaitises($pdo){
	$Mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
	$Mois = $Mois[date("n")];
	echo '
<h2 style="margin-bottom:50px;">Sasie Fiche Frais pour le mois de '.$Mois.'</h2>
	<a href="cSaisieFicheFrais.php">Retour</a><br>
	<form action="" method="post">
      	<div class="corpsForm">
           <input type="hidden" name="hd" value="validerSaisie" />
          		<fieldset>
            		<legend>Eléments forfaitisés</legend>';
     			
             					$req = $pdo->query("SELECT * FROM fraisforfait ");
             					$res = $req->fetchAll();
                			$libelle = $res["libelle"];
                			echo '<p><label for="">* '.$libelle.': </label>';
                			
	              				echo '<input type="text" id="'.$idFraisForfait.'" 
			                    	name="txtEltsForfait['.$idFraisForfait.']" 
			                   		size="10" maxlength="5"
			                   	 	title="Entrez la quantité de l\'élément forfaitisé" 
			                    	value="'.$quantite.'" />
			           				</p>';
	     				
	     				
      	echo'	
          		</fieldset>
      	</div>
     	<div class="piedForm">
     		<p>
        	   <input id="ok" type="submit" value="Valider" size="20" 
               title="Enregistrer les nouvelles valeurs des éléments forfaitisés" />
        	   <input id="annuler" type="reset" value="Effacer" size="20" name="br" />
     		</p> 
     	</div>
        
    </form>';
}

function non_forfaitises($pdo){
	echo '
<h2 style="margin-bottom:50px;">Sasie Fiche Frais</h2>
	<a href="cSaisieFicheFrais.php">Retour</a> // <a href="cSaisieFicheFrais.php?type=hforf">Actualisé</a><br>
	<form action="" method="post" name="frm">
      <div class="corpsForm">
          <input type="hidden" name="etape" value="validerAjoutLigneHF" />
          <fieldset>
            <legend>Nouvel élément hors forfait
            </legend>
            <p>
              <label for="txtDateHF">* Date : </label>
              <input type="text" id="txtDateHF" name="txtDateHF" size="12" maxlength="10" 
                     title="Entrez la date d\'engagement des frais au format JJ/MM/AAAA" 
                     value="" />
            </p>
            <p>
              <label for="txtLibelleHF">* Libellé : </label>
              <input type="text" id="txtLibelleHF" name="txtLibelleHF" size="70" maxlength="100" 
                    title="Entrez un bref descriptif des frais" 
                    value="" />
            </p>
            <p>
              <label for="txtMontantHF">* Montant : </label>
              <input type="text" id="txtMontantHF" name="txtMontantHF" size="12" maxlength="10" 
                     title="Entrez le montant des frais (le point est le séparateur décimal)" value="" />
            </p>
          </fieldset>
      </div>
      <div class="piedForm">
      <p>
        <input id="ajouter" type="submit" value="Ajouter" size="20" name="cmd"
               title="Ajouter la nouvelle ligne hors forfait" />
        <input id="effacer" type="reset" value="Effacer" size="20" />
      </p> 
      </div>
        
      </form>

      	<table class="listeLegere">
  	   		<caption>Descriptif des éléments hors forfait
       		</caption>
             <tr>
                <th class="date">Date</th>
                <th class="libelle">Libellé</th>
                <th class="montant">Montant</th>  
                <th class="action">&nbsp;</th>              
             </tr>';

     	$req = $pdo->query("SELECT * FROM lignefraishorsforfait ");
    	$res = $req->fetchAll();
     	foreach ($res as $fin ) {
          $date1 = $fin["date"];
          $date = date("d/m/Y", strtotime($date1));
     			echo '<tr>
     			      <td>'.$date.'</td>
                <td>'.$fin["libelle"].'</td>
                <td>'.$fin["montant"].'</td>
                <td><a href="?etape=validerSuppressionLigneHF&amp;idLigneHF='.$fin["id"].'"
                       onclick="return confirm(\'Voulez-vous vraiment supprimer cette ligne de frais hors forfait ?\');"
                       title="Supprimer la ligne de frais hors forfait">Supprimer</a></td>
              </tr>';
     	}
      echo '</table>';
      
}

function supprimerligne($pdo,$num) {

      $pdo->exec("delete from LigneFraisHorsForfait where id = ".$num);

}

function ajouterhorsforfait($pdo,$id,$mois,$date,$libelle,$montant){
      $pdo->exec("INSERT INTO LigneFraisHorsForfait(idVisiteur, mois, date, libelle, montant) 
                  VALUES ('" . $id . "','" . $mois . "','" . $date . "','" . $libelle . "'," . $montant .")");

}

function ajouterforfait(){
       if(isset($_POST['br'])) {
            echo $_POST[''];
       }
}
?>