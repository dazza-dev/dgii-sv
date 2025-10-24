<?php

namespace DazzaDev\DgiiSv\Models\Issuer;

use DazzaDev\DgiiSv\DataLoader;
use DazzaDev\DgiiSv\Models\Base\IdentificationType;

class Responsible
{
    /**
     * Responsible name
     */
    private ?string $name = null;

    /**
     * Responsible identification type
     */
    private ?IdentificationType $identificationType = null;

    /**
     * Responsible identification number
     */
    private ?string $identificationNumber = null;

    /**
     * Responsible constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize data from array (English keys)
     */
    private function initialize(array $data): void
    {
        if (empty($data)) {
            return;
        }

        if (isset($data['name'])) {
            $this->setName($data['name']);
        }

        if (isset($data['identification_type'])) {
            $this->setIdentificationType($data['identification_type']);
        }

        if (isset($data['identification_number'])) {
            $this->setIdentificationNumber($data['identification_number']);
        }
    }

    /**
     * Get name
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Get identification type
     */
    public function getIdentificationType(): ?IdentificationType
    {
        return $this->identificationType;
    }

    /**
     * Set identification type using int|string code
     */
    public function setIdentificationType(int|string $identificationTypeCode): void
    {
        $typeData = (new DataLoader('tipos-identificacion'))->getByCode($identificationTypeCode);

        $this->identificationType = new IdentificationType($typeData);
    }

    /**
     * Get identification number
     */
    public function getIdentificationNumber(): ?string
    {
        return $this->identificationNumber;
    }

    /**
     * Set identification number
     */
    public function setIdentificationNumber(string $identificationNumber): void
    {
        $this->identificationNumber = $identificationNumber;
    }

    /**
     * Array representation using DGII Spanish keys
     */
    public function toArray(): array
    {
        return [
            'nombreResponsable' => $this->getName(),
            'tipoDocResponsable' => $this->getIdentificationType()->getCode(),
            'numeroDocResponsable' => $this->getIdentificationNumber(),
        ];
    }
}
