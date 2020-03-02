<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper\Constants;

class LoadingTypes
{

	const LOADING_SELECT_PREDEFINED_SENDER = 1; //adresa objednavatele <-- DEFAULT
	const LOADING_SELECT_OTHER_ADDRESS = 2; //jiná adresa
	const LOADING_SELECT_PERSONAL = 3; //osobní podej

	const ALLOWED_LOADING_TYPES = [
		self::LOADING_SELECT_PREDEFINED_SENDER => 'adresa objednavatele',
		self::LOADING_SELECT_OTHER_ADDRESS => 'jiná adresa',
		self::LOADING_SELECT_PERSONAL => 'osobní podej',
	];

}
