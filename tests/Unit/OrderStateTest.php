<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2024 Ján Forgáč <forgac@artfocus.cz>
 */

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use ToptransApiWrapper\Entities\OrderState;

class OrderStateTest extends TestCase
{

	public function testOrderState()
	{
		$orderState = new OrderState('123');
		$this->assertSame(['orderNumber' => '123'], $orderState->toArray());
	}

}
