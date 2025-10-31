<?php

namespace DazzaDev\DgiiSv\Traits;

use DazzaDev\DgiiSv\DataLoader;
use DazzaDev\DgiiSv\Models\Base\IdentificationType;

trait IdentificationTrait
{
    /**
     * Identification type
     */
    private ?IdentificationType $identificationType = null;

    /**
     * Identification number
     */
    private ?string $identificationNumber = null;

    /**
     * Get NIT
     */
    public function getIdentificationType(): ?IdentificationType
    {
        return $this->identificationType;
    }

    /**
     * Set Identification Type
     */
    public function setIdentificationType(string $identificationTypeCode): void
    {
        $identificationType = (new DataLoader('tipos-identificacion'))->getByCode($identificationTypeCode);

        $this->identificationType = new IdentificationType($identificationType);
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
}
