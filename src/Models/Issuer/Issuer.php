<?php

namespace DazzaDev\DgiiSv\Models\Issuer;

use DazzaDev\DgiiSv\DataLoader;
use DazzaDev\DgiiSv\Models\Base\Activity;
use DazzaDev\DgiiSv\Models\Base\CustomsFacility;
use DazzaDev\DgiiSv\Models\Base\Regime;
use DazzaDev\DgiiSv\Models\Geography\Address;
use DazzaDev\DgiiSv\Traits\ActivityTrait;
use DazzaDev\DgiiSv\Traits\EntityTrait;
use DazzaDev\DgiiSv\Traits\ItemTypeTrait;

class Issuer
{
    use ActivityTrait;
    use EntityTrait;
    use ItemTypeTrait;

    /**
     * NIT
     */
    private string $nit = '';

    /**
     * Legal Name
     */
    private string $legalName = '';

    /**
     * Trade Name
     */
    private string $tradeName = '';

    /**
     * Establishment
     */
    private ?Establishment $establishment = null;

    /**
     * Sale Point
     */
    private ?SalePoint $salePoint = null;

    /**
     * Responsible
     */
    private ?Responsible $responsible = null;

    /**
     * Regime
     */
    private ?Regime $regime = null;

    /**
     * Customs Facility
     */
    private ?CustomsFacility $customsFacility = null;

    /**
     * Issuer constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize issuer data
     */
    private function initialize(array $data): void
    {
        if (empty($data)) {
            return;
        }

        if (isset($data['nit'])) {
            $this->setNit($data['nit']);
        }

        if (isset($data['nrc'])) {
            $this->setNrc($data['nrc']);
        }

        if (isset($data['legal_name'])) {
            $this->setLegalName($data['legal_name']);
        }

        if (isset($data['trade_name'])) {
            $this->setTradeName($data['trade_name']);
        }

        if (isset($data['phone'])) {
            $this->setPhone($data['phone']);
        }

        if (isset($data['email'])) {
            $this->setEmail($data['email']);
        }

        if (isset($data['address'])) {
            $this->setAddress($data['address']);
        }

        if (isset($data['establishment'])) {
            $this->setEstablishment($data['establishment']);
        }

        if (isset($data['sale_point'])) {
            $this->setSalePoint($data['sale_point']);
        }

        if (isset($data['activity'])) {
            $this->setActivity($data['activity']);
        }

        if (isset($data['responsible'])) {
            $this->setResponsible($data['responsible']);
        }

        if (isset($data['regime'])) {
            $this->setRegime($data['regime']);
        }

        if (isset($data['item_type'])) {
            $this->setItemType($data['item_type']);
        }

        if (isset($data['customs_facility'])) {
            $this->setCustomsFacility($data['customs_facility']);
        }
    }

    /**
     * Get NIT
     */
    public function getNit(): string
    {
        return $this->nit;
    }

    /**
     * Set NIT
     */
    public function setNit(string $nit): void
    {
        $this->nit = $nit;
    }

    /**
     * Get Legal Name
     */
    public function getLegalName(): string
    {
        return $this->legalName;
    }

    /**
     * Set Legal Name
     */
    public function setLegalName(string $legalName): void
    {
        $this->legalName = $legalName;
    }

    /**
     * Get Trade Name
     */
    public function getTradeName(): string
    {
        return $this->tradeName;
    }

    /**
     * Set Trade Name
     */
    public function setTradeName(string $tradeName): void
    {
        $this->tradeName = $tradeName;
    }

    /**
     * Get Establishment
     */
    public function getEstablishment(): ?Establishment
    {
        return $this->establishment;
    }

    /**
     * Set Establishment using array or Establishment instance
     */
    public function setEstablishment(Establishment|array $establishment): void
    {
        $this->establishment = $establishment instanceof Establishment ? $establishment : new Establishment($establishment);
    }

    /**
     * Get Responsible
     */
    public function getResponsible(): ?Responsible
    {
        return $this->responsible;
    }

    /**
     * Set Responsible using array or Responsible instance
     */
    public function setResponsible(Responsible|array $responsible): void
    {
        if ($responsible instanceof Responsible) {
            $this->responsible = $responsible;

            return;
        }

        $this->responsible = new Responsible($responsible);
    }

    /**
     * Get Sale Point
     */
    public function getSalePoint(): ?SalePoint
    {
        return $this->salePoint;
    }

    /**
     * Set Sale Point using array or SalePoint instance
     */
    public function setSalePoint(SalePoint|array $salePoint): void
    {
        $this->salePoint = $salePoint instanceof SalePoint ? $salePoint : new SalePoint($salePoint);
    }

    /**
     * Get Regime
     */
    public function getRegime(): ?Regime
    {
        return $this->regime;
    }

    /**
     * Set Regime using array or Regime instance
     */
    public function setRegime(string|int $regimeCode): void
    {
        $regime = (new DataLoader('regimenes'))->getByCode($regimeCode);

        $this->regime = new Regime($regime);
    }

    /**
     * Get Customs Facility
     */
    public function getCustomsFacility(): ?CustomsFacility
    {
        return $this->customsFacility;
    }

    /**
     * Set Customs Facility using array or CustomsFacility instance
     */
    public function setCustomsFacility(string|int $customsFacilityCode): void
    {
        $customsFacility = (new DataLoader('recintos-fiscales'))->getByCode($customsFacilityCode);

        $this->customsFacility = new CustomsFacility($customsFacility);
    }

    /**
     * Array representation using DGII Spanish keys
     */
    public function toArray(): array
    {
        $data = [
            'nit' => $this->getNit(),
            'nrc' => $this->getNrc(),
            'nombre' => $this->getLegalName(),
        ];

        // Add trade name if available
        if ($this->getTradeName()) {
            $data['nombreComercial'] = $this->getTradeName();
        }

        // Add phone and email if available
        $data['telefono'] = $this->getPhone();
        $data['correo'] = $this->getEmail();

        // Add address data if available
        if ($this->address instanceof Address) {
            $data = array_merge($data, $this->address->toArray());
        }

        // Add establishment data if available
        if ($this->establishment instanceof Establishment) {
            $data = array_merge($data, $this->establishment->toArray());
        }

        // Add sale point data if available
        if ($this->salePoint instanceof SalePoint) {
            $data = array_merge($data, $this->salePoint->toArray());
        }

        // Add responsible data if available
        if ($this->responsible instanceof Responsible) {
            $data = array_merge($data, $this->responsible->toArray());
        }

        // Add activity data if available
        if ($this->activity instanceof Activity) {
            $data = array_merge($data, $this->activity->toArray());
        }

        return $data;
    }
}
