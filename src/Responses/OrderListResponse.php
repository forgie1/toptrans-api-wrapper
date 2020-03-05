<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper\Responses;

use ToptransApiWrapper\Entities\OrderResponse;

class OrderListResponse extends ToptransResponse
{

	/** @var OrderResponse[] */
	private $orders = [];

	public function getOrderById(int $id): ?OrderResponse
	{
		return $this->orders[$id] ?? null;
	}

	protected function parseRawData($data)
	{
		foreach ($data as $item) {
			$order = new OrderResponse();
			$order
				->setId($item['id'])
				->setOrderNumber($item['order_number'])
				->setSource($item['source'])
				->setLabelsPrinted($item['labels_printed'])
				->setQuantitySum($item['quantity_sum'])
				->setPieceNumberFrom($item['piece_number_from'])
				->setPieceNumbers($item['piece_numbers'] ?? [])
				->setDeliveryPrice($item['price'])
				->setDeliveryCurrency($item['currency_id'])
				->setLabel($item['label']);

			// todo: fill the rest of the values this is onlu minor part returned by API

			$this->orders[$order->getId()] = $order;
		}
	}

}
