<?php

require 'vendor/autoload.php';

use Payomatix\Payomatix;

if (!empty($_REQUEST['merchant_ref'])) {

	$payomatix = new Payomatix();

	$response = $payomatix->status([
		'merchant_ref' => $_REQUEST['merchant_ref']
	]);

	echo('<pre>');print_r($response);exit();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$payomatix = new Payomatix();

	$response = $payomatix->status([
		'merchant_ref' => $_REQUEST['merchant_ref'],
		'order_id' => $_REQUEST['order_id']
	]);
	echo('<pre>');print_r($response);exit();
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Status demo</title>
	<style type="text/css">
		.width-label {
			display: inline-block;
			width: 200px;
		}
	</style>
</head>
<body>
	<h3>Status demo</h3>
	<form method="post" action="/status.php">
		<label for="merchant_ref" class="width-label">merchant_ref</label>
		<input type="text" name="merchant_ref" id="merchant_ref">
		<br><br>

		<label for="order_id" class="width-label">order_id</label>
		<input type="text" name="order_id" id="order_id">
		<br><br>

		<input type="submit">
	</form>
</body>
</html>