<?php

namespace DazzaDev\DgiiSv\Models\Body\Tax;

use DazzaDev\DgiiSv\DataLoader;

class Tax
{
    /**
     * Tax type
     */
    public TaxType $taxType;

    /**
     * Tax percentage model
     */
    public TaxPercentage $taxPercentage;

    /**
     * Tax rate
     */
    public float $rate;

    /**
     * Taxable base amount
     */
    public float $taxableBase;

    /**
     * Tax value amount
     */
    public float $value;

    /**
     * Additional discount amount
     */
    public float $discount = 0.00;

    /**
     * VAT refund value amount
     */
    public ?float $refundValue = null;

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

        if (isset($data['percentage_code'])) {
            $this->setTaxPercentage($data['code'], $data['percentage_code']);
        }

        if (isset($data['rate'])) {
            $this->setRate($data['rate']);
        }

        if (isset($data['taxable_base'])) {
            $this->setTaxableBase($data['taxable_base']);
        }

        if (isset($data['value'])) {
            $this->setValue($data['value']);
        }

        if (isset($data['discount'])) {
            $this->setDiscount($data['discount']);
        }

        if (isset($data['refund_value'])) {
            $this->setRefundValue($data['refund_value']);
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
        $taxType = (new DataLoader('tax-types'))->getByCode($taxTypeCode);

        $this->taxType = new TaxType($taxType);
    }

    /**
     * Get tax code (for backward compatibility)
     */
    public function getCode(): string
    {
        return $this->taxType->getCode();
    }

    /**
     * Set tax code (for backward compatibility)
     */
    public function setCode(string $code): void
    {
        $this->setTaxType($code);
    }

    /**
     * Set tax percentage instance based on current tax type and percentage code
     */
    private function setTaxPercentage(int|string $taxTypeCode, int|string $percentageCode): void
    {
        $percentageData = (new DataLoader('taxes/' . $taxTypeCode))->getByCode($percentageCode);

        $this->taxPercentage = new TaxPercentage($percentageData);
    }

    /**
     * Get tax percentage model
     */
    public function getTaxPercentage(): TaxPercentage
    {
        return $this->taxPercentage;
    }

    /**
     * Get tax rate
     */
    public function getRate(): float
    {
        return $this->rate;
    }

    /**
     * Set tax rate
     */
    public function setRate(float $rate): void
    {
        $this->rate = $rate;
    }

    /**
     * Get taxable base amount
     */
    public function getTaxableBase(): float
    {
        return $this->taxableBase;
    }

    /**
     * Set taxable base amount
     */
    public function setTaxableBase(float $taxableBase): void
    {
        $this->taxableBase = $taxableBase;
    }

    /**
     * Get tax value amount
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * Set tax value amount
     */
    public function setValue(float $value): void
    {
        $this->value = $value;
    }

    /**
     * Get additional discount amount
     */
    public function getDiscount(): float
    {
        return $this->discount;
    }

    /**
     * Set additional discount amount
     */
    public function setDiscount(?float $discount): void
    {
        $this->discount = $discount;
    }

    /**
     * Get VAT refund value amount
     */
    public function getRefundValue(): ?float
    {
        return $this->refundValue;
    }

    /**
     * Set VAT refund value amount
     */
    public function setRefundValue(?float $refundValue): void
    {
        $this->refundValue = $refundValue;
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return [
            'tax_type' => $this->getTaxType()->toArray(),
            'tax_percentage' => $this->getTaxPercentage()->toArray(),
            'rate' => $this->getRate(),
            'taxable_base' => $this->getTaxableBase(),
            'value' => $this->getValue(),
            'discount' => $this->getDiscount(),
            'refund_value' => $this->getRefundValue(),
        ];
    }
}
