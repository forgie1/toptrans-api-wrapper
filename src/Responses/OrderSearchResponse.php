<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2024 Ján Forgáč <forgac@artfocus.cz>
 */

declare(strict_types=1);

namespace ToptransApiWrapper\Responses;

use ToptransApiWrapper\Entities\OrderState;

class OrderSearchResponse extends ToptransResponse
{

	protected ?OrderState $orderState = null;

	public function getOrderState(): ?OrderState
	{
		return $this->orderState;
	}

	protected function parseRawData($data)
	{
		$this->orderState = new OrderState(
			$data['orderNumber'] ?? null,
			$data['loadingDate'] ?? null,
			$data['itemFrom'] ?? null,
			$data['itemTo'] ?? null,
			$data['label'] ?? null,
			$data['deliveryBranch'] ?? null,
			$data['deliveryDriver'] ?? null,
			$data['deliveryDate'] ?? null,
			$data['status'] ?? null,
		);
	}

}
