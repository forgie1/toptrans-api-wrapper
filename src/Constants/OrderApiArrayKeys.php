<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper\Constants;

class OrderApiArrayKeys
{

	const ALL_API_KEYS = [
			'term_id',
			'label',
			'loading_date',
			'loading_time_from',
			'loading_time_to',
			'discharge_date',
			'discharge_time_from',
			'discharge_time_to',
			'payer_select',
			'loading_select',
			'loading_personal_branch_id',
			'discharge_personal_branch_id',
			'payer.name',
			'payer.registration_code',
			'payer.vat_code',
			'payer.first_name',
			'payer.last_name',
			'payer.phone',
			'payer.email',
			'payer.address.city',
			'payer.address.city_part',
			'payer.address.street',
			'payer.address.house_num',
			'payer.address.zip',
			'loading.name',
			'loading.registration_code',
			'loading.vat_code',
			'loading.first_name',
			'loading.last_name',
			'loading.phone',
			'loading.email',
			'loading.address.city',
			'loading.address.city_part',
			'loading.address.street',
			'loading.address.house_num',
			'loading.address.zip',
			'discharge.name',
			'discharge.registration_code',
			'discharge.vat_code',
			'discharge.first_name',
			'discharge.last_name',
			'discharge.phone',
			'discharge.email',
			'discharge.address.city',
			'discharge.address.city_part',
			'discharge.address.street',
			'discharge.address.house_num',
			'discharge.address.zip',
			'twoway_shipment',
			'twoway_shipment_description',
			'yard',
			'delivery_notes_back',
			'aviso_sms',
			'loading_aviso',
			'discharge_aviso',
			'loading_comfort_id',
			'loading_floors',
			'discharge_comfort_id',
			'discharge_floors',
			'return_pack_id',
			'return_pack_count',
			'return_pack_description',
			'freight_cash_id',
			'cash_on_delivery_type',
			'cash_on_delivery_price',
			'cash_on_delivery_price_cur_id',
			'cash_on_delivery_account1',
			'cash_on_delivery_account2',
			'cash_on_delivery_bank',
			'cash_on_delivery_iban',
			'cash_on_delivery_swift',
			'var_symbol',
			'oversize',
			'consider',
			'label_fragile',
			'label_dont_tilt',
			'label_this_side_up',
			'hydraulic_front_loading',
			'hydraulic_front_discharge',
			'num_epals',
			'kg',
			'm3',
			'note_loading',
			'note_discharge',
			'order_value',
			'order_value_currency_id',
			'packs',
			'adrs',
		];

}
