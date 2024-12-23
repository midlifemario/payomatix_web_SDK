<?php

namespace Payomatix\Service;

class ResponseService
{
	public static function noSecKey()
	{
		return [
			'status' => false,
			'errors' => 'no secret key',
		];
	}

	public static function serverError()
	{
		return [
			'status' => false,
			'errors' => 'server error',
		];
	}

	public static function validationError($validations)
	{
		return [
			'status' => false,
			'errors' => $validations,
		];
	}

	public static function failed($response)
	{
		return [
			'status' => false,
			'errors' => $response['message'] ?? 'failed',
		];
	}

	public static function notFound($response)
	{
		return [
			'status' => false,
			'errors' => $response['response'] ?? 'not found.',
		];
	}

	public static function standardThreeDS($response)
	{
		return [
			'status' => true,
			'redirect_url' => $response['redirect_url'],
		];
	}

	public static function standardSeamlessThreeDS($response)
	{
		return [
			'status' => true,
			'order_id' => $response['redirect_url'],
			'redirect_url' => $response['redirect_url'],
		];
	}

	public static function standardStatus($response)
	{
		return [
			'status' => true,
			'data' => $response['data'],
		];
	}
}