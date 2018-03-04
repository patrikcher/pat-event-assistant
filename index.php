<?php 

$method = $_SERVER['REQUEST_METHOD'];

// Process only when method is POST
if($method == 'POST'){
	$requestBody = file_get_contents('php://input');
	
	$json = json_decode($requestBody);
	
	$rss = 'https://www.nlb.gov.sg/golibrary2/events.rss';

	$text = $json->result->parameters->eventType;

	switch ($text) {
		case 'programme':
			$speech = "Hi, programme selected. " . "RSS URL is " . $rss . "?limit=8&type_id=1";
			break;

		case 'exhibition':
			$speech = "Hi, exhibition selected. " . "RSS URL is " . $rss . "?limit=8&type_id=2";
			break;

		case 'conference':
			$speech = "Hi, conference selected. " . "RSS URL is " . $rss . "?limit=8&type_id=3";
			break;
		
		default:
			$speech = "Sorry, I didnt get that. Please ask me something else.";
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
	echo "Method not allowed";
}

?>