<?php

require_once("../includes/braintree_init.php");
require_once("../includes/rest.php");

function object2array($object) {
	$array = (array) $object;
	foreach ($array as $key => $value) {
		return $value;
	}
	return [];
}

$customer_id = 'vincenttestcustomer';

if (isset($_GET['token'])) {
	$token = $_GET['token'];
} else if (isset($request['token'])){
	$token = $request['token'];
}

try {
	$result = Braintree\CreditCard::delete($token);
	$response["success"] = true;
} catch (Braintree\Exception\NotFound $e) {
	$response["success"] = false;
	$response["error"] = "The card does not exist.";
} catch (Exception $e2) {
	$response["success"] = false;
	$response["error"] = $e2->getMessage();
}
echo json_encode($response, JSON_PRETTY_PRINT);
?>