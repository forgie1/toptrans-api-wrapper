<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper\Entities;

use ToptransApiWrapper\Constants\Currencies;

class OrderResponse extends Order
{

	/** @var int */
	protected $id;

	/** @var string */
	protected $orderNumber;

	/** @var string */
	protected $source;

	/** @var bool */
	protected $labelsPrinted;

	/** @var int */
	protected $quantitySum;

	/** @var int|null */
	protected $pieceNumberFrom;

	/** @var int[] */
	protected $pieceNumbers;

	/** @var float */
	protected $deliveryPrice;

	/** @var string */
	protected $deliveryCurrency;

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 * @return OrderResponse
	 */
	public function setId(int $id): OrderResponse
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getOrderNumber(): string
	{
		return $this->orderNumber;
	}

	/**
	 * @param string $orderNumber
	 * @return OrderResponse
	 */
	public function setOrderNumber(string $orderNumber): OrderResponse
	{
		$this->orderNumber = $orderNumber;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getSource(): string
	{
		return $this->source;
	}

	/**
	 * @param string $source
	 * @return OrderResponse
	 */
	public function setSource(string $source): OrderResponse
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
	 * @return OrderResponse
	 */
	public function setLabelsPrinted(bool $labelsPrinted): OrderResponse
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
	 * @return OrderResponse
	 */
	public function setQuantitySum(int $quantitySum): OrderResponse
	{
		$this->quantitySum = $quantitySum;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getPieceNumberFrom(): ?int
	{
		return $this->pieceNumberFrom;
	}

	/**
	 * @param int|null $pieceNumberFrom
	 * @return OrderResponse
	 */
	public function setPieceNumberFrom(?int $pieceNumberFrom): OrderResponse
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
	 * @return OrderResponse
	 */
	public function setPieceNumbers(array $pieceNumbers): OrderResponse
	{
		$this->pieceNumbers = $pieceNumbers;
		return $this;
	}

	/**
	 * @return float
	 */
	public function getDeliveryPrice(): float
	{
		return $this->deliveryPrice;
	}

	/**
	 * @param float $deliveryPrice
	 * @return OrderResponse
	 */
	public function setDeliveryPrice(float $deliveryPrice): OrderResponse
	{
		$this->deliveryPrice = $deliveryPrice;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getDeliveryCurrency(): string
	{
		return $this->deliveryCurrency;
	}

	/**
	 * @param int $deliveryCurrency
	 * @return OrderResponse
	 */
	public function setDeliveryCurrency(int $deliveryCurrency): OrderResponse
	{
		$this->deliveryCurrency = Currencies::ALLOWED_CURRENCIES[$deliveryCurrency];
		return $this;
	}

}
