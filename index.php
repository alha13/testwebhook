<?php
include('database.php');
	?>
<?php
$method = $_SERVER['REQUEST_METHOD'];

// Process only when method is POST
if($method == 'POST'){
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);


//recuperation des variable recu
	$text = $json->result->parameters->text;
	$cle = $json->result->parameters->cle;


//mise en execution des requettes pour la recuperation de donnees BD

//debut recupration prix de medicamants
$sql1 = "SELECT * FROM `Prix_medicamens` WHERE `denomination` LIKE :nom LIMIT 50";

				$query1 = $bd->prepare($sql1);
				$query1->execute(array(
					'nom' => $text."%",
				));

	switch ($text) {

		case $text:
		$msg = "";
		while ($aut_resultat = $query1->fetch() )
		{
			$msg1 = "_".$aut_resultat['denomination']."_ ——> *".$aut_resultat['prix']."f CFA*\n\n";
			$msg = $msg.$msg1;
		}

		$speech = $msg;
		if ($msg=="")
		{
			$speech = "Aucun médicament correspondant trouvé ! Merci de revoir l'ortographe";
		}
			break;


		case 'anything':
			$speech = "Yes, you can type anything here.";
			break;


		default:
			$speech = "Désolé, je n'ai pas compris ça. S'il vous plaît demandez-moi quelque chose d'autre.";
			break;
	}
	//fin recupration prix de medicamants













	//debut recupration meteo
	if(!empty($cle)){
	switch ($cle) {

			case 'azo':
			$speech = "Yes, you can type anything here.";
			break;


		default:
			$speech = "Désolé, je n'ai pas compris ça. S'il vous plaît demandez-moi quelque chose d'autre.";
			break;
	}
}
	//fin recupration meteo










	$response = new \stdClass();

	$response->speech = $speech;
	$response->displayText = $speech;

	$response->source = "Mon_Môgô";



	echo json_encode($response);
}
else
{
	echo " <br> Acees a ghit mais pas au case";
}


?>
