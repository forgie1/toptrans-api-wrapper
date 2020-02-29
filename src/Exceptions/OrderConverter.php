<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper\Exceptions;

use ToptransApiWrapper\Entities\Order;

class OrderConverter
{

	/**
	 * @param Object $order
	 * @param array $allowedParameters
	 * @return array
	 */
	public static function orderToArray($order, array $allowedParameters): array
	{
		$arrayOrder = [];
		foreach ($allowedParameters as $parameter) {
			$nestedMethods = explode('.', $parameter);
			$arrayOrder = array_merge_recursive($arrayOrder, self::parseValues($nestedMethods, $order));
		}

		return $arrayOrder;
	}


	private static function parseValues($nestedMethods, $object): array
	{
		$result = [];

		$jsonApiKey = array_shift($nestedMethods);
		$realMethod = '';
		foreach (explode('_', $jsonApiKey) as $word) {
			$realMethod .= ucfirst($word);
		}
		$method = 'get' . $realMethod;
		$value = $object->$method();

		if (is_object($value)) {
			$newVal = self::parseValues($nestedMethods, $value);
			if ($newVal) {
				$result[$jsonApiKey] = self::parseValues($nestedMethods, $value);
			}
			return $result;
		} elseif (is_array($value)) {
			while ($subValue = array_shift($value)) {
				if (is_object($subValue)) {
					$newVal = self::parseValues($nestedMethods, $subValue);
					if ($newVal) {
						$result[$jsonApiKey][] = $newVal;
					}
				} elseif ($subValue) {
					$result[$jsonApiKey][] = $subValue;
				}
			}
			return $result;
		} else {
			if ($value) {
				$result[$jsonApiKey] = $value;
			}
			return $result;
		}
	}

}
