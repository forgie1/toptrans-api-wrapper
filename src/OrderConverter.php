<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper;

use ToptransApiWrapper\Entities\Pack;

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

		if (!$arrayOrder['m3']) {
			unset($arrayOrder['m3']);
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
			while ($pack = array_shift($value)) {
				/** @var Pack $pack */
				$result[$jsonApiKey][] = [
					'pack_id' => $pack->getPackID(),
					'quantity' => $pack->getQuantity(),
					'description' => $pack->getDescription(),
					'dimensions_d' => $pack->getDimensionsD(),
					'dimensions_s' => $pack->getDimensionsS(),
					'dimensions_v' => $pack->getDimensionsV(),
				];
			}
			return $result;
		} else {
			if (isset($value)) {
				$result[$jsonApiKey] = $value;
			}
			return $result;
		}
	}

}
