<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace Tests\Unit\TestObjects;

class First3
{

	/** @var Second3 */
	private $second3;

	public function __construct()
	{
		$this->second3 = new Second3();
	}

	/**
	 * @return Second3
	 */
	public function getSecondThird(): Second3
	{
		return $this->second3;
	}

}
