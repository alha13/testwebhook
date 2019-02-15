<?php
	//constantes
	define("HOST","localhost");
	define("DB","u431225321_autos");
	define("USER","u431225321_autos");
	define("PASS","H2aPgC6d");


	 try{
	 	$bd = new PDO("mysql:host=".HOST.";dbname=".DB,USER,PASS);
	 	$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 	$bd->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'UTF8");
	 } catch (PDOException $e) {

		echo "Une connexion est survenue lors de la connexion à la base de donnees ! <hr>";
		die('Erreur : ' .  $e->getMessage());
	};

?>

<?php

$sql1 = "SELECT * FROM `azo` WHERE `id` = :id";

				$query1 = $bd->prepare($sql1);
				$query1->execute(array(
					'id' => 1,
				));
				while ($aut_resultat = $query1->fetch()) {
					<?= $aut_resultat['id'] ?>
					<?= $aut_resultat['nom'] ?>
					<?= $aut_resultat['prenom'] ?>
					<?= $aut_resultat['age'] ?>
				}



 ?>
