<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2024 Ján Forgáč <forgac@artfocus.cz>
 */

declare(strict_types=1);

namespace ToptransApiWrapper;

use ToptransApiWrapper\Entities\TTEntity;

abstract class TTMethodA implements TTMethod
{

	/** @var TTEntity */
	protected $entity;

	public function __construct(TTEntity $entity)
	{
		$this->entity = $entity;
	}

	abstract public function getTTEntity(): TTEntity;

}
