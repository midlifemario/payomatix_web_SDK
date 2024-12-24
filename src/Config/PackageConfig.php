<?php

namespace Payomatix\Config;

use Dotenv\Dotenv;

class PackageConfig
{
	public const VERSION = '1.0.0';
    public const BASE_URL = 'https://admin.payomatix.com';

    public const NONSEAMLESS_PAYMENT_URL = '/payment/merchant/transaction';
    public const SEAMLESS_PAYMENT_URL = '/payment/merchant/seamless/transaction';
    public const STATUS_URL = '/payment/get/transaction';

	protected static function getSecretKey()
	{
		$env_path = __DIR__ . '/../../../../../';
		$manual_env_path = __DIR__.'/../../';

		if(file_exists($env_path.'.env')) {
		    $dotenv = Dotenv::createImmutable($env_path);
			$dotenv->load();
		} elseif (file_exists($manual_env_path.'.env')) {
		    $dotenv = Dotenv::createImmutable($manual_env_path);
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

	protected static function getNonSeamlessPaymentUrl()
	{
		return self::BASE_URL . self::NONSEAMLESS_PAYMENT_URL;
	}

	protected static function getSeamlessPaymentUrl()
	{
		return self::BASE_URL . self::SEAMLESS_PAYMENT_URL;
	}

	protected static function getStatusUrl()
	{
		return self::BASE_URL . self::STATUS_URL;
	}
}
