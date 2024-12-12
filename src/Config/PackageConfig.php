<?php

namespace Payomatix\Config;

use Dotenv\Dotenv;

class PackageConfig
{
	public const VERSION = '1.0.0';
    public const BASE_URL = 'https://stageadmin.payomatix.com';

    public const PAYMENT_URL = '/payment/merchant/transaction';
    public const PAYMENT_TEST_URL = '/payment/merchant/transaction';
    public const GET_URL = '/payment/get/transaction';

	protected function getSecretKey()
	{
		$env_path = __DIR__ . '/../../../../../';

		if(file_exists($env_path.'.env')) {
		    $dotenv = Dotenv::createImmutable($env_path);
			$dotenv->load();
		}

		return $_SERVER['PAYOMATIX_SECRET_KEY'];
	}

	protected function getVersion()
	{
		return self::VERSION;
	}

	protected function getBaseUrl()
	{
		return self::BASE_URL;
	}

	protected function getTimeOut()
	{
		return self::TIME_OUT;
	}

	protected function getTestPaymentUrl()
	{
		return self::BASE_URL . self::PAYMENT_TEST_URL;
	}

	protected function getLivePaymentUrl()
	{
		return self::BASE_URL . self::PAYMENT_URL;
	}
}
