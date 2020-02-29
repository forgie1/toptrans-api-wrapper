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


	private static function parseValue($nestedMethods, $object, $result = [])
	{
		$methodValue = array_shift($nestedMethods);
		$method = 'get' . ucfirst($methodValue);
		$object = $object->$method();

		if (!is_object($object)) {
			$result[$methodValue] = $object;
			return $result;
		} else {
			$result[$methodValue] = self::parseValue($nestedMethods, $object, $result);
			return $result;
		}
	}

}
