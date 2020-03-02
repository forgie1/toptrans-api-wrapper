<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper\Constants;

class DischargeComfortTypes
{

	const DISCHARGE_COMFORT = 1; //Comfort nakládka - Ne <-- DEFAULT
	const DISCHARGE_TOP_COMFORT = 2; //Top Comfort
	const DISCHARGE_TOP_COMFORT_PLUS = 5; //Top comfort Plus
	const DISCHARGE_COMFORT_EXCLUSIVE = 6; //Comfort Exclusive

	const ALLOWED_DISCHARGE_COMFORT_TYPES = [
		self::DISCHARGE_COMFORT => 'Ne',
		self::DISCHARGE_TOP_COMFORT => 'Top Comfort',
		self::DISCHARGE_TOP_COMFORT_PLUS => 'Top comfort Plus',
		self::DISCHARGE_COMFORT_EXCLUSIVE => 'Comfort Exclusive',
	];

}
