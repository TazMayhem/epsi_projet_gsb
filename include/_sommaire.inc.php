  <?php      
      if(isset($_SESSION['nom'])) {
  ?>
<div id="menuGauche">
     <div id="infosUtil">
        <h2>
        <?php 
            echo $_SESSION['nom'].' '.$_SESSION['prenom'];
        ?>
        </h2>

    <?php 
        if($_SESSION['rank'] == 0){
    ?>
        <h3>Visiteur médical</h3>        
  
      </div>  

        <ul id="menuList">
           <li class="smenu">
              <a href="cAccueil.php" title="Page d'accueil">Accueil</a>
           </li>
           <li class="smenu">
              <a href="cSeDeconnecter.php" title="Se déconnecter">Se déconnecter</a>
           </li>
           <li class="smenu">
              <a href="cSaisieFicheFrais.php" title="Saisie fiche de frais du mois courant">Saisie fiche de frais</a>
           </li>
           <li class="smenu">
              <a href="cConsultFichesFrais.php" title="Consultation de mes fiches de frais">Mes fiches de frais</a>
           </li>
         </ul>
    <?php } else { ?>
    
       <h3>Comptable médical</h3>        
  
      </div>  

        <ul id="menuList">
           <li class="smenu">
              <a href="cAccueil.php" title="Page d'accueil">Accueil</a>
           </li>
           <li class="smenu">
              <a href="cSeDeconnecter.php" title="Se déconnecter">Se déconnecter</a>
           </li>
           <li class="smenu">
              <a href="cSaisieFicheFrais.php" title="Saisie fiche de frais du mois courant">Saisie fiche de frais</a>
           </li>
           <li class="smenu">
              <a href="cConsultFichesFrais.php" title="Consultation de mes fiches de frais">Mes fiches de frais</a>
           </li>
         </ul>

    <?php } ?>

    </div>
<?php 
  }
  else {
    header('Location:cSeConnecter.php');
  }
?>