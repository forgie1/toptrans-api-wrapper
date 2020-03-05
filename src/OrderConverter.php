<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper;

use ToptransApiWrapper\Entities\Adr;
use ToptransApiWrapper\Entities\Pack;
use ToptransApiWrapper\Exceptions\ToptransApiWrapperException;

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

		if (isset($arrayOrder['m3']) && !$arrayOrder['m3']) {
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
			while ($entity = array_shift($value)) {
				if (is_object($entity)) {
					switch (get_class($entity)) {
						case Pack::class:
							/** @var Pack $entity */
							$result[$jsonApiKey][] = [
								'pack_id' => $entity->getPackID(),
								'quantity' => $entity->getQuantity(),
								'description' => $entity->getDescription(),
								'dimensions_d' => $entity->getDimensionsD(),
								'dimensions_s' => $entity->getDimensionsS(),
								'dimensions_v' => $entity->getDimensionsV(),
							];
							break;
						case Adr::class:
							/** @var Adr $entity */
							$result[$jsonApiKey][] = [
								'un' => $entity->getUn(),
								'count' => $entity->getCount(),
								'kg' => $entity->getKg(),
								'description' => $entity->getDescription(),
								'environment_danger' => $entity->isEnvironmentDanger(),
							];
							break;
						default:
							throw new ToptransApiWrapperException('Unknown entity: ' . get_class($entity));
					}
				} else {
					throw new ToptransApiWrapperException('Unsupported array type: ' . gettype($entity));
				}
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
