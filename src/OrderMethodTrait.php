<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper;

use ToptransApiWrapper\Entities\Order;

trait OrderMethodTrait
{

	protected function getRequestPath(): string
	{
		return self::REQUEST_PATH;
	}

	protected function getAllowedParameters(): array
	{
		return self::ALLOWED_PARAMETERS;
	}

}
