<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace Tests\Unit\TestObjects;

class Root3
{

	/** @var First3[] */
	private $first3;

	/** @var Second[] */
	private $second;

	/** @var Third */
	private $third;

	public function __construct()
	{
		$this->first3[] = new First3();
		$this->first3[] = new First3();
		$this->first3[] = new First3();
		$this->second[] = new Second();
		$this->second[] = new Second();
		$this->third = new Third();
	}

	/**
	 * @return First[]
	 */
	public function getFirst3(): array
	{
		return $this->first3;
	}

	/**
	 * @return Second[]
	 */
	public function getSecond(): array
	{
		return $this->second;
	}

	/**
	 * @return Third
	 */
	public function getThird(): Third
	{
		return $this->third;
	}

}
