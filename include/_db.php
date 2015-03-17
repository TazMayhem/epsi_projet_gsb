<?php

	//Paramètres de connexion
	
   $host='localhost';
   $username='root';
   $password='';
   $database='gsb_jpp';
    
	//Définition de la connexion PDO
	
	try {
		
		//Connexion à la base de données
    	$pdo=new PDO('mysql:host='.$host.';dbname='.$database.';charset=utf8',$username,$password); 
	} 
	catch (PDOException $erreur) {
				
		//Affichage des erreurs 
   	echo "Erreur ! : " . $erreur->getMessage() . "<br/>";
   	die();
}