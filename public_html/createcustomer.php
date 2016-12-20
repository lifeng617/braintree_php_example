<?php

require_once("../includes/braintree_init.php");
require_once("../includes/rest.php");

$customer_id = 'vincenttestcustomer';

$params['id'] = $customer_id;
if (isset($request["payment_method_nonce"])) {
	$params['paymentMethodNonce'] = $request["payment_method_nonce"];
}


$result = Braintree\Customer::create($params);

function object2array($object) {
	$array = (array) $object;
	foreach ($array as $key => $value) {
		return $value;
	}
	return [];
}

$response["success"] = $result->success;

if ($result->success == 1) {
	$response["customer"] = object2array($result->customer);
	foreach($result->customer->creditCards as $card) {
		$cards[] = object2array($card);
	}
	$response["customer"]["creditCards"] = $cards;
} else {
	$response["error"] = $result->message;
}

echo json_encode($response, JSON_PRETTY_PRINT);
?>