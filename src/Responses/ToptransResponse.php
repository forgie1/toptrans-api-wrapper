<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper\Responses;

abstract class ToptransResponse
{

	const STATUS_OK = 'ok';
	const STATUS_ERROR = 'error';

	/** @var string */
	private $status;

	/** @var string */
	private $errors = [];

	/** @var array */
	private $rawData = [];

	public function __construct(array $data)
	{
		$this->status = $data['status'] ?? 'error';
		$this->errors = $data['errors'] ?? [];
		$this->rawData = $data['data'] ?? [];
	}

	public function isOk(): bool
	{
		return $this->getStatus() === self::STATUS_OK;
	}

	/**
	 * @return string
	 */
	public function getStatus(): string
	{
		return $this->status;
	}

	/**
	 * @param string $status
	 * @return $this
	 */
	public function setStatus($status)
	{
		$this->status = $status;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getErrors(): string
	{
		return $this->errors;
	}

	/**
	 * @param string $errors
	 * @return $this
	 */
	public function setErrors($errors)
	{
		$this->errors = $errors;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getRawData(): array
	{
		return $this->rawData;
	}

	/**
	 * @param array $rawData
	 * @return $this
	 */
	public function setRawData($rawData)
	{
		$this->rawData = $rawData;
		return $this;
	}

}
