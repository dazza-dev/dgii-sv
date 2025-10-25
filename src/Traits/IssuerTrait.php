<?php

namespace DazzaDev\DgiiSv\Traits;

use DazzaDev\DgiiSv\Models\Issuer\Issuer;

trait IssuerTrait
{
    /**
     * Issuer information
     */
    private ?Issuer $issuer = null;

    /**
     * Get issuer
     */
    public function getIssuer(): ?Issuer
    {
        return $this->issuer;
    }

    /**
     * Set issuer
     */
    public function setIssuer(Issuer|array $issuer): void
    {
        $this->issuer = $issuer instanceof Issuer ? $issuer : new Issuer($issuer);
    }
}
