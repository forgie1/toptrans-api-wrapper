<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper;

use ToptransApiWrapper\Entities\Order;
use ToptransApiWrapper\Responses\ToptransResponse;

abstract class OrderMethod extends TTMethodA
{

	/**
	 * @param Request $request
	 * @throws Exceptions\BadResponseException
	 * @throws Exceptions\ResponseStatusException
	 * @return ToptransResponse|array
	 */
	public function sendRequest(Request $request): ToptransResponse|array
	{
		try {
			return $request->sendRequest($this->getTTEntity()->toArray($this->getAllowedParameters()), $this->getRequestPath());
		} catch (\ToptransApiWrapper\Exceptions\InvalidArgumentException $e) {
			return [
				'errors' => [
					$e->getMessage(),
				],
			];
		}
	}

	public function getTTEntity(): Order
	{
		return $this->entity;
	}

	abstract protected function getRequestPath(): string;

	abstract protected function getAllowedParameters(): array;

}
