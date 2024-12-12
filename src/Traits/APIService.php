<?php

namespace Payomatix\Traits;

trait APIService
{
	public static function curlGetRequest($url, $headers=[], $payload=null, $options = [])
	{
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'get');
        if (!empty($payload)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        }
        if (isset($options['timeout']) && is_integer($options['timeout']) && $options['timeout'] > 0) {
        	curl_setopt($ch, CURLOPT_TIMEOUT, $options['timeout']);
        } else {
        	curl_setopt($ch, CURLOPT_TIMEOUT, 300);
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
	}

    public static function curlPostRequest($url, $headers=[], $payload=null, $options = [])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        if (!empty($payload)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        }
        if (isset($options['timeout']) && is_integer($options['timeout']) && $options['timeout'] > 0) {
            curl_setopt($ch, CURLOPT_TIMEOUT, $options['timeout']);
        } else {
            curl_setopt($ch, CURLOPT_TIMEOUT, 300);
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}