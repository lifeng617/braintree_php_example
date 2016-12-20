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

$nonce = $request["nonce"];
$customer_id = 'vincenttestcustomer';

try {
	$customer = Braintree\Customer::find($customer_id);
	$result = Braintree\CreditCard::create([
	    'paymentMethodNonce' => $nonce,
	    'customerId' => $customer_id
	]);

	if ($result->success == 1) {
		$response["success"] = true;
		$response["card"] = object2array($result->creditCard);
	} else {
		$response["success"] = false;
		$response["error"] = $result->message;
	}
	
} catch (Braintree\Exception $exception1) { // Customer Not found
	$result = Braintree\Customer::create([
	    'paymentMethodNonce' => $nonce,
	    'id' => $customer_id
	]);

	if ($result->success == 1) {
		if (count($result->customer->creditCards) > 0) {
			$response["success"] = true;
			$response["card"] = object2array($result->customer->creditCards[0]);
		} else {
			$response["success"] = false;
			$response["error"] = "Unknown error. Please try again.";
		}
	} else {
		$response["error"] = $result->message;
	}

} catch (Exception $exception2) {
	$response["success"] = false;
}

echo json_encode($response, JSON_PRETTY_PRINT);
?>