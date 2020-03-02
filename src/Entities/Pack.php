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
	private $type;

	/** @var int */
	private $quantity;

	/** @var string|null */
	private $description;

	/** @var int|null probably in [cm]*/
	private $dimensionsD;

	/** @var int|null probably in [cm]*/
	private $dimensionsS;

	/** @var int|null probably in [cm]*/
	private $dimensionsV;

	/**
	 * @return int
	 */
	public function getType(): int
	{
		return $this->type;
	}

	/**
	 * @param int $type
	 * @return $this
	 * @throws InvalidArgumentException
	 */
	public function setType($type)
	{
		if (!array_key_exists($type, PackTypes::ALLOWED_TYPES)) {
			throw new InvalidArgumentException('Unsupported package type ' . $type);
		}

		$this->type = $type;
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
		if (strlen($description) > 100) {
			throw new Exceptions\InvalidArgumentException('Description can be max ' . self::DESCRIPTION_MAX_LEN . ' characters long');
		}

		$this->description = $description;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getDimensionsD(): ?int
	{
		return $this->dimensionsD;
	}

	/**
	 * @param int|null $dimensionsD
	 * @return $this
	 */
	public function setDimensionsD($dimensionsD)
	{
		$this->dimensionsD = $dimensionsD;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getDimensionsS(): ?int
	{
		return $this->dimensionsS;
	}

	/**
	 * @param int|null $dimensionsS
	 * @return $this
	 */
	public function setDimensionsS($dimensionsS)
	{
		$this->dimensionsS = $dimensionsS;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getDimensionsV(): ?int
	{
		return $this->dimensionsV;
	}

	/**
	 * @param int|null $dimensionsV
	 * @return $this
	 */
	public function setDimensionsV($dimensionsV)
	{
		$this->dimensionsV = $dimensionsV;
		return $this;
	}

}
