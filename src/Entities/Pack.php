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
	private $length;

	/** @var int|null probably in [cm]*/
	private $width;

	/** @var int|null probably in [cm]*/
	private $height;

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
	public function getLength(): ?int
	{
		return $this->length;
	}

	/**
	 * @param int|null $length
	 * @return $this
	 */
	public function setLength($length)
	{
		$this->length = $length;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getWidth(): ?int
	{
		return $this->width;
	}

	/**
	 * @param int|null $width
	 * @return $this
	 */
	public function setWidth($width)
	{
		$this->width = $width;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getHeight(): ?int
	{
		return $this->height;
	}

	/**
	 * @param int|null $height
	 * @return $this
	 */
	public function setHeight($height)
	{
		$this->height = $height;
		return $this;
	}

}