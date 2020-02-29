<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper\Responses;

class OrderPriceResponse extends ToptransResponse
{

	/** @var float|null */
	private $price;

	public function __construct(array $data)
	{
		parent::__construct($data);
		$this->parseRawData($this->getRawData());
	}

	/**
	 * @return float|null
	 */
	public function getPrice(): ?float
	{
		return $this->price;
	}

	private function parseRawData($data)
	{
		$this->price = $data['price'] ?? null;
	}

}
