<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper\Entities;

class OrderResponse extends Order
{

	const SOURCE_FORM = 1;
	const SOURCE_IMPORT = 2;
	const SOURCE_API = 3;

	/** @var int Číslo objednávky (nebo také číslo přepravního listu) */
	private $orderNumber;

	/** @var int see constants above */
	private $source;

	/** @var bool Příznak, že byly vytištěny štítky (a jsou tím pádem s jistotou vygenerovaná čísla kusů) */
	private $labelsPrinted;

	/** @var int Celkový počet kusů v objednávkce. */
	private $quantitySum;

	/** @var int První číslo kusu. Objednávky má spojité číslování kusů */
	private $pieceNumberFrom;

	/** @var int[] Jednotlivá čísla kusů objednávky */
	private $pieceNumbers;

	/** @var array Vytvořená objednávka má další atributy generované systémem */
	private $otherParameters;

	/**
	 * @return int
	 */
	public function getOrderNumber(): int
	{
		return $this->orderNumber;
	}

	/**
	 * @param int $orderNumber
	 * @return $this
	 */
	public function setOrderNumber(int $orderNumber)
	{
		$this->orderNumber = $orderNumber;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getSource(): int
	{
		return $this->source;
	}

	/**
	 * @param int $source
	 * @return $this
	 */
	public function setSource(int $source)
	{
		$this->source = $source;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function isLabelsPrinted(): bool
	{
		return $this->labelsPrinted;
	}

	/**
	 * @param bool $labelsPrinted
	 * @return $this
	 */
	public function setLabelsPrinted(bool $labelsPrinted)
	{
		$this->labelsPrinted = $labelsPrinted;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getQuantitySum(): int
	{
		return $this->quantitySum;
	}

	/**
	 * @param int $quantitySum
	 * @return $this
	 */
	public function setQuantitySum(int $quantitySum)
	{
		$this->quantitySum = $quantitySum;
		return $this;
	}

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
	 * @return array
	 */
	public function getOtherParameters(): array
	{
		return $this->otherParameters;
	}

	/**
	 * @param array $otherParameters
	 * @return $this
	 */
	public function setOtherParameters($otherParameters)
	{
		$this->otherParameters = $otherParameters;
		return $this;
	}

	public function addParameter($key, $value)
	{
		$this->otherParameters[$key] = $value;
	}

}
