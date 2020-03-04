<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper;

use ToptransApiWrapper\Constants\OrderApiArrayKeys;
use ToptransApiWrapper\Entities\Order;
use ToptransApiWrapper\Responses\OrderSaveResponse;

class OrderSaveMethod
{

	const REQUEST_PATH = '/order/save';

	const ALLOWED_PARAMETERS = OrderApiArrayKeys::ALL_API_KEYS;

	/** @var Order */
	private $order;

	public function __construct(Order $order)
	{
		$this->order = $order;
	}

	public function sendRequest(Request $request): OrderSaveResponse
	{
		$response = $request->sentRequest(OrderConverter::orderToArray($this->order, self::ALLOWED_PARAMETERS), self::REQUEST_PATH);
		return new OrderSaveResponse($response);
	}

}
