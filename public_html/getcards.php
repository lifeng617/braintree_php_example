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

try {
	$customer = Braintree\Customer::find($customer_id);
	$response = [];
	foreach($customer->creditCards as $card) {
		$response[] = object2array($card);
	}
	echo json_encode($response, JSON_PRETTY_PRINT);
} catch (Braintree\Exception $exception1) { // Not found
	echo "[]";
} catch (Exception $exception2) {
	echo "[]";
}

?>