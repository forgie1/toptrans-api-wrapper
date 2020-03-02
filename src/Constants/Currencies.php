<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper\Constants;

class Currencies
{

	const CURRENCY_CZK = '1';
	const CURRENCY_EUR = '2';

	const ALLOWED_CURRENCIES = [
		self::CURRENCY_CZK => 'CZK',
		self::CURRENCY_EUR => 'EUR',
	];

	const CURRENCY_MAP = [
		'CZK' => self::CURRENCY_CZK,
		'EUR' => self::CURRENCY_EUR,
	];

}
