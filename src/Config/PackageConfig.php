<?php

namespace Payomatix\Config;

use Dotenv\Dotenv;

class PackageConfig
{
	public const VERSION = '1.0.0';
    public const BASE_URL = 'https://stageadmin.payomatix.com';

    public const NONSEAMLESS_PAYMENT_URL = '/payment/merchant/transaction';
    public const NONSEAMLESS_PAYMENT_TEST_URL = '/payment/merchant/transaction';

    public const SEAMLESS_PAYMENT_URL = '/payment/merchant/seamless/transaction';
    public const SEAMLESS_PAYMENT_TEST_URL = '/payment/merchant/transaction';

    public const GET_URL = '/payment/get/transaction';

	protected static function getSecretKey()
	{
		$env_path = __DIR__ . '/../../../../../';
		$test_env_path = __DIR__.'/../../';

		if(file_exists($env_path.'.env')) {
		    $dotenv = Dotenv::createImmutable($env_path);
			$dotenv->load();
		} elseif (file_exists($test_env_path.'.env')) {
		    $dotenv = Dotenv::createImmutable($test_env_path);
			$dotenv->load();
		}

		return $_SERVER['PAYOMATIX_SECRET_KEY'] ?? null;
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

	protected static function getNonSeamlessTestPaymentUrl()
	{
		return self::BASE_URL . self::NONSEAMLESS_PAYMENT_TEST_URL;
	}

	protected static function getNonSeamlessLivePaymentUrl()
	{
		return self::BASE_URL . self::NONSEAMLESS_PAYMENT_URL;
	}

	protected static function getSeamlessTestPaymentUrl()
	{
		return self::BASE_URL . self::SEAMLESS_PAYMENT_TEST_URL;
	}

	protected static function getSeamlessLivePaymentUrl()
	{
		return self::BASE_URL . self::SEAMLESS_PAYMENT_URL;
	}
}
