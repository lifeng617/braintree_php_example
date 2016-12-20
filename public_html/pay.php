<?php

require_once("../includes/braintree_init.php");
require_once("../includes/rest.php");

header('Content-Type: application/json');

function object2array($object) {
	$array = (array) $object;
	foreach ($array as $key => $value) {
		return $value;
	}
	return [];
}

$customer_id = 'vincenttestcustomer';

$params['amount'] = $request['amount'];
$params['options'] = [
    'submitForSettlement' => True
  ];
if (isset($request['nonce'])) {
	$params['paymentMethodNonce'] = $request['nonce'];
} else {
	$params['paymentMethodToken'] = $request['token'];
}

$result = Braintree_Transaction::sale($params);

if ($result->success == 1) {
	$response["success"] = true;
	$transaction = object2array($result->transaction);

	foreach($result->transaction->statusHistory as $status) {
		$statusHistory[] = object2array($status);
	}
	$transaction["statusHistory"] = $statusHistory;
	$response["transaction"] = $transaction;

} else {
	$response["success"] = false;
	$response["error"] = $result->message;
}

echo json_encode($response, JSON_PRETTY_PRINT);

?>