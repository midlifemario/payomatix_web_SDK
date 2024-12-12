<?php

namespace Payomatix\Helper;

class Fields
{
	public static function getFields()
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

	public static function setFields($fields)
	{
		foreach ($fields as $name => $value) {
			// other_data
			if ($name == 'other_data') {
				foreach ($value as $sub_name => $sub_value) {

					// products
					if ($sub_name === 'products') {
						foreach ($sub_value as $product_index => $product) {
							if (is_array($product)) {
								foreach ($product as $product_key => $product_value) {
									if (!in_array($product_key, self::getFields()['other_data']['products'])) {
										unset($fields['other_data']['products'][$product_index][$product_key]);
									}
								}
								// 
							} else {
								unset($fields['other_data']['products'][$product_index]);
							}
						}
					} elseif (in_array($sub_name, self::getFields()[$name])) {
						// nothing to do
					} else {
						unset($fields['other_data'][$sub_name]);
					}
				}
			} else {
				if (!in_array($name, self::getFields())) {
					unset($fields[$name]);
				}
			}
		}

		return $fields;
	}
}
