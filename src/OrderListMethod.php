<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper;

use ToptransApiWrapper\Responses;

class OrderListMethod extends OrderMethod
{

	use OrderMethodTrait;

	const REQUEST_PATH = '/order/list';

	const ALLOWED_PARAMETERS = [];

	/**
	 * @param Request $request
	 * @return Responses\OrderListResponse
	 * @throws Exceptions\BadResponseException
	 * @throws Exceptions\ResponseStatusException
	 */
	public function sendRequest(Request $request): Responses\OrderListResponse
	{
		$response = parent::sendRequest($request);
		return new Responses\OrderListResponse($response);
	}

}
