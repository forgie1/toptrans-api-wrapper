<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper;

use ToptransApiWrapper\Entities\OrderState;
use ToptransApiWrapper\Entities\TTEntity;
use ToptransApiWrapper\Exceptions\ToptransApiWrapperException;

class OrderSearchMethod extends TTMethodA
{

	const REQUEST_PATH = '/order/search';

	const ALLOWED_PARAMETERS = ['orderNumber' => 'orderNumber', 'itemNumber' => 'itemNumber', 'label' => 'label'];

	public function __construct(OrderState|TTEntity $entity)
	{
		if ($entity instanceof OrderState) {
			parent::__construct($entity);
		} else {
			throw new ToptransApiWrapperException('entity must by instance of OrderState::class');
		}
	}

	public function sendRequest(Request $request): Responses\OrderSearchResponse
	{
		$requestData = array_filter($this->getTTEntity()->toArray(), function ($key) {
			return isset(self::ALLOWED_PARAMETERS[$key]);
		}, ARRAY_FILTER_USE_KEY);
		$response = $request->sendRequest($requestData, self::REQUEST_PATH);

		return new Responses\OrderSearchResponse($response);
	}

	public function getTTEntity(): OrderState
	{
		return $this->entity;
	}

}
