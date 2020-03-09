<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper;

use ToptransApiWrapper\Entities\Order;

abstract class OrderMethod
{

	/** @var Order */
	protected $order;

	public function __construct(Order $order)
	{
		$this->order = $order;
	}

	/**
	 * @param Request $request
	 * @throws Exceptions\BadResponseException
	 * @throws Exceptions\ResponseStatusException
	 * @return array
	 */
	public function sendRequest(Request $request)
	{
		try {
			return $request->sendRequest(OrderConverter::orderToArray($this->order, $this->getAllowedParameters()), $this->getRequestPath());
		} catch (\ToptransApiWrapper\Exceptions\InvalidArgumentException $e) {
			return [
				'errors' => [
					$e->getMessage(),
				],
			];
		}
	}

	abstract protected function getRequestPath(): string;

	abstract protected function getAllowedParameters(): array;

}
