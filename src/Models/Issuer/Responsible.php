<?php

namespace DazzaDev\DgiiSv\Models\Issuer;

use DazzaDev\DgiiSv\DataLoader;
use DazzaDev\DgiiSv\Models\Base\IdentificationType;
use DazzaDev\DgiiSv\Traits\IdentificationNumberTrait;
use DazzaDev\DgiiSv\Traits\NameTrait;

class Responsible
{
    use IdentificationNumberTrait;
    use NameTrait;

    /**
     * Responsible identification type
     */
    private ?IdentificationType $identificationType = null;

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
