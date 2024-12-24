<?php

namespace Payomatix;

use Payomatix\Service\PaymentService;

class Payomatix extends PaymentService
{
	public $options;

	public function getOptions()
	{
		return $this->options;
	}

	public function getFields($fields)
	{
		return array_map(function ($val) {
			if (!is_array($val)) {
				return trim($val);
			} else {
				return array_map(function ($v) {
					if (!is_array($v)) {
						return trim($v);
					} else {
						return $v;
					}
				}, $val);
			}
		}, $fields);
	}

	public function setOptions($options)
	{
		$this->options = $options;
	}

	public function nonSeamlessPayment($fields): array
	{
		return (array) PaymentService::initializeNonSeamless($this->getFields($fields), $this->getOptions());
	}

	public function seamlessPayment($fields): array
	{
		return (array) PaymentService::initializeSeamless($this->getFields($fields), $this->getOptions());
	}

	public function status($fields): array
	{
		return (array) PaymentService::initializeStatus($this->getFields($fields), $this->getOptions());
	}
}
