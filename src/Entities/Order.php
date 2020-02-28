<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper\Entities;

use ToptransApiWrapper\Constants\Branches;
use ToptransApiWrapper\Constants\OrderTerms;
use ToptransApiWrapper\Exceptions\InvalidArgumentException;

class Order
{

	const PAYER_SENDER = '1'; //plátce=příkazce <-- DEFAULT
	const PAYER_RECEIVER = '2'; //plátce=příjemce
	const PAYER_ON_PICKUP = '4'; //platba při nakládce,
	const PAYER_OTHER = '3'; //jiný plátce popis

	const LOADING_SELECT_PREDEFINED_SENDER = 1; //1: adresa objednavatele <-- DEFAULT
	const LOADING_SELECT_OTHER_ADDRESS = 2; //jiná adresa
	const LOADING_SELECT_PERSONAL = 3; //osobní podej

	const TWO_WAY_SHIPMENT_DESCRIPTION_MAX_LENGTH = 50;

	const DELIVERY_NOTE_BACK_NO = 0; // <-- DEFAULT
	const DELIVERY_NOTE_BACK_ELECTRONIC = 1; //Elektronicky
	const DELIVERY_NOTE_BACK_PAPER =2; //Fyzicky
	const DELIVERY_NOTE_BACK_BOTH =2; //Fyzicky + Elektronicky

	const LOADING_COMFORT = 1; //Comfort nakládka - Ne <-- DEFAULT
	const LOADING_TOP_COMFORT = 2; //Top Comfort
	const LOADING_TOP_COMFORT_PLUS_2 = 3; //bílá technika;
	const LOADING_TOP_COMFORT_PLUS_PLUS = 4; //bílá technika - mimo depo
	const LOADING_TOP_COMFORT_PLUS = 5; //Top comfort Plus
	const LOADING_COMFORT_EXCLUSIVE = 6; //Comfort Exclusive

	const DISCHARGE_COMFORT = 1; //Comfort nakládka - Ne <-- DEFAULT
	const DISCHARGE_TOP_COMFORT = 2; //Top Comfort
	const DISCHARGE_TOP_COMFORT_PLUS = 5; //Top comfort Plus
	const DISCHARGE_COMFORT_EXCLUSIVE = 6; //Comfort Exclusive

	const RETURN_PACK_NO = 0;
	const RETURN_PACK_NORMAL = 1;
	const RETURN_PACK_BIG = 2;

	const FREIGHT_CACHE_NO = 1;
	const FREIGHT_CACHE_DISCHARGE = 2; // Na vykládce
	const FREIGHT_CACHE_LOADING = 3; // Při nakládce

	const CURRENCY_CZK = '1';
	const CURRENCY_EUR = '2';

	/** @var int Termín. Viz číselník termínů */
	private $termId;

	/** @var string|null OznaČení */
	private $label;

	/** @var \DateTimeImmutable|null */
	private $loadingDate;

	/** @var string|null */
	private $loadingTimeFrom;

	/** @var string|null */
	private $loadingTimeTo;

	/** @var \DateTimeImmutable|null */
	private $dischargeDate;

	/** @var string|null */
	private $dischargeTimeFrom;

	/** @var string|null */
	private $dischargeTimeTo;

	/** @var int|null see constants above */
	private $payerSelect;

	/** @var Partner|null pokud payer_select=3 -- Plátce přepravy*/
	private $payer;

	/** @var int|null Výběr nakládky přepravy */
	private $loadingSelect;

	/** @var Partner|null pokud loading_select=2 -- Nakládka */
	private $loading;

	/** @var int|null pokud loading_select=3 -- ID střediska pro osobní podej. Viz číselník středisek */
	private $loadingPersonalBranchId;

	/** @var int|null pokud term_id=5 -- ID střediska pro osobní odběr. Viz číselník středisek */
	private $dischargePersonalBranchId;

	/** @var Partner Vykládka */
	private $discharge;

	/** @var bool|null Obousměrná zásilka */
	private $twowayShipment;

	/** @var string|null Popis obousměrné zásilky */
	private $twoWayShipmentDescription;

	/** @var bool|null Sběrný dvůr */
	private $yard;

	/** @var int|null */
	private $deliveryNotesBack;

	/** @var bool|null DEFAULT true */
	private $smsAviso;

	/** @var bool|null Telefonická avizace nakládky <-- DEFAULT false */
	private $loadingAviso;

	/** @var bool|null Telefonická avizace vykládky <-- default false */
	private $dischargeAviso;

	/** @var int|null Služba Comfort na nakládce (viz číselník) <-- default 1 */
	private $loadingComfortId;

	/** @var int|null Počet pater na nakládce (pro některé varianty služby Comfort) */
	private $loadingFloors;

	/** @var int|null Služba Comfort na nakládce (viz číselník) */
	private $dischargeComfortId;

	/** @var int|null Počet pater na vykládce (pro některé varianty služby Comfort) */
	private $dischargeFloors;

	/** @var int|null Služba vratný obal. Hodnoty viz číselník vratných obalů */
	private $returnPackId;

	/** @var int|null pokud return_pack_id > 0	- počet vratných obalů */
	private $returnPackCount;

	/** @var string|null  Popis vratného obalu max 255 znaku */
	private $returnPackDescription;

	/** @var int|null  Služba přepravné v hotovnosti. Hodnoty viz číselník */
	private $freightCashId;

	/** @var bool|null  Automaticky podle cash_on_delivery_price -- Služba dobírka */
	private $cashOnDeliveryType;

	/** @var float|null  pokud cashon_delivery_type=true -- Výše dobírky */
	private $cashOnDeliveryPrice; //	number(10,2)

	/** @var string|null  ID měmy (viz číselník) */
	private $cashOnDeliveryPriceCurId;

	/** @var string|null Číslo účtu - předčíslí */
	private $cashOnDeliveryAccount1;

	/** @var string|null Číslo účtu */
	private $cashOnDeliveryAccount2;

	/** @var string|null Kód banky */
	private $cashOnDeliveryBank;

	/** @var string|null IBAN */
	private $cashOnDeliveryIban;

	/** @var string|null SWIFT */
	private $cashOnDeliverySwift;

	/** @var string|null Variabilní symbol */
	private $varSym;

	/** @var bool|null 	Nadrozměr */
	private $oversize;

	/** @var bool|null 	Převážit */
	private $consider;

	/** @var bool|null 	Křehké */
	private $labelFragile;

	/** @var bool|null 	Nestohovat */
	private $labelDontTilt;

	/** @var bool|null 	Neklopit */
	private $labelThisSideUp;

	/** @var bool|null 	Hydraulické čelo na nakládce */
	private $hydraulicFrontLoading;

	/** @var bool|null 	Hydraulické čelo na vykládce */
	private $hydraulicFrontDischarge;

	/** @var int|null Počet euro palet */
	private $numEpals;

	/** @var float Hmotnost zásilky */
	private $kg;

	/** @var float|null Kubatura zásilky. Jsou-li vyplněny všechny rozměry (dimensions_d,s,v), spočítá se automaticky */
	private $m3;

	/** @var string|null Poznámka na nakládce */
	private $noteLoading;

	/** @var string|null Poznámka na vykládce */
	private $noteDischarge;

	/** @var float|null Hodnota zásilky */
	private $orderValue;

	/** @var float|null Hodnota zásilky - ID měny (viz číselník) */
	private $orderValueCurrencyId;

	/** @var Pack[] Obsah zásilky - kusy */
	private $packs;

	/** @var Adr[]|null Definice ADR - přeprava nebezpečných látek */
	private $adrs;

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
	 * @return \DateTimeImmutable|null
	 */
	public function getLoadingDate(): ?\DateTimeImmutable
	{
		return $this->loadingDate;
	}

	/**
	 * @param \DateTimeImmutable|null $loadingDate
	 * @return $this
	 */
	public function setLoadingDate(?\DateTimeImmutable $loadingDate)
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
	 * @return \DateTimeImmutable|null
	 */
	public function getDischargeDate(): ?\DateTimeImmutable
	{
		return $this->dischargeDate;
	}

	/**
	 * @param \DateTimeImmutable|null $dischargeDate
	 * @return $this
	 */
	public function setDischargeDate(?\DateTimeImmutable $dischargeDate)
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
		if ($payerSelect && !in_array($payerSelect, [self::PAYER_SENDER, self::PAYER_RECEIVER, self::PAYER_OTHER, self::PAYER_ON_PICKUP])) {
			throw new InvalidArgumentException('Unknown PAyer select: ' . $payerSelect);
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
		if ($loadingSelect && !in_array(self::LOADING_SELECT_PREDEFINED_SENDER, self::LOADING_SELECT_OTHER_ADDRESS, self::LOADING_SELECT_PERSONAL)) {
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
	 * @return bool|null
	 */
	public function getTwowayShipment(): ?bool
	{
		return $this->twowayShipment;
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
		if (strlen($twoWayShipmentDescription) > self::TWO_WAY_SHIPMENT_DESCRIPTION_MAX_LENGTH) {
			throw new InvalidArgumentException('Description is too long');
		}

		$this->twoWayShipmentDescription = $twoWayShipmentDescription;
		return $this;
	}

	/**
	 * @return bool|null
	 */
	public function getYard(): ?bool
	{
		return $this->yard;
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
		if ($deliveryNotesBack && !in_array($deliveryNotesBack, [
			self::DELIVERY_NOTE_BACK_NO,
			self::DELIVERY_NOTE_BACK_PAPER,
			self::DELIVERY_NOTE_BACK_ELECTRONIC,
			self::DELIVERY_NOTE_BACK_BOTH,
			])) {
			throw new InvalidArgumentException('Unknown Delivery notes back: ' . $deliveryNotesBack);
		}

		$this->deliveryNotesBack = $deliveryNotesBack;
		return $this;
	}

	/**
	 * @return bool|null
	 */
	public function getSmsAviso(): ?bool
	{
		return $this->smsAviso;
	}

	/**
	 * @param bool|null $smsAviso
	 * @return $this
	 */
	public function setSmsAviso(?bool $smsAviso)
	{
		$this->smsAviso = $smsAviso;
		return $this;
	}

	/**
	 * @return bool|null
	 */
	public function getLoadingAviso(): ?bool
	{
		return $this->loadingAviso;
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
	 * @return bool|null
	 */
	public function getDischargeAviso(): ?bool
	{
		return $this->dischargeAviso;
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
		if ($loadingComfortId && !in_array($loadingComfortId, [
				self::LOADING_COMFORT,
				self::LOADING_TOP_COMFORT,
				self::LOADING_TOP_COMFORT_PLUS,
				self::LOADING_TOP_COMFORT_PLUS_2,
				self::LOADING_TOP_COMFORT_PLUS_PLUS,
				self::LOADING_COMFORT_EXCLUSIVE
			])) {
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
		if ($dischargeComfortId && !in_array($dischargeComfortId, [
				self::DISCHARGE_COMFORT,
				self::DISCHARGE_TOP_COMFORT,
				self::DISCHARGE_TOP_COMFORT_PLUS,
				self::DISCHARGE_COMFORT_EXCLUSIVE
			])) {
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
		if ($returnPackId && !in_array($returnPackId, [self::RETURN_PACK_NO, self::RETURN_PACK_NORMAL, self::RETURN_PACK_BIG])) {
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
		if ($freightCashId && !in_array($freightCashId, [self::FREIGHT_CACHE_NO, self::FREIGHT_CACHE_DISCHARGE, self::FREIGHT_CACHE_LOADING])) {
			throw new InvalidArgumentException('Unknown freight cache ID: ' . $freightCashId);
		}

		$this->freightCashId = $freightCashId;
		return $this;
	}

	/**
	 * @return bool|null
	 */
	public function getCashOnDeliveryType(): ?bool
	{
		return $this->cashOnDeliveryType;
	}

	/**
	 * @param bool|null $cashOnDeliveryType
	 * @return $this
	 */
	public function setCashOnDeliveryType(?bool $cashOnDeliveryType)
	{
		$this->cashOnDeliveryType = $cashOnDeliveryType;
		return $this;
	}

	/**
	 * @return float|null
	 */
	public function getCashOnDeliveryPrice(): ?float
	{
		return $this->cashOnDeliveryPrice;
	}

	/**
	 * @param float|null $cashOnDeliveryPrice
	 * @return $this
	 */
	public function setCashOnDeliveryPrice(?float $cashOnDeliveryPrice)
	{
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
	public function getVarSym(): ?string
	{
		return $this->varSym;
	}

	/**
	 * @param string|null $varSym
	 * @return $this
	 */
	public function setVarSym(?string $varSym)
	{
		$this->varSym = $varSym;
		return $this;
	}

	/**
	 * @return bool|null
	 */
	public function getOversize(): ?bool
	{
		return $this->oversize;
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
	 * @return bool|null
	 */
	public function getConsider(): ?bool
	{
		return $this->consider;
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
	 * @return bool|null
	 */
	public function getLabelFragile(): ?bool
	{
		return $this->labelFragile;
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
	 * @return bool|null
	 */
	public function getLabelDontTilt(): ?bool
	{
		return $this->labelDontTilt;
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
	 * @return bool|null
	 */
	public function getLabelThisSideUp(): ?bool
	{
		return $this->labelThisSideUp;
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
	 * @return bool|null
	 */
	public function getHydraulicFrontLoading(): ?bool
	{
		return $this->hydraulicFrontLoading;
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
	 * @return bool|null
	 */
	public function getHydraulicFrontDischarge(): ?bool
	{
		return $this->hydraulicFrontDischarge;
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
		return $this->kg;
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
		return $this->m3;
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
		return $this->orderValue;
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
	 * @return float|null
	 */
	public function getOrderValueCurrencyId(): ?float
	{
		return $this->orderValueCurrencyId;
	}

	/**
	 * @param float|null $orderValueCurrencyId
	 * @return $this
	 * @throws InvalidArgumentException
	 */
	public function setOrderValueCurrencyId(?float $orderValueCurrencyId)
	{
		if ($orderValueCurrencyId && !in_array($orderValueCurrencyId, [self::CURRENCY_CZK, self::CURRENCY_EUR])) {
			throw new InvalidArgumentException('Not allowed currency');
		}

		$this->orderValueCurrencyId = $orderValueCurrencyId;
		return $this;
	}

	/**
	 * @return Pack[]
	 */
	public function getPacks(): array
	{
		return $this->packs;
	}

	/**
	 * @param Pack[] $packs
	 * @return $this
	 */
	public function setPacks($packs)
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
		return$this;
	}

	private function validateTime($time)
	{
		if (preg_match('~^\d\d\:\d\d$~', $time)) {
			throw new InvalidArgumentException('Time must by in the format hh:mm');
		}
	}

}
