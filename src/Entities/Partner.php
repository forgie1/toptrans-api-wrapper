<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper\Entities;

use http\Exception\InvalidArgumentException;
use function Sodium\add;

class Partner
{

	/** @var string */
	private $name;

	/** @var string */
	private $registrationCode;

	/** @var string|null */
	private $vatNumber;

	/** @var string|null */
	private $contactPersonFirstName;

	/** @var string|null */
	private $contactPersonLastName;

	/** @var string|null */
	private $contactPersonPhone;

	/** @var string|null */
	private $contactPersonEmail;

	/** @var Address */
	private $address;

	/**
	 * @return string
	 */
	public function getName(): string
	{
		if (!$this->name) {
			throw new InvalidArgumentException('Address is mandatory in Partner');
		}

		return $this->name;
	}

	/**
	 * @param string $name
	 * @return $this
	 */
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getRegistrationCode(): string
	{
		return $this->registrationCode;
	}

	/**
	 * @param string $registrationCode
	 * @return $this
	 */
	public function setRegistrationCode($registrationCode)
	{
		$this->registrationCode = $registrationCode;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getVatNumber(): ?string
	{
		return $this->vatNumber;
	}

	/**
	 * @param string|null $vatNumber
	 * @return $this
	 */
	public function setVatNumber($vatNumber)
	{
		$this->vatNumber = $vatNumber;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getContactPersonFirstName(): ?string
	{
		return $this->contactPersonFirstName;
	}

	/**
	 * @param string|null $contactPersonFirstName
	 * @return $this
	 */
	public function setContactPersonFirstName($contactPersonFirstName)
	{
		$this->contactPersonFirstName = $contactPersonFirstName;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getContactPersonLastName(): ?string
	{
		return $this->contactPersonLastName;
	}

	/**
	 * @param string|null $contactPersonLastName
	 * @return $this
	 */
	public function setContactPersonLastName($contactPersonLastName)
	{
		$this->contactPersonLastName = $contactPersonLastName;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getContactPersonPhone(): ?string
	{
		return $this->contactPersonPhone;
	}

	/**
	 * @param string|null $contactPersonPhone
	 * @return $this
	 */
	public function setContactPersonPhone($contactPersonPhone)
	{
		$this->contactPersonPhone = $contactPersonPhone;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getContactPersonEmail(): ?string
	{
		return $this->contactPersonEmail;
	}

	/**
	 * @param string|null $contactPersonEmail
	 * @return $this
	 */
	public function setContactPersonEmail($contactPersonEmail)
	{
		$this->contactPersonEmail = $contactPersonEmail;
		return $this;
	}

	/**
	 * @return Address
	 */
	public function getAddress(): Address
	{
		if (!$this->address) {
			throw new InvalidArgumentException('Address is mandatory in Partner');
		}

		return $this->address;
	}

	/**
	 * @param Address $address
	 * @return $this
	 */
	public function setAddress(Address $address)
	{
		$this->address = $address;
		return $this;
	}



}
