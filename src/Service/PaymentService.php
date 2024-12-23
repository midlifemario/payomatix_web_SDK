<?php

namespace Payomatix\Service;

use Payomatix\Gateways\NonSeamless;
use Payomatix\Gateways\Seamless;

class PaymentService
{
	public function initializeNonSeamless($fields, $options): array
	{
		return (array) NonSeamless::initializePayment($fields, $options);
	}

	public function initializeSeamless($fields, $options): array
	{
		return (array) Seamless::initializePayment($fields, $options);
	}
}