<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper\Constants;

class FreightCacheTypes
{

	const FREIGHT_CACHE_NO = 1;
	const FREIGHT_CACHE_DISCHARGE = 2; // Na vykládce
	const FREIGHT_CACHE_LOADING = 3; // Při nakládce

	const ALLOWED_FREIGHT_CACHE_TYPES = [
		self::FREIGHT_CACHE_NO => 'Ne',
		self::FREIGHT_CACHE_DISCHARGE => 'Na vykládce',
		self::FREIGHT_CACHE_LOADING => 'Při nakládce',
	];

}
