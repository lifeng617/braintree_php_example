<?php

require_once("../includes/braintree_init.php");

header('Content-Type: application/json');

$response["client_token"] = Braintree\ClientToken::generate();

echo json_encode($response, JSON_PRETTY_PRINT);

?>