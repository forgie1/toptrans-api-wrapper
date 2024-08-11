<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2024 Ján Forgáč <forgac@artfocus.cz>
 */

declare(strict_types=1);

namespace ToptransApiWrapper\Constants;

class OrderStates
{

	const DELIVERED = 'Ukončená';
	const NEW = 'Nová'; // Toptrans didn't pick up the Order from Loading address yet

}
