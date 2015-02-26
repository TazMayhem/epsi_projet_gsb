<?php 
	require('include/_entete.inc.php');

	if(isset($_POST['cmd'])){
		$login = $_POST['txtLogin'];
		$mdp = $_POST['txtMdp'];

	$req = $pdo->prepare('SELECT * FROM visiteur WHERE login = :pseudo AND mdp = :pass');
	$req->execute(array('pseudo' => $login,'pass' => $mdp));
	$resultat = $req->fetch();
		if (!$resultat) {
	   	$erreur = '<center><font color="red">Mauvais identifiant ou mot de passe !</center></font>';
	    }
		else {
			session_start();
		    $requete=$pdo->query("SELECT * FROM visiteur WHERE login ='$login'");
		    $tache=$requete->fetch(); 
		    $_SESSION['nom']=$tache['nom'];
		    $_SESSION['prenom']=$tache['prenom'];
		    $_SESSION['pseudo']=$tache['login'];
		    header('Location: cAccueil.php');
		}
	}
?>

	<div id="contenu">
      <h2>Identification utilisateur</h2>
	      <?php if(isset($erreur)) {
	      		echo $erreur;
	      }
	      ?>
      <form id="frmConnexion" action="" method="post" name="frm">
      <div class="corpsForm">
        <input type="hidden" name="hd" id="etape" value="validerConnexion" />
      <p>
        <label for="txtLogin" accesskey="n">* Login : </label>
        <input type="text" id="txtLogin" name="txtLogin" maxlength="20" size="15" value="" title="Entrez votre login" />
      </p>
      <p>
        <label for="txtMdp" accesskey="m">* Mot de passe : </label>
        <input type="password" id="txtMdp" name="txtMdp" maxlength="8" size="15" value=""  title="Entrez votre mot de passe"/>
      </p>
      </div>
      <div class="piedForm">
      <p>
        <input type="submit" id="ok" value="Valider" name="cmd" />
        <input type="reset" id="annuler" value="Effacer" name="br" />
      </p> 
      </div>
      </form>
    </div>

<?php 
	require('include/_pied.inc.html');
?>