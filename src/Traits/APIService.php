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
        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        if (isset($options['timeout']) && is_integer($options['timeout']) && $options['timeout'] > 0) {
        	curl_setopt($ch, CURLOPT_TIMEOUT, $options['timeout']);
        }
        if (isset($options['connect_timeout']) && is_integer($options['connect_timeout']) && $options['connect_timeout'] > 0) {
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $options['connect_timeout']);
        }
        if (isset($options['ssl_verifyhost']) && $options['ssl_verifyhost'] == false) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
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
        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        if (isset($options['timeout']) && is_integer($options['timeout']) && $options['timeout'] > 0) {
            curl_setopt($ch, CURLOPT_TIMEOUT, $options['timeout']);
        }
        if (isset($options['connect_timeout']) && is_integer($options['connect_timeout']) && $options['connect_timeout'] > 0) {
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $options['connect_timeout']);
        }
        if (isset($options['ssl_verifyhost']) && $options['ssl_verifyhost'] == false) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}