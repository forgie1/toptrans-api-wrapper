<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace Tests\Unit\TestObjects;

class Second3
{

	/** @var Third[] */
	private $third;

	public function __construct()
	{
		$this->third[] = new Third();
		$this->third[] = new Third();
	}

	/**
	 * @return Third[]
	 */
	public function getThird(): array
	{
		return $this->third;
	}

}
