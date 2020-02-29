<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace Tests\Unit\TestObjects;

class First
{

	/** @var Second */
	private $second;

	public function __construct()
	{
		$this->second = new Second();
	}

	/**
	 * @return Second
	 */
	public function getSecond(): Second
	{
		return $this->second;
	}

}
