<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper;

use ToptransApiWrapper\Exceptions\BadResponseException;
use ToptransApiWrapper\Exceptions\ResponseStatusException;
use ToptransApiWrapper\Responses\OrderListResponse;
use ToptransApiWrapper\Responses\ToptransResponse;

class OrderListMethod extends OrderMethod
{

	use OrderMethodTrait;

	const REQUEST_PATH = '/order/list';

	const ALLOWED_PARAMETERS = [];

	/**
	 * @param Request $request
	 * @return OrderListResponse
	 * @throws BadResponseException
	 * @throws ResponseStatusException
	 */
	public function sendRequest(Request $request): OrderListResponse
	{
		$response = parent::sendRequest($request);
		return new Responses\OrderListResponse($response);
	}

}
