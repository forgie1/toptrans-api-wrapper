<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper\Constants;

interface OrderTerms
{

	const STANDARD = 1;
	const TOP_TIME = 2;
	const TOP_PRIVAT = 3;
	const TOP_WEEKEND = 4;
	const PERSONAL_PICKUP = 5;
	const DELIVERY_AFTER_AVISO = 16;

	const ALLOWED_TERMS = [
		self::STANDARD => 'Standard',
		self::TOP_TIME => 'TopTime',
		self::TOP_PRIVAT => 'Top Privat',
		self::TOP_WEEKEND => 'Top Weekend',
		self::PERSONAL_PICKUP => 'Osobní odběr',
		self::DELIVERY_AFTER_AVISO => 'Rozvoz po avizaci'
	];

}
