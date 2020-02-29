<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace Tests\Unit\TestObjects;

class Root
{

	/** @var First */
	private $first;

	public function __construct()
	{
		$this->first = new First();
	}

	/**
	 * @return First
	 */
	public function getFirst(): First
	{
		return $this->first;
	}

}
