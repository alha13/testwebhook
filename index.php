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
	$sql1 = "SELECT * FROM `azo` WHERE `nom` = :nom";

					$query1 = $bd->prepare($sql1);
					$query1->execute(array(
						'nom' => $text,
					));
			$aut_resultat = $query1->fetch();

echo $aut_resultat['prenom'];

	switch ($text) {
		case 'aqs':
			// $speech = "Hi, Nice to meet you";
			 $speech = "Liste des *pharmacies de garde à Bouaflé*.\n_____________________________________ \n https://www.numelion.com/wp-content/uploads/2013/09/comment-utiliser-json-dans-php.jpg \n Ouattara";

			break;

		case $aut_resultat['nom']:
			$speech = $aut_resultat['prenom'];
			break;

		case 'anything':
			$speech = "Yes, you can type anything here.";
			break;

		default:
			$speech = " 11 Désolé, je n'ai pas compris ça. S'il vous plaît demandez-moi quelque chose d'autre.";
			break;
	}

	$response = new \stdClass();
	$response->speech = $speech;
	$response->displayText = $speech;
	$response->source = "webhook";
	echo json_encode($response);
}
else
{
	echo " <br> Acees a ghit mais pas au case";
}

?>
