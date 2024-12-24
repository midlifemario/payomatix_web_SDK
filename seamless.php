<?php

require 'vendor/autoload.php';

use Payomatix\Payomatix;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$payomatix = new Payomatix();

	$response = $payomatix->seamlessPayment([
		'first_name' => $_REQUEST['first_name'],
		'last_name' => $_REQUEST['last_name'],
		'address' => $_REQUEST['address'],
		'country' => $_REQUEST['country'],
		'state' => $_REQUEST['state'],
		'city' => $_REQUEST['city'],
		'zip' => $_REQUEST['zip'],
		'phone_no' => $_REQUEST['phone_no'],
		'email' => $_REQUEST['email'],
		'amount' => $_REQUEST['amount'],
		'currency' => $_REQUEST['currency'],
		'type_id' => $_REQUEST['type_id'],
		'card_no' => $_REQUEST['card_no'],
		'ccexpiry_month' => $_REQUEST['ccexpiry_month'],
		'ccexpiry_year' => $_REQUEST['ccexpiry_year'],
		'cvv_number' => $_REQUEST['cvv_number'],
		'merchant_ref' => $_REQUEST['merchant_ref'],
		'return_url' => base_url().'/status.php',
		'notify_url' => 'https://webhook.site/8c5ef01d-0475-4915-92cc-c5649e475f28',
	]);

	if (isset($response['redirect_url']) && !empty($response['redirect_url'])) {
		header('Location: ' . $response['redirect_url']);
	} else {
		echo('<pre>');print_r($response);exit();
	}
}

function base_url() {
    $ssl      = ( ! empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == 'on' );
    $sp       = strtolower( $_SERVER['SERVER_PROTOCOL'] );
    $protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
    $port     = $_SERVER['SERVER_PORT'];
    $port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;
    $host     = ( $use_forwarded_host && isset( $_SERVER['HTTP_X_FORWARDED_HOST'] ) ) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : ( isset( $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] : null );
    $host     = isset( $host ) ? $host : $_SERVER['SERVER_NAME'] . $port;
    return $protocol . '://' . $host;
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Seamless Payment demo</title>
	<style type="text/css">
		.width-label {
			display: inline-block;
			width: 200px;
		}
	</style>
</head>
<body>
	<h3>Seamless Payment demo</h3>
	<form method="post" action="/seamless.php">
		<label for="first_name" class="width-label">First Name</label>
		<input type="text" name="first_name" id="first_name" value="your-name">
		<br><br>

		<label for="last_name" class="width-label">Last Name</label>
		<input type="text" name="last_name" id="last_name" value="your-name">
		<br><br>

		<label for="email" class="width-label">Email</label>
		<input type="text" name="email" id="email" value="test@jondoe.com">
		<br><br>

		<label for="phone_no" class="width-label">Phone number</label>
		<input type="text" name="phone_no" id="phone_no" value="1234567890">
		<br><br>

		<label for="address" class="width-label">Address</label>
		<input type="text" name="address" id="address" value="address">
		<br><br>

		<label for="country" class="width-label">Country</label>
		<select name="country" id="country">
			<option value="IN" selected>India</option>
			<option value="US">United States</option>
		</select>
		<br><br>

		<label for="state" class="width-label">State</label>
		<input type="text" name="state" id="state" value="state">
		<br><br>

		<label for="city" class="width-label">City</label>
		<input type="text" name="city" id="city" value="city">
		<br><br>

		<label for="zip" class="width-label">Zip</label>
		<input type="text" name="zip" id="zip" value="123456">
		<br><br>

		<label for="amount" class="width-label">Amount</label>
		<input type="text" name="amount" id="amount" value="30">
		<br><br>

		<label for="currency" class="width-label">Currency</label>
		<select name="currency" id="currency">
			<option value="INR" selected>INR</option>
			<option value="USD">USD</option>
		</select>
		<br><br>

		<label for="type_id" class="width-label">Select Payment Type</label>
		<select name="type_id" id="type_id">
			<option value="1" selected>Credit Card</option>
			<option value="2">Debit Card</option>
		</select>
		<br><br>

		<div id="card-div">
			<label for="card_no" class="width-label">Card number</label>
			<input type="text" name="card_no" id="card_no" value="4242424242424242">
			<br><br>

			<label for="ccexpiry_month" class="width-label">Card Expiry Month</label>
			<select name="ccexpiry_month" id="ccexpiry_month">
				<option value="01" selected>January</option>
				<option value="02">February</option>
				<option value="03">March</option>
				<option value="04">April</option>
				<option value="05">May</option>
				<option value="06">June</option>
				<option value="07">July</option>
				<option value="08">August</option>
				<option value="09">September</option>
				<option value="10">October</option>
				<option value="11">November</option>
				<option value="12">December</option>
			</select>
			<br><br>

			<label for="ccexpiry_year" class="width-label">Card Expiry Year</label>
			<select name="ccexpiry_year" id="ccexpiry_year">
				<?php for ($x = 2024; $x <= 2040; $x++) { ?>
					<option value="<?php echo($x); ?>" <?php  echo($x === 2029 ? "selected" : null); ?> ><?php echo($x); ?></option>
				<?php } ?>
			</select>
			<br><br>

			<label for="cvv_number" class="width-label">CVV Number</label>
			<input type="text" name="cvv_number" id="cvv_number" value="123">
			<br><br>

			<label for="merchant_ref" class="width-label">merchant_ref</label>
			<input type="text" name="merchant_ref" id="merchant_ref" value="<?php echo(time()) ?>">
			<br><br>
		</div>
		<input type="submit">
	</form>
</body>
</html>