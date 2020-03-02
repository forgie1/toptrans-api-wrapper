<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper\Constants;

class ServiceTypes
{

	const SERVICE_LIST = [
		'twowayShipment' => 'Obousměrná zásilka',
		'yard' => 'Sběrný dvůr',
		'consider' => 'Převážit',
		'smsAviso' => 'Avizace SMS',
		'loadingAviso' => 'Tel. Avizace nakládky',
		'dischargeAviso' => 'Tel. Avizace vykládky',
		'hydraulicFrontLoading' => 'Hydr. čelo nakládka',
		'hydraulicFrontDischarge' => 'Hydr. čelo vykládka',
		'labelFragile' => 'Křehké',
		'labelThisSideUp' => 'Neklopit',
		'labelDontTilt' => 'Nestohovat',
	];

}
