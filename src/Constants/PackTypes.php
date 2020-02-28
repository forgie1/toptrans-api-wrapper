<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper\Constants;

interface PackTypes
{

	const PUL_PALETY = 25;
	const BALIK = 55;
	const BEDNA = 32;
	const BITO_BOX = 65;
	const BOX = 33;
	const EPAL = 3;
	const FOL = 5;
	const IBC = 14;
	const KANYSTR = 37;
	const KARTON = 2;
	const KUFR = 31;
	const KUS = 1;
	const NADOBA = 34;
	const OBALKA = 26;
	const PALETA = 13;
	const PNEU = 4;
	const PYTEL = 7;
	const RKS = 54;
	const ROLE = 27;
	const SPIRO = 66;
	const SUD = 28;
	const SVAZEK = 6;
	const VAK = 29;
	const XKARTON = 45;
	const XKUS = 44;
	const XOBALKA = 30;

	const ALLOWED_TYPES = [
		self::PUL_PALETY => 'PUL_PALETY',
		self::BALIK => 'BALIK',
		self::BEDNA => 'BEDNA',
		self::BITO_BOX => 'BITO_BOX',
		self::BOX => 'BOX',
		self::EPAL => 'EPAL',
		self::FOL => 'FOL',
		self::IBC => 'IBC',
		self::KANYSTR => 'KANYSTR',
		self::KARTON => 'KARTON',
		self::KUFR => 'KUFR',
		self::KUS => 'KUS',
		self::NADOBA => 'NADOBA',
		self::OBALKA => 'OBALKA',
		self::PALETA => 'PALETA',
		self::PNEU => 'PNEU',
		self::PYTEL => 'PYTEL',
		self::RKS => 'RKS',
		self::ROLE => 'ROLE',
		self::SPIRO => 'SPIRO',
		self::SUD => 'SUD',
		self::SVAZEK => 'SVAZEK',
		self::VAK => 'VAK',
		self::XKARTON => 'XKARTON',
		self::XKUS => 'XKUS',
		self::XOBALKA => 'XOBALKA',
	];

}
