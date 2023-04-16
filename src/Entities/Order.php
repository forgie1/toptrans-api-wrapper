<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper\Entities;

use ToptransApiWrapper\Constants\Currencies;
use ToptransApiWrapper\Constants\DeliveryNoteBackTypes;
use ToptransApiWrapper\Constants\DischargeComfortTypes;
use ToptransApiWrapper\Constants\FreightCacheTypes;
use ToptransApiWrapper\Constants\LoadingComfortTypes;
use ToptransApiWrapper\Constants\LoadingTypes;
use ToptransApiWrapper\Constants\Branches;
use ToptransApiWrapper\Constants\OrderTerms;
use ToptransApiWrapper\Constants\PayerTypes;
use ToptransApiWrapper\Constants\ReturnPackTypes;
use ToptransApiWrapper\Exceptions\InvalidArgumentException;
use ToptransApiWrapper\Exceptions\ToptransApiWrapperException;

class Order
{

	const TWO_WAY_SHIPMENT_DESCRIPTION_MAX_LENGTH = 50;

	/** @var int Termín. Viz číselník termínů */
	protected $termId;

	/** @var string|null OznaČení */
	protected $label;

	/** @var \DateTime|null */
	protected $loadingDate;

	/** @var string|null */
	protected $loadingTimeFrom;

	/** @var string|null */
	protected $loadingTimeTo;

	/** @var \DateTime|null */
	protected $dischargeDate;

	/** @var string|null */
	protected $dischargeTimeFrom;

	/** @var string|null */
	protected $dischargeTimeTo;

	/** @var int|null see constants above */
	protected $payerSelect;

	/** @var Partner|null pokud payer_select=3 -- Plátce přepravy*/
	protected $payer;

	/** @var int|null Výběr nakládky přepravy */
	protected $loadingSelect;

	/** @var Partner|null pokud loading_select=2 -- Nakládka */
	protected $loading;

	/** @var int|null pokud loading_select=3 -- ID střediska pro osobní podej. Viz číselník středisek */
	protected $loadingPersonalBranchId;

	/** @var int|null pokud term_id=5 -- ID střediska pro osobní odběr. Viz číselník středisek */
	protected $dischargePersonalBranchId;

	/** @var Partner Vykládka */
	protected $discharge;

	/** @var bool|null Obousměrná zásilka */
	protected $twowayShipment;

	/** @var string|null Popis obousměrné zásilky */
	protected $twoWayShipmentDescription;

	/** @var bool|null Sběrný dvůr */
	protected $yard;

	/** @var int|null */
	protected $deliveryNotesBack;

	/** @var bool|null DEFAULT true */
	protected $avisoSms;

	/** @var bool|null Telefonická avizace nakládky <-- DEFAULT false */
	protected $loadingAviso;

	/** @var bool|null Telefonická avizace vykládky <-- DEFAULT false */
	protected $dischargeAviso;

	/** @var int|null Služba Comfort na nakládce (viz číselník) <-- DEFAULT 1 */
	protected $loadingComfortId;

	/** @var int|null Počet pater na nakládce (pro některé varianty služby Comfort) */
	protected $loadingFloors;

	/** @var int|null Služba Comfort na nakládce (viz číselník) */
	protected $dischargeComfortId;

	/** @var int|null Počet pater na vykládce (pro některé varianty služby Comfort) */
	protected $dischargeFloors;

	/** @var int|null Služba vratný obal. Hodnoty viz číselník vratných obalů */
	protected $returnPackId;

	/** @var int|null pokud return_pack_id > 0	- počet vratných obalů */
	protected $returnPackCount;

	/** @var string|null  Popis vratného obalu max 255 znaku */
	protected $returnPackDescription;

	/** @var int|null  Služba přepravné v hotovnosti. Hodnoty viz číselník */
	protected $freightCashId;

	/** @var bool|null  Automaticky podle cash_on_delivery_price -- Služba dobírka */
	protected $cashOnDeliveryType;

	/** @var float|null  pokud cashon_delivery_type=true -- Výše dobírky */
	protected $cashOnDeliveryPrice; //	number(10,2)

	/** @var string|null  ID měmy (viz číselník) */
	protected $cashOnDeliveryPriceCurId;

	/** @var string|null Číslo účtu - předčíslí */
	protected $cashOnDeliveryAccount1;

	/** @var string|null Číslo účtu */
	protected $cashOnDeliveryAccount2;

	/** @var string|null Kód banky */
	protected $cashOnDeliveryBank;

	/** @var string|null IBAN */
	protected $cashOnDeliveryIban;

	/** @var string|null SWIFT */
	protected $cashOnDeliverySwift;

	/** @var string|null Variabilní symbol */
	protected $varSymbol;

	/** @var bool|null 	Nadrozměr */
	protected $oversize;

	/** @var bool|null 	Převážit */
	protected $consider;

	/** @var bool|null 	Křehké */
	protected $labelFragile;

	/** @var bool|null 	Nestohovat */
	protected $labelDontTilt;

	/** @var bool|null 	Neklopit */
	protected $labelThisSideUp;

	/** @var bool|null 	Hydraulické čelo na nakládce */
	protected $hydraulicFrontLoading;

	/** @var bool|null 	Hydraulické čelo na vykládce */
	protected $hydraulicFrontDischarge;

	/** @var int|null Počet euro palet */
	protected $numEpals;

	/** @var float Hmotnost zásilky */
	protected $kg;

	/** @var float|null Kubatura zásilky. Jsou-li vyplněny všechny rozměry (dimensions_d,s,v), spočítá se automaticky */
	protected $m3;

	/** @var string|null Poznámka na nakládce */
	protected $noteLoading;

	/** @var string|null Poznámka na vykládce */
	protected $noteDischarge;

	/** @var float|null Hodnota zásilky */
	protected $orderValue;

	/** @var int|null Hodnota zásilky - ID měny (viz číselník) */
	protected $orderValueCurrencyId;

	/** @var Pack[] Obsah zásilky - kusy */
	protected $packs;

	/** @var Adr[]|null Definice ADR - přeprava nebezpečných látek */
	protected $adrs;

	/**
	 * @return int
	 */
	public function getTermId(): int
	{
		return $this->termId;
	}

	/**
	 * @param int $termId
	 * @return $this
	 * @throws InvalidArgumentException
	 */
	public function setTermId(int $termId)
	{
		if (!array_key_exists($termId, OrderTerms::ALLOWED_TERMS)) {
			throw new InvalidArgumentException('Unknownt term type: ' . $termId);
		}

		$this->termId = $termId;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getLabel(): ?string
	{
		return $this->label;
	}

	/**
	 * @param string|null $label
	 * @return $this
	 */
	public function setLabel(?string $label)
	{
		$this->label = $label;
		return $this;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getLoadingDate(): ?string
	{
		return $this->loadingDate ? $this->loadingDate->format('Y-m-d') : null;
	}

	/**
	 * @param \DateTime|null $loadingDate
	 * @return $this
	 */
	public function setLoadingDate(?\DateTime $loadingDate)
	{
		$this->loadingDate = $loadingDate;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getLoadingTimeFrom(): ?string
	{
		return $this->loadingTimeFrom;
	}

	/**
	 * @param string|null $loadingTimeFrom
	 * @return $this
	 * @throws InvalidArgumentException
	 */
	public function setLoadingTimeFrom(?string $loadingTimeFrom)
	{
		$this->validateTime($loadingTimeFrom);
		$this->loadingTimeFrom = $loadingTimeFrom;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getLoadingTimeTo(): ?string
	{
		return $this->loadingTimeTo;
	}

	/**
	 * @param string|null $loadingTimeTo
	 * @return $this
	 * @throws InvalidArgumentException
	 */
	public function setLoadingTimeTo(?string $loadingTimeTo)
	{
		$this->validateTime($loadingTimeTo);
		$this->loadingTimeTo = $loadingTimeTo;
		return $this;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getDischargeDate(): ?string
	{
		return $this->dischargeDate ? $this->dischargeDate->format('Y-m-d') : null;
	}

	/**
	 * @param \DateTime|null $dischargeDate
	 * @return $this
	 */
	public function setDischargeDate(?\DateTime $dischargeDate)
	{
		$this->dischargeDate = $dischargeDate;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getDischargeTimeFrom(): ?string
	{
		return $this->dischargeTimeFrom;
	}

	/**
	 * @param string|null $dischargeTimeFrom
	 * @return $this
	 * @throws InvalidArgumentException
	 */
	public function setDischargeTimeFrom(?string $dischargeTimeFrom)
	{
		$this->validateTime($dischargeTimeFrom);
		$this->dischargeTimeFrom = $dischargeTimeFrom;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getDischargeTimeTo(): ?string
	{
		return $this->dischargeTimeTo;
	}

	/**
	 * @param string|null $dischargeTimeTo
	 * @return $this
	 * @throws InvalidArgumentException
	 */
	public function setDischargeTimeTo(?string $dischargeTimeTo)
	{
		$this->validateTime($this->dischargeTimeFrom);
		$this->dischargeTimeTo = $dischargeTimeTo;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getPayerSelect(): ?int
	{
		return $this->payerSelect;
	}

	/**
	 * @param int|null $payerSelect
	 * @return $this
	 * @throws InvalidArgumentException
	 */
	public function setPayerSelect(?int $payerSelect)
	{
		if ($payerSelect && !array_key_exists($payerSelect, PayerTypes::ALLOWED_PAYER_TYPES)) {
			throw new InvalidArgumentException('Unknown Payer select: ' . $payerSelect);
		}

		$this->payerSelect = $payerSelect;
		return $this;
	}

	/**
	 * @return Partner|null
	 */
	public function getPayer(): ?Partner
	{
		return $this->payer;
	}

	/**
	 * @param Partner|null $payer
	 * @return $this
	 */
	public function setPayer(?Partner $payer)
	{
		$this->payer = $payer;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getLoadingSelect(): ?int
	{
		return $this->loadingSelect;
	}

	/**
	 * @param int|null $loadingSelect
	 * @return $this
	 * @throws InvalidArgumentException
	 */
	public function setLoadingSelect(?int $loadingSelect)
	{
		if ($loadingSelect && !array_key_exists($loadingSelect, LoadingTypes::ALLOWED_LOADING_TYPES)) {
			throw new InvalidArgumentException('Unknown Loading Select ID' . $this->loadingSelect);
		}

		$this->loadingSelect = $loadingSelect;
		return $this;
	}

	/**
	 * @return Partner|null
	 */
	public function getLoading(): ?Partner
	{
		return $this->loading;
	}

	/**
	 * @param Partner|null $loading
	 * @return $this
	 */
	public function setLoading(?Partner $loading)
	{
		$this->loading = $loading;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getLoadingPersonalBranchId(): ?int
	{
		return $this->loadingPersonalBranchId;
	}

	/**
	 * @param int|null $loadingPersonalBranchId
	 * @return $this
	 * @throws InvalidArgumentException
	 */
	public function setLoadingPersonalBranchId(?int $loadingPersonalBranchId)
	{
		if ($loadingPersonalBranchId && !array_key_exists($loadingPersonalBranchId, Branches::ALLOWED_BRANCHES)) {
			throw new InvalidArgumentException('Unknown branch ID: ' . $loadingPersonalBranchId);
		}

		$this->loadingPersonalBranchId = $loadingPersonalBranchId;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getDischargePersonalBranchId(): ?int
	{
		return $this->dischargePersonalBranchId;
	}

	/**
	 * @param int|null $dischargePersonalBranchId
	 * @return $this
	 * @throws InvalidArgumentException
	 */
	public function setDischargePersonalBranchId(?int $dischargePersonalBranchId)
	{
		if ($dischargePersonalBranchId && !array_key_exists($dischargePersonalBranchId, Branches::ALLOWED_BRANCHES)) {
			throw new InvalidArgumentException('Unknown branch ID: ' . $dischargePersonalBranchId);
		}

		$this->dischargePersonalBranchId = $dischargePersonalBranchId;
		return $this;
	}

	/**
	 * @return Partner
	 */
	public function getDischarge(): Partner
	{
		return $this->discharge;
	}

	/**
	 * @param Partner $discharge
	 * @return $this
	 */
	public function setDischarge(Partner $discharge)
	{
		$this->discharge = $discharge;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getTwowayShipment(): int
	{
		return (int)$this->twowayShipment;
	}

	/**
	 * @param bool|null $twowayShipment
	 * @return $this
	 */
	public function setTwowayShipment(?bool $twowayShipment)
	{
		$this->twowayShipment = $twowayShipment;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getTwoWayShipmentDescription(): ?string
	{
		return $this->twoWayShipmentDescription;
	}

	/**
	 * @param string|null $twoWayShipmentDescription
	 * @return $this
	 * @throws InvalidArgumentException
	 */
	public function setTwoWayShipmentDescription(?string $twoWayShipmentDescription)
	{
		if ($twoWayShipmentDescription && mb_strlen($twoWayShipmentDescription, 'UTF-8') > self::TWO_WAY_SHIPMENT_DESCRIPTION_MAX_LENGTH) {
			throw new InvalidArgumentException('TwoWayShipmentDescription can be max ' . self::TWO_WAY_SHIPMENT_DESCRIPTION_MAX_LENGTH . ' characters long.');
		}

		$this->twoWayShipmentDescription = $twoWayShipmentDescription;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getYard(): int
	{
		return (int)$this->yard;
	}

	/**
	 * @param bool|null $yard
	 * @return $this
	 */
	public function setYard(?bool $yard)
	{
		$this->yard = $yard;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getDeliveryNotesBack(): ?int
	{
		return $this->deliveryNotesBack;
	}

	/**
	 * @param int|null $deliveryNotesBack
	 * @return $this
	 * @throws InvalidArgumentException
	 */
	public function setDeliveryNotesBack(?int $deliveryNotesBack)
	{
		if ($deliveryNotesBack && !array_key_exists($deliveryNotesBack, DeliveryNoteBackTypes::ALLOWED_DELIVERY_NOTE_BACK_TYPES)) {
			throw new InvalidArgumentException('Unknown Delivery notes back: ' . $deliveryNotesBack);
		}

		$this->deliveryNotesBack = $deliveryNotesBack;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getAvisoSms(): int
	{
		return (int)$this->avisoSms;
	}

	/**
	 * @param bool|null $avisoSms
	 * @return $this
	 */
	public function setAvisoSms(?bool $avisoSms)
	{
		$this->avisoSms = $avisoSms;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getLoadingAviso(): int
	{
		return (int)$this->loadingAviso;
	}

	/**
	 * @param bool|null $loadingAviso
	 * @return $this
	 */
	public function setLoadingAviso(?bool $loadingAviso)
	{
		$this->loadingAviso = $loadingAviso;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getDischargeAviso(): int
	{
		return (int)$this->dischargeAviso;
	}

	/**
	 * @param bool|null $dischargeAviso
	 * @return $this
	 */
	public function setDischargeAviso(?bool $dischargeAviso)
	{
		$this->dischargeAviso = $dischargeAviso;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getLoadingComfortId(): ?int
	{
		return $this->loadingComfortId;
	}

	/**
	 * @param int|null $loadingComfortId
	 * @return $this
	 * @throws InvalidArgumentException
	 */
	public function setLoadingComfortId(?int $loadingComfortId)
	{
		if ($loadingComfortId && !array_key_exists($loadingComfortId, LoadingComfortTypes::ALLOWED_LOADING_COMFORT_TYPES)) {
			throw new InvalidArgumentException('Unknown freight cache ID: ' . $loadingComfortId);
		}

		$this->loadingComfortId = $loadingComfortId;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getLoadingFloors(): ?int
	{
		return $this->loadingFloors;
	}

	/**
	 * @param int|null $loadingFloors
	 * @return $this
	 */
	public function setLoadingFloors(?int $loadingFloors)
	{
		$this->loadingFloors = $loadingFloors;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getDischargeComfortId(): ?int
	{
		return $this->dischargeComfortId;
	}

	/**
	 * @param int|null $dischargeComfortId
	 * @return $this
	 * @throws InvalidArgumentException
	 */
	public function setDischargeComfortId(?int $dischargeComfortId)
	{
		if ($dischargeComfortId && !array_key_exists($dischargeComfortId, DischargeComfortTypes::ALLOWED_DISCHARGE_COMFORT_TYPES)) {
			throw new InvalidArgumentException('Unknown freight cache ID: ' . $dischargeComfortId);
		}


		$this->dischargeComfortId = $dischargeComfortId;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getDischargeFloors(): ?int
	{
		return $this->dischargeFloors;
	}

	/**
	 * @param int|null $dischargeFloors
	 * @return $this
	 */
	public function setDischargeFloors(?int $dischargeFloors)
	{
		$this->dischargeFloors = $dischargeFloors;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getReturnPackId(): ?int
	{
		return $this->returnPackId;
	}

	/**
	 * @param int|null $returnPackId
	 * @return $this
	 * @throws InvalidArgumentException
	 */
	public function setReturnPackId(?int $returnPackId)
	{
		if ($returnPackId && !array_key_exists($returnPackId, ReturnPackTypes::ALLOWED_RETURN_PACK_TYPES)) {
			throw new InvalidArgumentException('Unknown return pack ID: ' . $returnPackId);
		}

		$this->returnPackId = $returnPackId;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getReturnPackCount(): ?int
	{
		return $this->returnPackCount;
	}

	/**
	 * @param int|null $returnPackCount
	 * @return $this
	 */
	public function setReturnPackCount(?int $returnPackCount)
	{
		$this->returnPackCount = $returnPackCount;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getReturnPackDescription(): ?string
	{
		return $this->returnPackDescription;
	}

	/**
	 * @param string|null $returnPackDescription
	 * @return $this
	 */
	public function setReturnPackDescription(?string $returnPackDescription)
	{
		$this->returnPackDescription = $returnPackDescription;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getFreightCashId(): ?int
	{
		return $this->freightCashId;
	}

	/**
	 * @param int|null $freightCashId
	 * @return $this
	 * @throws InvalidArgumentException
	 */
	public function setFreightCashId(?int $freightCashId)
	{
		if ($freightCashId && !array_key_exists($freightCashId, FreightCacheTypes::ALLOWED_FREIGHT_CACHE_TYPES)) {
			throw new InvalidArgumentException('Unknown freight cache ID: ' . $freightCashId);
		}

		$this->freightCashId = $freightCashId;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getCashOnDeliveryType(): int
	{
		return (int)$this->cashOnDeliveryType;
	}

	/**
	 * @param bool $cashOnDeliveryType
	 * @return $this
	 */
	public function setCashOnDeliveryType(bool $cashOnDeliveryType)
	{
		$this->cashOnDeliveryType = $cashOnDeliveryType;
		return $this;
	}

	/**
	 * @return float|null
	 */
	public function getCashOnDeliveryPrice(): ?float
	{
		return $this->cashOnDeliveryPrice ? round($this->cashOnDeliveryPrice, 2) : null;
	}

	/**
	 * @param float|null $cashOnDeliveryPrice
	 * @return $this
	 */
	public function setCashOnDeliveryPrice(?float $cashOnDeliveryPrice)
	{
		$this->setCashOnDeliveryType(!!$cashOnDeliveryPrice);
		$this->cashOnDeliveryPrice = $cashOnDeliveryPrice;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getCashOnDeliveryPriceCurId(): ?string
	{
		return $this->cashOnDeliveryPriceCurId;
	}

	/**
	 * @param string|null $cashOnDeliveryPriceCurId
	 * @return $this
	 */
	public function setCashOnDeliveryPriceCurId(?string $cashOnDeliveryPriceCurId)
	{
		$this->cashOnDeliveryPriceCurId = $cashOnDeliveryPriceCurId;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getCashOnDeliveryAccount1(): ?string
	{
		return $this->cashOnDeliveryAccount1;
	}

	/**
	 * @param string|null $cashOnDeliveryAccount1
	 * @return $this
	 */
	public function setCashOnDeliveryAccount1(?string $cashOnDeliveryAccount1)
	{
		$this->cashOnDeliveryAccount1 = $cashOnDeliveryAccount1;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getCashOnDeliveryAccount2(): ?string
	{
		return $this->cashOnDeliveryAccount2;
	}

	/**
	 * @param string|null $cashOnDeliveryAccount2
	 * @return $this
	 */
	public function setCashOnDeliveryAccount2(?string $cashOnDeliveryAccount2)
	{
		$this->cashOnDeliveryAccount2 = $cashOnDeliveryAccount2;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getCashOnDeliveryBank(): ?string
	{
		return $this->cashOnDeliveryBank;
	}

	/**
	 * @param string|null $cashOnDeliveryBank
	 * @return $this
	 */
	public function setCashOnDeliveryBank(?string $cashOnDeliveryBank)
	{
		$this->cashOnDeliveryBank = $cashOnDeliveryBank;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getCashOnDeliveryIban(): ?string
	{
		return $this->cashOnDeliveryIban;
	}

	/**
	 * @param string|null $cashOnDeliveryIban
	 * @return $this
	 */
	public function setCashOnDeliveryIban(?string $cashOnDeliveryIban)
	{
		$this->cashOnDeliveryIban = $cashOnDeliveryIban;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getCashOnDeliverySwift(): ?string
	{
		return $this->cashOnDeliverySwift;
	}

	/**
	 * @param string|null $cashOnDeliverySwift
	 * @return $this
	 */
	public function setCashOnDeliverySwift(?string $cashOnDeliverySwift)
	{
		$this->cashOnDeliverySwift = $cashOnDeliverySwift;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getVarSymbol(): ?string
	{
		return $this->varSymbol;
	}

	/**
	 * @param string|null $varSymbol
	 * @return $this
	 */
	public function setVarSymbol(?string $varSymbol)
	{
		$this->varSymbol = $varSymbol;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getOversize(): int
	{
		return (int)$this->oversize;
	}

	/**
	 * @param bool|null $oversize
	 * @return $this
	 */
	public function setOversize(?bool $oversize)
	{
		$this->oversize = $oversize;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getConsider(): int
	{
		return (int)$this->consider;
	}

	/**
	 * @param bool|null $consider
	 * @return $this
	 */
	public function setConsider(?bool $consider)
	{
		$this->consider = $consider;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getLabelFragile(): int
	{
		return (int)$this->labelFragile;
	}

	/**
	 * @param bool|null $labelFragile
	 * @return $this
	 */
	public function setLabelFragile(?bool $labelFragile)
	{
		$this->labelFragile = $labelFragile;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getLabelDontTilt(): int
	{
		return (int)$this->labelDontTilt;
	}

	/**
	 * @param bool|null $labelDontTilt
	 * @return $this
	 */
	public function setLabelDontTilt(?bool $labelDontTilt)
	{
		$this->labelDontTilt = $labelDontTilt;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getLabelThisSideUp(): int
	{
		return (int)$this->labelThisSideUp;
	}

	/**
	 * @param bool|null $labelThisSideUp
	 * @return $this
	 */
	public function setLabelThisSideUp(?bool $labelThisSideUp)
	{
		$this->labelThisSideUp = $labelThisSideUp;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getHydraulicFrontLoading(): int
	{
		return (int)$this->hydraulicFrontLoading;
	}

	/**
	 * @param bool|null $hydraulicFrontLoading
	 * @return $this
	 */
	public function setHydraulicFrontLoading(?bool $hydraulicFrontLoading)
	{
		$this->hydraulicFrontLoading = $hydraulicFrontLoading;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getHydraulicFrontDischarge(): int
	{
		return (int)$this->hydraulicFrontDischarge;
	}

	/**
	 * @param bool|null $hydraulicFrontDischarge
	 * @return $this
	 */
	public function setHydraulicFrontDischarge(?bool $hydraulicFrontDischarge)
	{
		$this->hydraulicFrontDischarge = $hydraulicFrontDischarge;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getNumEpals(): ?int
	{
		return $this->numEpals;
	}

	/**
	 * @param int|null $numEpals
	 * @return $this
	 */
	public function setNumEpals(?int $numEpals)
	{
		$this->numEpals = $numEpals;
		return $this;
	}

	/**
	 * @return float
	 */
	public function getKg(): float
	{
		return round($this->kg, 2);
	}

	/**
	 * @param float $kg
	 * @return $this
	 */
	public function setKg(float $kg)
	{
		$this->kg = $kg;
		return $this;
	}

	/**
	 * @return float|null
	 */
	public function getM3(): ?float
	{
		return isset($this->m3) ? round($this->m3, 2) : $this->calculateM3();
	}

	/**
	 * @param float|null $m3
	 * @return $this
	 */
	public function setM3(?float $m3)
	{
		$this->m3 = $m3;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getNoteLoading(): ?string
	{
		return $this->noteLoading;
	}

	/**
	 * @param string|null $noteLoading
	 * @return $this
	 */
	public function setNoteLoading(?string $noteLoading)
	{
		$this->noteLoading = $noteLoading;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getNoteDischarge(): ?string
	{
		return $this->noteDischarge;
	}

	/**
	 * @param string|null $noteDischarge
	 * @return $this
	 */
	public function setNoteDischarge(?string $noteDischarge)
	{
		$this->noteDischarge = $noteDischarge;
		return $this;
	}

	/**
	 * @return float|null
	 */
	public function getOrderValue(): ?float
	{
		return $this->orderValue ? round($this->orderValue, 1) : null;
	}

	/**
	 * @param float|null $orderValue
	 * @return $this
	 */
	public function setOrderValue(?float $orderValue)
	{
		$this->orderValue = $orderValue;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getOrderValueCurrencyId(): ?int
	{
		return $this->orderValueCurrencyId;
	}

	/**
	 * @param int|null $orderValueCurrencyId
	 * @return $this
	 * @throws InvalidArgumentException
	 */
	public function setOrderValueCurrencyId(?int $orderValueCurrencyId)
	{
		if ($orderValueCurrencyId && !array_key_exists($orderValueCurrencyId, Currencies::ALLOWED_CURRENCIES)) {
			throw new InvalidArgumentException('Not allowed currency');
		}

		$this->orderValueCurrencyId = $orderValueCurrencyId;
		return $this;
	}

	/**
	 * @param bool $noErrorOnNoPacks
	 * @return Pack[]
	 * @throws ToptransApiWrapperException
	 */
	public function getPacks(bool $noErrorOnNoPacks = false): array
	{
		if ($noErrorOnNoPacks || $this->packs) {
			return $this->packs ?: [];
		} else {
			throw new ToptransApiWrapperException('There are no packs');
		}
	}

	/**
	 * @param Pack[] $packs
	 * @return $this
	 */
	public function setPacks(array $packs)
	{
		$this->packs = $packs;
		return $this;
	}

	/**
	 * @param Pack $pack
	 * @return $this
	 */
	public function addPack(Pack $pack)
	{
		$this->packs[] = $pack;
		return $this;
	}

	/**
	 * @return Adr[]|null
	 */
	public function getAdrs(): ?array
	{
		return $this->adrs;
	}

	/**
	 * @param Adr[]|null $adrs
	 * @return $this
	 */
	public function setAdrs($adrs)
	{
		$this->adrs = $adrs;
		return $this;
	}

	/**
	 * @param Adr $adr
	 * @return $this
	 */
	public function addAdr(Adr $adr)
	{
		$this->adrs[] = $adr;
		return $this;
	}

	private function validateTime(?string $time)
	{
		if ($time && !preg_match('~^\d\d\:\d\d$~', $time)) {
			throw new InvalidArgumentException('Time must by in the format hh:mm');
		}
	}

	// ******* calculations

	private function calculateM3(): ?float
	{
		$m3 = 0.0;
		foreach ($this->packs as $pack) {
			$m3 += $pack->getDimensionsS() * $pack->getDimensionsV() * $pack->getDimensionsD() / 1000000;
		}

		return $m3 ?: null;
	}

}
