<?php

namespace Payomatix;

use Payomatix\Service\PaymentService;
use Payomatix\Service\ResponseService;

class Payomatix extends PaymentService
{
	/** @var array options to be used for requests. */
	public $options;

	public function getOptions()
	{
		return $this->options;
	}

	public function setOptions($options)
	{
		$this->options = $options;
	}

	public function nonSeamlessPayment($fields): array
	{
		return (array) PaymentService::initializePayment($fields, $this->getOptions());
	}
}
