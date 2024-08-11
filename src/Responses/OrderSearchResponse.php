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
			$data[0]['orderNumber'] ?? null,
			$data[0]['loadingDate'] ?? null,
			$data[0]['itemFrom'] ?? null,
			$data[0]['itemTo'] ?? null,
			$data[0]['label'] ?? null,
			$data[0]['deliveryBranch'] ?? null,
			$data[0]['deliveryDriver'] ?? null,
			$data[0]['deliveryDate'] ?? null,
			$data[0]['status'] ?? null,
		);
	}

}
