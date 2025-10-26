<?php

namespace DazzaDev\DgiiSv\Models\Body\Tax;

use DazzaDev\DgiiSv\DataLoader;

class Tax
{
    /**
     * Tax type
     */
    public ?TaxType $taxType = null;

    /**
     * Tax amount
     */
    public ?float $amount = null;

    /**
     * Tax constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize tax data
     */
    protected function initialize(array $data): void
    {
        if (empty($data)) {
            return;
        }

        if (isset($data['code'])) {
            $this->setTaxType($data['code']);
        }

        if (isset($data['amount'])) {
            $this->setAmount($data['amount']);
        }
    }

    /**
     * Get tax type
     */
    public function getTaxType(): TaxType
    {
        return $this->taxType;
    }

    /**
     * Set tax type
     */
    public function setTaxType(int|string $taxTypeCode): void
    {
        $taxType = (new DataLoader('tributos'))->getByCode($taxTypeCode);

        $this->taxType = new TaxType($taxType);
    }

    /**
     * Get tax code (for backward compatibility)
     */
    public function getCode(): ?string
    {
        return $this->getTaxType()?->getCode() ?? null;
    }

    /**
     * Get tax amount
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }

    /**
     * Set tax amount
     */
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return [
            'codigo' => $this->getTaxType()?->getCode(),
            'descripcion' => $this->getTaxType()?->getName(),
            'valor' => $this->getAmount(),
        ];
    }
}
