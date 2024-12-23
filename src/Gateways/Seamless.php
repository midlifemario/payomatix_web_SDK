<?php

namespace Payomatix\Gateways;

use Payomatix\Traits\APIService;
use Payomatix\Config\PackageConfig;
use Payomatix\Service\ResponseService;
use Payomatix\Service\ValidationService;

class Seamless extends PackageConfig
{
	use APIService;

	protected static $secret_key;

	public static function initializePayment($payload, $options): array
	{
		if (isset($payload['is_test']) && $payload['is_test'] == true) {
			$url = PackageConfig::getSeamlessTestPaymentUrl(); 
		} else {
			$url = PackageConfig::getSeamlessLivePaymentUrl();
		}

		self::$secret_key = self::getSecretKey();

		if (null == self::$secret_key) {
			return ResponseService::noSecKey();
		}

		$headers = [
			'Accept: application/json',
			'Content-Type: application/json',
			'Authorization: '. self::$secret_key,
		];

		$validations = ValidationService::seamlessValidation($payload);

		if (!empty($validations)) {
			return ResponseService::validationError($validations);
		}

		try {
			$response = json_decode(self::curlPostRequest($url, $headers, json_encode($payload), $options), true);
			if (isset($response['redirect_url']) && !empty($response['redirect_url'])) {
				return ResponseService::standardThreeDS($response);
			} elseif (isset($response['status']) && $response['status'] == 'fail') {
				return ResponseService::failed($response);
			} else {
				return ResponseService::serverError();
			}
		} catch (\Exception $e) {
			return ResponseService::serverError();
		}
	}
}