<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2024 Ján Forgáč <forgac@artfocus.cz>
 */

declare(strict_types=1);

namespace ToptransApiWrapper;

use ToptransApiWrapper\Entities\TTEntity;
use ToptransApiWrapper\Responses\ToptransResponse;

interface TTMethod
{

	public function __construct(TTEntity $entity);

	/**
	 * @param Request $request
	 * @throws Exceptions\BadResponseException
	 * @throws Exceptions\ResponseStatusException
	 * @return ToptransResponse|array
	 */
	public function sendRequest(Request $request): ToptransResponse|array;

}
