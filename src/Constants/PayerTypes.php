<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper\Constants;

class PayerTypes
{

	const PAYER_SENDER = '1'; //plátce=příkazce <-- DEFAULT
	const PAYER_RECEIVER = '2'; //plátce=příjemce
	const PAYER_ON_PICKUP = '4'; //platba při nakládce,
	const PAYER_OTHER = '3'; //jiný plátce popis

	const ALLOWED_PAYER_TYPES = [
		self::PAYER_SENDER => 'plátce=příkazce',
		self::PAYER_RECEIVER => 'plátce=příjemce',
		self::PAYER_ON_PICKUP => 'platba při nakládce',
		self::PAYER_OTHER => 'jiný plátce popis',
	];

}
