<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper\Responses;

class OrderSaveResponse extends ToptransResponse
{

	/** @var string */
	private $id;

	/**
	 * @return float|null
	 */
	public function getOrderId()
	{
		return $this->id;
	}

	protected function parseRawData($data)
	{
		$this->id = $data['id'] ?? null;
	}

}
