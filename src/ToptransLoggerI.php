<?php

/**
 * This file is part of ArtFocus ArtCMS.
 * Copyright © 2021 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper;

interface ToptransLoggerI
{

	public function logg(string $message, mixed $context = null);

}
