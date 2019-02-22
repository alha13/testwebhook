<?php
include('database.php');

		//echo $aut_resultat['id'];
	?>

<?php
$method = $_SERVER['REQUEST_METHOD'];

// Process only when method is POST
if($method == 'POST'){
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);

	$text = $json->result->parameters->text;

	//echo $text;
	//$GET['enter'] = 'AZO';
	$sql1 = "SELECT * FROM `azo` WHERE `nom` LIKE :nom LIMIT 50";

					$query1 = $bd->prepare($sql1);
					$query1->execute(array(
						'nom' => $text,
					));


// echo $aut_resultat['prenom'];

	switch ($text) {
		case 'aqs':
			// $speech = "Hi, Nice to meet you";
			 $speech = "Liste des *pharmacies de garde à Bouaflé*.\n_____________________________________ \n";
			 //$imageUrl = "https://assistant.google.com/static/images/molecule/Molecule-Formation-stop.png";
			break;

		case $text:
		while ($aut_resultat = $query1->fetch() ) {
			$msg = $aut_resultat['prenom']." coûte ".$aut_resultat['age'];
		}
		$speech = $msg;
			break;

		case 'anything':
			$speech = "Yes, you can type anything here.";
			break;

		default:
			$speech = " 11 Désolé, je n'ai pas compris ça. S'il vous plaît demandez-moi quelque chose d'autre.";
			break;
	}

	$response = new \stdClass();

	// {
	// "speech": "this text is spoken out loud if the platform supports voice interactions",
	// "displayText": "this text is displayed visually",

	$body = '{
	  "type": 1,
	  "title": "card title",
	  "subtitle": "card text",
	  "imageUrl": "https://assistant.google.com/static/images/molecule/Molecule-Formation-stop.png"
	}';
	//$response->source = $source;
	//echo $body;
	$response->speech = $speech;
	$response->displayText = $speech;

	//$response->messages = $body;
	$response->messages->imageUrl = "https://assistant.google.com/static/images/molecule/Molecule-Formation-stop.png";

	$response->source = "webhook";
	echo json_encode($response);
}
else
{
	echo " <br> Acees a ghit mais pas au case";
}

?>
