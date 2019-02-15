<?php
	//constantes
	define("HOST","github.com");
	define("DB","pekrzxic_mogo");
	define("USER","pekrzxic_mogo");
	define("PASS","monmogo@1");


	 try{
	 	$bd = new PDO("mysql:host=".HOST.";dbname=".DB,USER,PASS);
	 	$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 	$bd->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'UTF8");
	 } catch (PDOException $e) {

		echo "Une connexion est survenue lors de la connexion à la base de donnees ! <hr>";
		die('Erreur : ' .  $e->getMessage());
	};

?>
