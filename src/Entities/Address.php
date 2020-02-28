<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper\Entities;

use ToptransApiWrapper\Exceptions\InvalidArgumentException;

class Address
{

	/** @var string */
	private $city;

	/** @var string|null */
	private $cityPart;

	/**
	 * @var string|null
	 * can be including house number
	 */
	private $street;

	/**
	 * @var string|null
	 * can be with descriptive number
	 */
	private $houseNumber;

	/** @var string|null */
	private $zip;

	/**
	 * @return string
	 * @throws InvalidArgumentException
	 */
	public function getCity(): string
	{
		if (!$this->city) {
			throw new InvalidArgumentException('Address city is mandatory');
		}

		return $this->city;
	}

	/**
	 * @param string $city
	 * @return $this
	 */
	public function setCity(string $city)
	{
		$this->city = $city;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getCityPart(): ?string
	{
		return $this->cityPart;
	}

	/**
	 * @param string|null $cityPart
	 * @return $this
	 */
	public function setCityPart(string $cityPart)
	{
		$this->cityPart = $cityPart;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getStreet(): ?string
	{
		return $this->street;
	}

	/**
	 * @param string|null $street
	 * @return $this
	 */
	public function setStreet(string $street)
	{
		$this->street = $street;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getHouseNumber(): ?string
	{
		return $this->houseNumber;
	}

	/**
	 * @param string|null $houseNumber
	 * @return $this
	 */
	public function setHouseNumber(string $houseNumber)
	{
		$this->houseNumber = $houseNumber;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getZip(): ?string
	{
		return $this->zip;
	}

	/**
	 * @param string|null $zip
	 * @return $this
	 */
	public function setZip(string $zip)
	{
		$this->zip = $zip;
		return $this;
	}

}
