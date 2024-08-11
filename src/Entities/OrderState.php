<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2024 Ján Forgáč <forgac@artfocus.cz>
 */

declare(strict_types=1);

namespace ToptransApiWrapper\Entities;

class OrderState implements TTEntity
{

	public ?string $orderNumber; // request (optional) + response: 17765017006

	public ?string $loadingDate; // only response: "03.10.2017"

	public ?string $itemFrom; // only response: null

	public ?string $itemTo; // only response: 6502033714

	public ?string $label; // request (optional) + response: "11063"

	public ?string $deliveryBranch; // only response: "450 Mladá Boleslav telefonní číslo +420 326 727 335"

	public ?string $deliveryDriver; // only response: "Petr Blahovec (420)731073110"

	public ?string $deliveryDate; // only response: null

	public ?string $status; // only response: "Na rozvozu"

	public ?string $item;	// --- only request (optional)

	public function __construct(null|string|int $orderNumber = null, ?string $loadingDate = null, null|int|string $itemFrom = null, null|int|string $itemTo = null, null|int|string $label = null, ?string $deliveryBranch = null, ?string $deliveryDriver = null, ?string $deliveryDate = null, ?string $status = null, ?string $item = null)
	{
		$this->orderNumber = $orderNumber ? (string)$orderNumber : null;
		$this->loadingDate = $loadingDate;
		$this->itemFrom = $itemFrom ? (string)$itemFrom : null;
		$this->itemTo = $itemTo ? (string)$itemTo : null;
		$this->label = $label ? (string)$label : null;
		$this->deliveryBranch = $deliveryBranch;
		$this->deliveryDriver = $deliveryDriver;
		$this->deliveryDate = $deliveryDate;
		$this->status = $status;
		$this->item = $item;
	}

	public function toArray(): array
	{
		$array = [];
		foreach (get_class_methods($this) as $methodName) {
			if (str_starts_with($methodName, 'get')) {
				$value = $this->$methodName();
				if ($value) {
					$array[lcfirst(substr($methodName, 3))] = $value;
				}
			}
		}
		return $array;
	}

	public function getOrderNumber(): ?string
	{
		return $this->orderNumber;
	}

	public function getLoadingDate(): ?string
	{
		return $this->loadingDate;
	}

	public function getItemFrom(): ?string
	{
		return $this->itemFrom;
	}

	public function getItemTo(): ?string
	{
		return $this->itemTo;
	}

	public function getLabel(): ?string
	{
		return $this->label;
	}

	public function getDeliveryBranch(): ?string
	{
		return $this->deliveryBranch;
	}

	public function getDeliveryDriver(): ?string
	{
		return $this->deliveryDriver;
	}

	public function getDeliveryDate(): ?string
	{
		return $this->deliveryDate;
	}

	public function getStatus(): ?string
	{
		return $this->status;
	}

	public function getItem(): ?string
	{
		return $this->item;
	}

}
