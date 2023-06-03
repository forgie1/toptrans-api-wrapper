<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper\Entities;

use ToptransApiWrapper\Exceptions\InvalidArgumentException;
use ToptransApiWrapper\Constants\PackTypes;
use ToptransApiWrapper\Exceptions;

class Pack
{

	const COUNT_MIN = 1;
	const COUNT_MAX = 250;
	const DESCRIPTION_MAX_LEN = 100;

	/** @var int */
	protected $packID;

	/** @var int */
	protected $quantity;

	/** @var string|null */
	protected $description;

	/** @var int|null probably in [cm]*/
	protected $dimensionsD;

	/** @var int|null probably in [cm]*/
	protected $dimensionsS;

	/** @var int|null probably in [cm]*/
	protected $dimensionsV;

	/**
	 * @return int
	 */
	public function getPackID(): int
	{
		return $this->packID;
	}

	/**
	 * @param int $packID
	 * @return $this
	 * @throws InvalidArgumentException
	 */
	public function setPackID($packID)
	{
		if (!array_key_exists($packID, PackTypes::ALLOWED_TYPES)) {
			throw new InvalidArgumentException('Unsupported package type ' . $packID);
		}

		$this->packID = $packID;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getQuantity(): int
	{
		return $this->quantity;
	}

	/**
	 * @param int $quantity
	 * @return $this
	 * @throws Exceptions\InvalidArgumentException
	 */
	public function setQuantity($quantity)
	{
		if ($quantity < self::COUNT_MIN || $quantity > self::COUNT_MAX) {
			throw new Exceptions\InvalidArgumentException('Count can be only in the interval <' . self::COUNT_MIN . ', ' . self::COUNT_MAX . '>');
		}

		$this->quantity = $quantity;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getDescription(): ?string
	{
		return $this->description;
	}

	/**
	 * @param string|null $description
	 * @return $this
	 * @throws Exceptions\InvalidArgumentException
	 */
	public function setDescription($description)
	{
		if (mb_strlen($description, 'UTF-8') > 100) {
			throw new Exceptions\InvalidArgumentException('Pack description can be max ' . self::DESCRIPTION_MAX_LEN . ' characters long');
		}

		$this->description = $description;
		return $this;
	}

	/** dimension in cm
	 * @return int|null
	 */
	public function getDimensionsD(): ?int
	{
		return $this->dimensionsD;
	}

	/** dimension in cm
	 * @param int|null $dimensionsD
	 * @return $this
	 */
	public function setDimensionsD($dimensionsD)
	{
		$this->dimensionsD = $dimensionsD ?: null;
		return $this;
	}

	/** dimension in cm
	 * @return int|null
	 */
	public function getDimensionsS(): ?int
	{
		return $this->dimensionsS;
	}

	/** dimension in cm
	 * @param int|null $dimensionsS
	 * @return $this
	 */
	public function setDimensionsS($dimensionsS)
	{
		$this->dimensionsS = $dimensionsS ?: null;
		return $this;
	}

	/** dimension in cm
	 * @return int|null
	 */
	public function getDimensionsV(): ?int
	{
		return $this->dimensionsV;
	}

	/** dimension in cm
	 * @param int|null $dimensionsV
	 * @return $this
	 */
	public function setDimensionsV($dimensionsV)
	{
		$this->dimensionsV = $dimensionsV ?: null;
		return $this;
	}

}
