<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace Tests\Unit\TestObjects;

class Third
{

	public function getFourth(): bool
	{
		return true;
	}

	public function getZero()
	{
		return 0;
	}

	public function getNull()
	{
		return null;
	}

	public function getNullArray()
	{
		return [];
	}

	public function getValueArray()
	{
		return [1, 3, 5, 7];
	}

}
