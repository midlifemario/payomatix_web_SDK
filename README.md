<p align="center">
    <img title="Payomatix" height="115" src="https://admin.payomatix.com/storage/newTheme/images/logo.png" width="50%"/>
</p>

# Payomatix PHP SDK

This Payomatix PHP Library provides easy access to Payomatix APIs for php apps. It abstracts the complexity involved in direct integration and allows you to make quick calls to the APIs.

## Table of Contents
1. [Requirements](#requirements)
2. [Dependencies](#dependencies)
3. [Installation](#installation)
4. [Initialization](#initialization)
4. [Status](#status)
4. [Custom Request Timeouts](#custom-request-timeouts)
5. [Getting Started](#getting-started)
6. [Debugging Errors](#debugging-errors)
7. [License](#license)
8. [References](#references)

<a id="requirements"></a>

## Requirements

1. Payomatix Merchant account with API Keys
2. Minimum PHP versions: >= 7.0.0

<a id="dependencies"></a>

## Dependencies

The bindings require the following extensions in order to work properly:

-   [`curl`](https://secure.php.net/manual/en/book.curl.php)
-   [`json`](https://secure.php.net/manual/en/book.json.php)
-   [`mbstring`](https://secure.php.net/manual/en/book.mbstring.php) (Multibyte String)

If you use Composer, these dependencies should be handled automatically.

<a id="installation"></a>

## Installation

### Installation via Composer.

To install the package via Composer, run the following command.

```shell
composer require payomatix/web-sdk
```

To use the bindings, use Composer's [autoload](https://getcomposer.org/doc/01-basic-usage.md#autoloading):

```php
require 'vendor/autoload.php';
```

<a id="initialization"></a>

## Initialization

Create a .env file or copy from `.env.example` file
Save your SECRET_KEY in the `.env` file as PAYOMATIX_SECRET_KEY

```bash
cp .env.example .env
```
Your `.env` file should look this.

```env
PAYOMATIX_SECRET_KEY=PAYXXXXXXXXXXXXXXXX.XXXXXXSECKEY
ENV='staging/production'
```

<a id="getting-started"></a>

### Getting Started

The SDK provides two methods of making collections

1. [Payomatix Non-Seamless]( https://docs.payomatix.com/directPaymentAPI.php#section-2 )
2. [Payomatix Non-Seamless]( https://docs.payomatix.com/directPaymentAPI.php#section-3 )

Simple usage for non-seamless payments looks like:

```php
<?php

require_once 'vendor/autoload.php';

use Payomatix\Payomatix;

$payomatix = new Payomatix();

// customize curl timeouts
$payomatix->setOptions([
    'timeout' => 60
]);

$response = $payomatix->nonSeamlessPayment([
	'other_data' => [
	    'first_name' => 'your-name',
	    'last_name' => 'your-name',
	    'address' => 'address',
	    'state' => 'state',
	    'city' => 'city',
	    'zip' => 'zip',
	    'country' => 'IN',
	    'phone_no' => '1234567890',
	    'card_no' => '4242424242424242',
	],
	'email' => 'test@jondoe.com',
	'amount' => '30.00',
	'currency' => 'USD',
	'merchant_ref' => 'ce35d90-fc2e-4a43-a900-1872d9c00890',
	'return_url' => 'https://mysite.com/redirect/dce35d90-fc2e-4a43-a900-1872d9c00890',
	'notify_url' => 'https://mysite.com/notify/ce35d90-fc2e-4a43-a900-1872d9c00890'
]);

if (isset($response['redirect_url']) && !empty($response['redirect_url'])) {
	header('Location: ' . $response['redirect_url']);
} else {
	print_r($response);
}
```

Same way, you can initiate seamless payments like:

```php
<?php

require_once 'vendor/autoload.php';

use Payomatix\Payomatix;

$payomatix = new Payomatix();

$response = $payomatix->nonSeamlessPayment([
	'first_name' => 'your-name',
	'last_name' => 'your-name',
	'address' => 'address',
	'country' => 'IN',
	'state' => 'state',
	'city' => 'city',
	'zip' => 'zip',
	'phone_no' => '1234567890',
	'email' => 'test@jondoe.com',
	'amount' => '30.00',
	'currency' => 'INR',
	'return_url' => 'https://mysite.com/redirect/dce35d90-fc2e-4a43-a900-1872d9c00890',
	'notify_url' => 'https://mysite.com/notify/ce35d90-fc2e-4a43-a900-1872d9c00890',
	'merchant_ref' => 'ce35d90-fc2e-4a43-a900-1872d9c00890',
	'type_id' => '1',
	'card_no' => '4242424242424242',
	'ccexpiry_month' => '01',
	'ccexpiry_year' => '2029',
	'cvv_number' => '123'
]);

if (isset($response['redirect_url']) && !empty($response['redirect_url'])) {
	header('Location: ' . $response['redirect_url']);
} else {
	print_r($response);
}
```

<a id="status"></a>

## Status

You can use the SDK to retrieve the status of transaction using `merchant_ref` or `order_id` as below:

```php
<?php

require_once 'vendor/autoload.php';

use Payomatix\Payomatix;

$payomatix = new Payomatix();

$response = $payomatix->status([
	'merchant_ref' => 'ce35d90-fc2e-4a43-a900-1872d9c00890'
]);

if (isset($response['redirect_url']) && !empty($response['redirect_url'])) {
	header('Location: ' . $response['redirect_url']);
} else {
	print_r($response);
}
```

<a id="custom-request-timeouts"></a>

## Custom Request Timeouts

By default PHP cURL request timeouts are set. To modify request timeouts (connect or total, in seconds) you'll need to tell the API client like this.

```php
<?php

require_once 'vendor/autoload.php';

use Payomatix\Payomatix;

$payomatix = new Payomatix();

$payomatix->setOptions([
    'timeout' => 60,
    'connect_timeout' => 60,
    'ssl_verifyhost' => false
]);
```

<a id="debugging-errors"></a>

## Debugging Errors

We understand that you may run into some errors while integrating our library. You can contact our developer team for support.

For `authorization` and `validation` error responses, double-check your Secret key. If you get a `server` error, kindly engage the team for support.

<a id="license"></a>

## License

By using this library, you agree with our [Terms and Conditions](https://payomatix.com/terms-conditions/).

Copyright (c) Payomatix Inc.

<a id="references"></a>

## Payomatix API References

- [Payomatix API Documentation](https://docs.payomatix.com/directPaymentAPI.php)
