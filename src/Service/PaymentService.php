<?php

namespace Payomatix\Service;

use Payomatix\Config\PackageConfig;
use Payomatix\Traits\APIService;

class PaymentService extends PackageConfig
{
	use APIService;

	protected $secret_key;

	protected function initializePayment($payload, $options): array
	{
		if (isset($payload['is_test']) && $payload['is_test'] == true) {
			$url = PackageConfig::getTestPaymentUrl(); 
		} else {
			$url = PackageConfig::getLivePaymentUrl(); 
		}

		$this->secret_key = $this->getSecretKey();

		if (null == $this->secret_key) {
			return ResponseService::noSecKey();
		}

		$headers = [
			'Accept: application/json',
			'Content-Type: application/json',
			'Authorization: '. $this->secret_key,
		];

		$validations = ValidationService::paymentAPIValidation($payload);

		if (!empty($validations)) {
			return ResponseService::validationError($validations);
		}

		try {
			$response = json_decode($this->curlPostRequest($url, $headers, json_encode($payload), $options), true);
			if (isset($response['redirect_url']) && !empty($response['redirect_url'])) {
				return ResponseService::standardThreeDS($response);
			} else {
				return ResponseService::serverError();
			}
		} catch (\Exception $e) {
			return ResponseService::serverError();
		}
	}
}