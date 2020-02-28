<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper\Constants;

interface Branches
{

	const Praha = 1;
	const Kralupy_nad_Vltavou = 2;
	const Kolin = 3;
	const Ceske_Budejovice = 4;
	const Benesov = 5;
	const Cheb = 6;
	const Plzen = 7;
	const Beroun = 8;
	const Lovosice = 9;
	const Liberec = 10;
	const Usti_nad_Labem = 11;
	const Mlada_Boleslav = 12;
	const Pardubice = 13;
	const Hradec_Kralove = 14;
	const Trutnov = 15;
	const Brno = 16;
	const Uherske_Hradiste = 17;
	const Hodonin = 18;
	const Trebic = 19;
	const Svitavy = 20;
	const Jihlava = 21;
	const Olomouc = 22;
	const Sumperk = 23;
	const Novy_Jicin = 24;
	const Ostrava = 25;
	const Svaty_Jur = 26;
	const Trencin = 27;
	const Nitra = 28;
	const Banska_Bystrica = 29;
	const Poprad = 30;
	const Kosice = 31;
	const Zilina = 32;
	const IT = 102;

	const ALLOWED_BRANCHES = [
		self::Praha => 'Praha',
		self::Kralupy_nad_Vltavou => 'Kralupy_nad_Vltavou',
		self::Kolin => 'Kolin',
		self::Ceske_Budejovice => 'Ceske_Budejovice',
		self::Benesov => 'Benesov',
		self::Cheb => 'Cheb',
		self::Plzen => 'Plzen',
		self::Beroun => 'Beroun',
		self::Lovosice => 'Lovosice',
		self::Liberec => 'Liberec',
		self::Usti_nad_Labem => 'Usti_nad_Labem',
		self::Mlada_Boleslav => 'Mlada_Boleslav',
		self::Pardubice => 'Pardubice',
		self::Hradec_Kralove => 'Hradec_Kralove',
		self::Trutnov => 'Trutnov',
		self::Brno => 'Brno',
		self::Uherske_Hradiste => 'Uherske_Hradiste',
		self::Hodonin => 'Hodonin',
		self::Trebic => 'Trebic',
		self::Svitavy => 'Svitavy',
		self::Jihlava => 'Jihlava',
		self::Olomouc => 'Olomouc',
		self::Sumperk => 'Sumperk',
		self::Novy_Jicin => 'Novy_Jicin',
		self::Ostrava => 'Ostrava',
		self::Svaty_Jur => 'Svaty_Jur',
		self::Trencin => 'Trencin',
		self::Nitra => 'Nitra',
		self::Banska_Bystrica => 'Banska_Bystrica',
		self::Poprad => 'Poprad',
		self::Kosice => 'Kosice',
		self::Zilina => 'Zilina',
		self::IT => 'IT',
	];

}
