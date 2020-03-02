<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper\Constants;

class LoadingComfortTypes
{

	const LOADING_COMFORT = 1; //Comfort nakládka - Ne <-- DEFAULT
	const LOADING_TOP_COMFORT = 2; //Top Comfort
	const LOADING_TOP_COMFORT_PLUS_2 = 3; //bílá technika;
	const LOADING_TOP_COMFORT_PLUS_PLUS = 4; //bílá technika - mimo depo
	const LOADING_TOP_COMFORT_PLUS = 5; //Top comfort Plus
	const LOADING_COMFORT_EXCLUSIVE = 6; //Comfort Exclusive

	const ALLOWED_LOADING_COMFORT_TYPES = [
		self::LOADING_COMFORT => 'Ne',
		self::LOADING_TOP_COMFORT => 'Top Comfort',
		self::LOADING_TOP_COMFORT_PLUS_2 => 'bílá technika;',
		self::LOADING_TOP_COMFORT_PLUS_PLUS => 'bílá technika - mimo depo',
		self::LOADING_TOP_COMFORT_PLUS => 'Top comfort Plus',
		self::LOADING_COMFORT_EXCLUSIVE => 'Comfort Exclusive',
	];

}
