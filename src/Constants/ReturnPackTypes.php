<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper\Constants;

class ReturnPackTypes
{

	const RETURN_PACK_NO = 0;
	const RETURN_PACK_NORMAL = 1;
	const RETURN_PACK_BIG = 2;

	const ALLOWED_RETURN_PACK_TYPES = [
		self::RETURN_PACK_NO => 'Ne',
		self::RETURN_PACK_NORMAL => 'Normální',
		self::RETURN_PACK_BIG => 'Velký',
	];

}
