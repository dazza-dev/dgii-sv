<?php

namespace DazzaDev\DgiiSv\Traits;

trait IdentificationNumberTrait
{
    /**
     * Identification number
     */
    private ?string $identificationNumber = null;

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
