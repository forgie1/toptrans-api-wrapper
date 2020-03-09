<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper;

use ToptransApiWrapper\Responses;

class OrderPriceMethod extends OrderMethod
{

	use OrderMethodTrait;

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

	public function sendRequest(Request $request): Responses\OrderPriceResponse
	{
		$response = parent::sendRequest($request);
		return new Responses\OrderPriceResponse($response);
	}

}
