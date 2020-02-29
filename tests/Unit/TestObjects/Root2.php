<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace Tests\Unit\TestObjects;

class Root2
{

	/** @var First */
	private $first;

	/** @var Second */
	private $second;

	/** @var Third */
	private $third;

	public function __construct()
	{
		$this->first = new First();
		$this->second = new Second();
		$this->third = new Third();
	}

	/**
	 * @return First
	 */
	public function getFirst(): First
	{
		return $this->first;
	}

	/**
	 * @return Second
	 */
	public function getSecond(): Second
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
