<?php

require_once("../includes/braintree_init.php");

$response["client_token"] = Braintree\ClientToken::generate();

echo json_encode($response, JSON_PRETTY_PRINT);

?>