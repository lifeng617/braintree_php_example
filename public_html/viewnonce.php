<?php
require_once("../includes/braintree_init.php");

$amount = $_POST["amount"];
$nonce = $_POST["payment_method_nonce"];
print_r($nonce);
