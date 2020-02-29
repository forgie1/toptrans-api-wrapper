<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use ToptransApiWrapper\Exceptions\OrderConverter;
use Tests\Unit\TestObjects;

class OrderConverterTest extends TestCase
{

	public function testParseValue()
	{
		$nestedMethods = ['first.second.third.fourth'];
		$root = new TestObjects\Root();
		$this->assertSame(['first' => ['second' => ['third' => ['fourth' => true]]]], OrderConverter::orderToArray($root, $nestedMethods));
	}

	public function testParseValue2()
	{
		$nestedMethods = ['first.second.third.fourth', 'second.third.fourth', 'third.fourth'];
		$root = new TestObjects\Root2();
		$this->assertSame([
			'first' => [
				'second' => [
					'third' => [
						'fourth' => true,
					],
				],
			],
			'second' => [
				'third' => [
					'fourth' => true,
				],
			],
			'third' => [
				'fourth' => true,
			],
		], OrderConverter::orderToArray($root, $nestedMethods));
	}

	public function testParseValue3()
	{
		$nestedMethods = ['second.third.fourth', 'third.fourth'];
		$root = new TestObjects\Root3();
		$this->assertSame([
			0 => [
				'second' => [
					'third' => [
						'fourth' => true,
					],
				],
			],
			1 => [
				'second' => [
					'third' => [
						'fourth' => true,
					],
				],
			],
			'third' => [
				'fourth' => true,
			],
		], OrderConverter::orderToArray($root, $nestedMethods));
	}

	public function testParseValue4()
	{
		$nestedMethods = ['first3.second_third.third.fourth', 'second.third.fourth', 'third.fourth'];
		$root = new TestObjects\Root3();
		$this->assertSame([
			0 => [
				'first3' => [
					'second_third' => [
						0 => [
							'third' => [
								'fourth' => true,
							],
						],
						1 => [
							'third' => [
								'fourth' => true,
							],
						],
					],
				],
			],
			1 => [
				'first3' => [
					'second_third' => [
						0 => [
							'third' => [
								'fourth' => true,
							],
						],
						1 => [
							'third' => [
								'fourth' => true,
							],
						],
					],
				],
			],
			2 => [
				'first3' => [
					'second_third' => [
						0 => [
							'third' => [
								'fourth' => true,
							],
						],
						1 => [
							'third' => [
								'fourth' => true,
							],
						],
					],
				],
			],
			'third' => [
				'fourth' => true,
			],
		], OrderConverter::orderToArray($root, $nestedMethods));
	}

}
