<?php 

$method = $_SERVER['REQUEST_METHOD'];

// Process only when method is POST
if($method == 'POST'){
	$requestBody = file_get_contents('php://input');
	
	$json = json_decode($requestBody);

	$eventType = $json->result->parameters->eventType;
	$eventId = '';
	
	$rss = 'https://www.nlb.gov.sg/golibrary2/events.rss';
	
	switch ($eventType) {
		case 'programme':
			eventId = '1';
			break;
		
		case 'exhibition':
			eventId = '2';
			break;
		
		case 'conference':
			eventId = '3';
			break;
			
		default:
			eventId = '1';
			break;
	}
	
	//$rssURL = rss + '?limit=8&type_id=' + eventId;
	
	//$ch = curl_init(); 
	// set url 
    //curl_setopt($ch, CURLOPT_URL, $rssURL);
	
	//return the transfer as a string 
	//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	
	// $output contains the output string 
    //$output = curl_exec($ch);
	
	//echo $output;
	
	// close curl resource to free up system resources 
    //curl_close($ch);
	
	$response = new \stdClass();
	$response->speech = $eventId;
	$response->displayText = $eventId;
	$response->source = "webhook";
	echo json_encode($response);
}
else {
	echo 'Method not allowed';
}