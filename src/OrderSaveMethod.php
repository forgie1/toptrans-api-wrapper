<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper;

use ToptransApiWrapper\Constants\OrderApiArrayKeys;
use ToptransApiWrapper\Responses;

class OrderSaveMethod extends OrderMethod
{

	use OrderMethodTrait;

	const REQUEST_PATH = '/order/save';

	const ALLOWED_PARAMETERS = OrderApiArrayKeys::ALL_API_KEYS;

	public function sendRequest(Request $request): Responses\OrderSaveResponse
	{
		$response = parent::sendRequest($request);
		return new Responses\OrderSaveResponse($response);
	}

}
