<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper\Entities;

use ToptransApiWrapper\Exceptions;
use ToptransApiWrapper\Exceptions\InvalidArgumentException;

/**
 * Dangerous package details
 * (not required)
 */
class Adr
{

	const COUNT_MIN = 1;
	const COUNT_MAX = 250;
	const DESCRIPTION_MAX_LEN = 100;

	/** @var int */
	private $un;

	/** @var int */
	private $count;

	/** @var float */
	private $kg;

	/** @var string|null */
	private $description;

	/** @var boolean|null */
	private $environmentDanger;

	/**
	 * @return int
	 * @throws InvalidArgumentException
	 */
	public function getUn(): int
	{
		if (!$this->un) {
			throw new InvalidArgumentException('Address city is mandatory');
		}
		return $this->un;
	}

	/**
	 * @param int $un
	 * @return $this
	 */
	public function setUn(int $un)
	{
		// Todo: Toptrans APi constants is not accessible at the moment
		$this->un = $un;
		return $this;
	}

	/**
	 * @return int
	 * @throws InvalidArgumentException
	 */
	public function getCount(): int
	{
		if (!$this->count) {
			throw new InvalidArgumentException('Address city is mandatory');
		}
		return $this->count;
	}

	/**
	 * @param int $count
	 * @return $this
	 * @throws Exceptions\InvalidArgumentException
	 */
	public function setCount(int $count)
	{
		if ($count < self::COUNT_MIN || $count > self::COUNT_MAX) {
			throw new Exceptions\InvalidArgumentException('Count can be only in the interval <' . self::COUNT_MIN . ', ' . self::COUNT_MAX . '>');
		}

		$this->count = $count;
		return $this;
	}

	/**
	 * @return float
	 * @throws InvalidArgumentException
	 */
	public function getKg(): float
	{
		if (!$this->kg) {
			throw new InvalidArgumentException('Address city is mandatory');
		}
		return $this->kg;
	}

	/**
	 * @param float $kg
	 * @return $this
	 */
	public function setKg(float $kg)
	{
		$this->kg = $kg;
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
	public function setDescription(?string $description)
	{
		if (strlen($description) > 100) {
			throw new Exceptions\InvalidArgumentException('Description can be max ' . self::DESCRIPTION_MAX_LEN . ' characters long');
		}

		$this->description = $description;
		return $this;
	}

	/**
	 * @return bool|null
	 */
	public function isEnvironmentDanger(): ?bool
	{
		return $this->environmentDanger;
	}

	/**
	 * @param bool|null $environmentDanger
	 * @return $this
	 */
	public function setEnvironmentDanger(?bool $environmentDanger)
	{
		$this->environmentDanger = $environmentDanger;
		return $this;
	}

}