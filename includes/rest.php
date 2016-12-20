<?php

//Make sure that the content type of the POST request has been set to application/json
$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : (isset($_SERVER["HTTP_CONTENT_TYPE"]) ? trim($_SERVER["HTTP_CONTENT_TYPE"]) : '');

$request = $_POST;
if(strcasecmp($contentType, 'application/json') == 0) {
     
	//Receive the RAW post data.
	$content = trim(file_get_contents("php://input"));
 
	//Attempt to decode the incoming RAW post data from JSON.
	$decoded = json_decode($content, true);

	$request = $decoded;
}
