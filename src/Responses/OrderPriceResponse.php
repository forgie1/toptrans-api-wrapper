<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper\Responses;

use ToptransApiWrapper\Constants\Currencies;

class OrderPriceResponse extends ToptransResponse
{

	/** @var float|null */
	private $price;

	/** @var string|null */
	private $currencyCode;

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

	/**
	 * @return string|null
	 */
	public function getCurrencyCode(): ?string
	{
		return $this->currencyCode;
	}

	private function parseRawData($data)
	{
		$this->price = $data['PRICE'] ?? null;
		$this->currencyCode = Currencies::ALLOWED_CURRENCIES[$data['CURRENCY_ID']] ?? null;
	}

}
