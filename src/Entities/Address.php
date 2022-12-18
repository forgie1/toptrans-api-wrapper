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
	protected $city;

	/** @var string|null */
	protected $cityPart;

	/**
	 * @var string|null
	 * can be including house number
	 */
	protected $street;

	/**
	 * @var string|null
	 * can be with descriptive number
	 */
	protected $houseNum;

	/** @var string|null */
	protected $zip;

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
	public function setCityPart(?string $cityPart)
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
	public function setStreet(?string $street)
	{
		$this->street = $street;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getHouseNum(): ?string
	{
		return $this->houseNum;
	}

	/**
	 * @param string|null $houseNum
	 * @return $this
	 */
	public function setHouseNum(?string $houseNum)
	{
		$this->houseNum = $houseNum;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getZip(): ?string
	{
		return str_replace(' ', '', $this->zip ?? '');
	}

	/**
	 * @param string|null $zip
	 * @return $this
	 */
	public function setZip(?string $zip)
	{
		$this->zip = $zip;
		return $this;
	}

}
