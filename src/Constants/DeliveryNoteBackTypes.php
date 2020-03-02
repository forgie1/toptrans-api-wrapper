<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper\Constants;

class DeliveryNoteBackTypes
{

	const DELIVERY_NOTE_BACK_NO = 0; // <-- DEFAULT
	const DELIVERY_NOTE_BACK_ELECTRONIC = 1; //Elektronicky
	const DELIVERY_NOTE_BACK_PAPER = 2; //Fyzicky
	const DELIVERY_NOTE_BACK_BOTH = 3; //Fyzicky + Elektronicky

	const ALLOWED_DELIVERY_NOTE_BACK_TYPES = [
		self::DELIVERY_NOTE_BACK_NO => 'Ne',
		self::DELIVERY_NOTE_BACK_ELECTRONIC => 'Elektronicky',
		self::DELIVERY_NOTE_BACK_PAPER => 'Fyzicky',
		self::DELIVERY_NOTE_BACK_BOTH => 'Fyzicky + Elektronicky',
	];

}
