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
			$arrayOrder += self::parseValue($nestedMethods, $order);
		}

		return $arrayOrder;
	}


	private static function parseValue($nestedMethods, $object)
	{
		$jsonApiKey = array_shift($nestedMethods);
		$realMethod = '';
		foreach (explode('_', $jsonApiKey) as $word) {
			$realMethod .= ucfirst($word);
		}
		$method = 'get' . $realMethod;
		$value = $object->$method();

		if (is_object($value)) {
			$result[$jsonApiKey] = self::parseValue($nestedMethods, $value);
			return $result;
		} elseif (is_array($value)) {
			while ($subValue = array_shift($value)) {
				$result[][$jsonApiKey] = self::parseValue($nestedMethods, $subValue);
			}
			return $result;
		} else {
			$result[$jsonApiKey] = $value;
			return $result;
		}
	}

}
