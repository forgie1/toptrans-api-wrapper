<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper\Entities;

use ToptransApiWrapper\Exceptions\InvalidArgumentException;

class Partner
{

	/** @var string */
	protected $name;

	/** @var string */
	protected $registrationCode;

	/** @var string|null */
	protected $vatCode;

	/** @var string|null */
	protected $firstName;

	/** @var string|null */
	protected $lastName;

	/** @var string|null */
	protected $phone;

	/** @var string|null */
	protected $email;

	/** @var Address */
	protected $address;

	/**
	 * @return string
	 * @throws InvalidArgumentException
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
		return $this->registrationCode ?? '';
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
	public function getVatCode(): ?string
	{
		return $this->vatCode;
	}

	/**
	 * @param string|null $vatCode
	 * @return $this
	 */
	public function setVatCode($vatCode)
	{
		$this->vatCode = $vatCode;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getFirstName(): ?string
	{
		return $this->firstName;
	}

	/**
	 * @param string|null $firstName
	 * @return $this
	 */
	public function setFirstName($firstName)
	{
		$this->firstName = $firstName;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getLastName(): ?string
	{
		return $this->lastName;
	}

	/**
	 * @param string|null $lastName
	 * @return $this
	 */
	public function setLastName($lastName)
	{
		$this->lastName = $lastName;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getPhone(): ?string
	{
		return $this->phone;
	}

	/**
	 * @param string|null $phone
	 * @return $this
	 */
	public function setPhone($phone)
	{
		$this->phone = $phone;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getEmail(): ?string
	{
		return $this->email;
	}

	/**
	 * @param string|null $email
	 * @return $this
	 */
	public function setEmail($email)
	{
		$this->email = $email;
		return $this;
	}

	/**
	 * @return Address
	 * @throws InvalidArgumentException
	 */
	public function getAddress()
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
	public function setAddress($address)
	{
		$this->address = $address;
		return $this;
	}

}
