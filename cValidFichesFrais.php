<?php 
	
	require('include/_entete.inc.php');
	require('include/_sommaire.inc.php');
	
?>


	<form name="formValidFrais" method="post" action="enregValidFrais.php">
		<h1> Validation des frais par visiteur </h1>
		<label class="titre">Choisir le visiteur :</label>
			<select name="lstVisiteur" class="zone"><option value="a131">Villechalane</option></select>			
			<label class="titre">Mois :</label> <input class="zone" type="text" name="dateValid" size="12" />
		<p class="titre" />
		<div style="clear:left;"><h2>Frais au forfait </h2></div>
		<table style="color:white;" border="1">
			<tr><th>Repas midi</th><th>Nuit�e </th><th>Etape</th><th>Km </th><th>Situation</th></tr>
			<tr align="center"><td width="80" ><input type="text" size="3" name="repas"/></td>
				<td width="80"><input type="text" size="3" name="nuitee"/></td> 
				<td width="80"> <input type="text" size="3" name="etape"/></td>
				<td width="80"> <input type="text" size="3" name="km" /></td>
				<td width="80"> 
					<select size="3" name="situ">
						<option value="E">Enregistr�</option>
						<option value="V">Valid�</option>
						<option value="R">Rembours�</option>
					</select></td>
				</tr>
		</table>
		
		<p class="titre" /><div style="clear:left;"><h2>Hors Forfait</h2></div>
		<table border="1">
			<tr><th>Date</th><th>Libell� </th><th>Montant</th><th>Situation</th></tr>
			<tr align="center"><td width="100" ><input type="text" size="12" name="hfDate1"/></td>
				<td width="220"><input type="text" size="30" name="hfLib1"/></td> 
				<td width="90"> <input type="text" size="10" name="hfMont1"/></td>
				<td width="80"> 
					<select size="3" name="hfSitu1">
						<option value="E">Enregistr�</option>
						<option value="V">Valid�</option>
						<option value="R">Rembours�</option>
					</select></td>
				</tr>
		</table>		
		<p class="titre"></p>
		<div class="titre">Nb Justificatifs</div><input type="text" class="zone" size="4" name="hcMontant"/>		
		<p class="titre" /><label class="titre">&nbsp;</label><input class="zone"type="reset" /><input class="zone"type="submit" />
	</form>



<?php 
	require('include/_pied.inc.html');
?>