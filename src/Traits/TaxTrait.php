<?php

namespace DazzaDev\DgiiSv\Traits;

use DazzaDev\DgiiSv\DataLoader;
use DazzaDev\DgiiSv\Models\Body\Tax\Tax;

trait TaxTrait
{
    /**
     * Código del tributo especial (codTributo)
     */
    private ?string $taxCode = null;

    /**
     * Taxes
     */
    public ?array $taxes = null;

    /**
     * Get tax code
     */
    public function getTaxCode(): ?string
    {
        return $this->taxCode;
    }

    /**
     * Set tax code
     */
    public function setTaxCode(string $taxCode): void
    {
        $tax = (new DataLoader('tributos'))->getByCode($taxCode);

        $this->taxCode = $tax['code'];
    }

    /**
     * Get taxes
     */
    public function getTaxes(): ?array
    {
        return $this->taxes;
    }

    /**
     * Set taxes
     */
    public function setTaxes(array $taxes): void
    {
        foreach ($taxes as $tax) {
            $this->addTax($tax);
        }
    }

    /**
     * Add tax
     */
    public function addTax(array|Tax $tax): void
    {
        $this->taxes[] = $tax instanceof Tax ? $tax : new Tax($tax);
    }
}
