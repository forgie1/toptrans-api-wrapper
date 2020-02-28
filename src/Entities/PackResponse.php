<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper\Entities;

class PackResponse extends Pack
{

	/** @var int */
	private $pieceNumberFrom;

	/** @var int[] */
	private $pieceNumbers;

	/**
	 * @return int
	 */
	public function getPieceNumberFrom(): int
	{
		return $this->pieceNumberFrom;
	}

	/**
	 * @param int $pieceNumberFrom
	 * @return $this
	 */
	public function setPieceNumberFrom(int $pieceNumberFrom)
	{
		$this->pieceNumberFrom = $pieceNumberFrom;
		return $this;
	}

	/**
	 * @return int[]
	 */
	public function getPieceNumbers(): array
	{
		return $this->pieceNumbers;
	}

	/**
	 * @param int[] $pieceNumbers
	 * @return $this
	 */
	public function setPieceNumbers(array $pieceNumbers)
	{
		$this->pieceNumbers = $pieceNumbers;
		return $this;
	}

	/**
	 * @param int $pieceNumber
	 * @return $this
	 */
	public function addPieceNumber(int $pieceNumber)
	{
		$this->pieceNumbers[] = $pieceNumber;
		return $this;
	}


}
