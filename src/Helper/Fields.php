<?php

namespace Payomatix\Helper;

class Fields
{
	public static function getNonSeamlessFields()
	{
		return [
			'email',
			'amount',
			'currency',
			'return_url',
			'notify_url',
			'merchant_ref',
			'search_key',
			'select_type_id',
			'other_data' => [
				'first_name',
				'last_name',
				'address',
				'state',
				'city',
				'zip',
				'country',
				'phone_no',
				'card_no',
				'select_type_id',
				'customer_vpa',
				'products' => [
					'product_id',
					'name',
					'quantity',
					'price',
					'description',
					'product_code',
					'image_url',
					'category',
					'tax_rate',
					'discount',
					'weight'
				],
			],
		];
	}

	public static function getSeamlessFields()
	{
		return [
			'first_name',
			'last_name',
			'email',
			'phone_no',
			'address',
			'country',
			'state',
			'city',
			'zip',
			'amount',
			'currency',
			'type_id',
			'card_no',
			'ccexpiry_month',
			'ccexpiry_year',
			'cvv_number',
			'customer_vpa',
			'return_url',
			'notify_url',
			'merchant_ref',
			'search_key',
		];
	}

	public static function setFields($fields, $type=1)
	{
		if ($type == 1) {
			$required_fields = self::getNonSeamlessFields();
		} else {
			$required_fields = self::getSeamlessFields();
		}

		foreach ($fields as $name => $value) {
			// other_data
			if ($name == 'other_data') {
				foreach ($value as $sub_name => $sub_value) {

					// products
					if ($sub_name === 'products') {
						foreach ($sub_value as $product_index => $product) {
							if (is_array($product)) {
								foreach ($product as $product_key => $product_value) {
									if (!in_array($product_key, $required_fields['other_data']['products'])) {
										unset($fields['other_data']['products'][$product_index][$product_key]);
									}
								}
								// 
							} else {
								unset($fields['other_data']['products'][$product_index]);
							}
						}
					} elseif (in_array($sub_name, $required_fields[$name])) {
						// nothing to do
					} else {
						unset($fields['other_data'][$sub_name]);
					}
				}
			} else {
				if (!in_array($name, $required_fields)) {
					unset($fields[$name]);
				}
			}
		}

		return $fields;
	}
}
