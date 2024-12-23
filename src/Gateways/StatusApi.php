<?php

namespace Payomatix\Gateways;

use Payomatix\Traits\APIService;
use Payomatix\Config\PackageConfig;
use Payomatix\Service\ResponseService;
use Payomatix\Service\ValidationService;

class StatusApi extends PackageConfig
{
	use APIService;

	protected static $secret_key;

	public static function initializeApi($payload, $options): array
	{
		$url = PackageConfig::getStatusUrl();

		self::$secret_key = self::getSecretKey();

		if (null == self::$secret_key) {
			return ResponseService::noSecKey();
		}

		$headers = [
			'Accept: application/json',
			'Content-Type: application/json',
			'Authorization: '. self::$secret_key,
		];

		$validations = ValidationService::statusValidation($payload);

		if (!empty($validations)) {
			return ResponseService::validationError($validations);
		}

		try {
			$response = json_decode(self::curlPostRequest($url, $headers, json_encode($payload), $options), true);
			if (isset($response['status']) && $response['status'] == 'success') {
				return ResponseService::standardStatus($response);
			} elseif (isset($response['status']) && $response['status'] == 'error') {
				return ResponseService::notFound($response);
			} elseif (isset($response['status']) && $response['status'] == 'validation_error') {
				return ResponseService::validationError($response);
			} else {
				return ResponseService::serverError();
			}
		} catch (\Exception $e) {
			return ResponseService::serverError();
		}
	}
}