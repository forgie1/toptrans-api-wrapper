<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper;

use ToptransApiWrapper\Entities\Order;
use ToptransApiWrapper\Responses\OrderPriceResponse;

class OrderPriceMethod
{

	const REQUEST_PATH = '/order/price';

	const ALLOWED_PARAMETERS = [
	'loading.address.city',
	'loading.address.zip',
	'discharge.address.city',
	'discharge.address.zip',
	'twoway_shipment',
	'yard',
	'loading_aviso',
	'discharge_aviso',
	'loading_comfort_id',
	'loading_floors',
	'discharge_comfort_id',
	'discharge_floors',
	'return_pack_id',
	'return_pack_count',
	'cash_on_delivery_type',
	'oversize',
	'num_epals',
	'kg',
	'm3',
	];

	/** @var Order */
	private $order;

	public function __construct(Order $order)
	{
		$this->order = $order;
	}

	public function sendRequest(Request $request): OrderPriceResponse
	{
		$response = $request->sentRequest(OrderConverter::orderToArray($this->order, self::ALLOWED_PARAMETERS), self::REQUEST_PATH);
		return new OrderPriceResponse($response);
	}

}
