<?php

namespace DazzaDev\DgiiSv\Models\Body;

use DazzaDev\DgiiSv\DataLoader;
use DazzaDev\DgiiSv\Models\Base\Incoterm;
use DazzaDev\DgiiSv\Traits\TaxTrait;

class Summary
{
    use TaxTrait;

    /**
     * Total amount not subject to tax
     */
    public float $totalNotSubject = 0.0;

    /**
     * Total exempt amount
     */
    public float $totalExempt = 0.0;

    /**
     * Total taxable amount
     */
    public float $totalTaxable = 0.0;

    /**
     * Subtotal of sales
     */
    public float $salesSubtotal = 0.0;

    /**
     * Discount on non-subject amount
     */
    public float $discountNotSubject = 0.0;

    /**
     * Discount on exempt amount
     */
    public float $discountExempt = 0.0;

    /**
     * Discount on taxable amount
     */
    public float $discountTaxable = 0.0;

    /**
     * Discount percentage
     */
    public float $discountPercentage = 0.0;

    /**
     * Total discount amount
     */
    public float $totalDiscount = 0.0;

    /**
     * Global discount amount
     */
    public float $globalDiscount = 0.0;

    /**
     * Subtotal amount
     */
    public float $subtotal = 0.0;

    /**
     * IVA Retencion
     */
    public float $ivaRetention = 0.0;

    /**
     * IVA Withheld
     */
    public float $ivaWithheld = 0.0;

    /**
     * ReteRenta
     */
    public float $reteRenta = 0.0;

    /**
     * Total operation amount
     */
    public float $total = 0.0;

    /**
     * Total non-taxable amount
     */
    public float $totalNonTaxable = 0.0;

    /**
     * Total amount to pay
     */
    public float $totalToPay = 0.0;

    /**
     * Total TAX amount
     */
    public float $totalTax = 0.0;

    /**
     * Total purchase amount
     */
    public float $totalPurchase = 0.0;

    /**
     * Balance in favor
     */
    public float $balanceInFavor = 0.0;

    /**
     * Freight amount
     */
    public float $freight = 0.0;

    /**
     * Insurance amount
     */
    public float $insurance = 0.0;

    /**
     * Operation condition
     */
    public ?OperationCondition $operationCondition = null;

    /**
     * Incoterm
     */
    public ?Incoterm $incoterm = null;

    /**
     * Electronic payment number
     */
    public ?string $electronicPaymentNumber = null;

    /**
     * Observations
     */
    public ?string $observations = null;

    /**
     * Constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize summary data
     */
    private function initialize(array $data): void
    {
        if (empty($data)) {
            return;
        }

        if (isset($data['total_not_subject'])) {
            $this->setTotalNotSubject($data['total_not_subject']);
        }

        if (isset($data['total_exempt'])) {
            $this->setTotalExempt($data['total_exempt']);
        }

        if (isset($data['total_taxable'])) {
            $this->setTotalTaxable($data['total_taxable']);
        }

        if (isset($data['subtotal_sales'])) {
            $this->setSalesSubtotal($data['subtotal_sales']);
        }

        if (isset($data['discount_not_subject'])) {
            $this->setDiscountNotSubject($data['discount_not_subject']);
        }

        if (isset($data['discount_exempt'])) {
            $this->setDiscountExempt($data['discount_exempt']);
        }

        if (isset($data['discount_taxable'])) {
            $this->setDiscountTaxable($data['discount_taxable']);
        }

        if (isset($data['discount_percentage'])) {
            $this->setDiscountPercentage($data['discount_percentage']);
        }

        if (isset($data['total_discount'])) {
            $this->setTotalDiscount($data['total_discount']);
        }

        if (isset($data['global_discount'])) {
            $this->setGlobalDiscount($data['global_discount']);
        }

        if (isset($data['taxes'])) {
            $this->setTaxes($data['taxes']);
        }

        if (isset($data['subtotal'])) {
            $this->setSubtotal($data['subtotal']);
        }

        if (isset($data['iva_retention'])) {
            $this->setIvaRetention($data['iva_retention']);
        }

        if (isset($data['iva_withheld'])) {
            $this->setIvaWithheld($data['iva_withheld']);
        }

        if (isset($data['rete_renta'])) {
            $this->setReteRenta($data['rete_renta']);
        }

        if (isset($data['total'])) {
            $this->setTotal($data['total']);
        }

        if (isset($data['total_non_taxable'])) {
            $this->setTotalNonTaxable($data['total_non_taxable']);
        }

        if (isset($data['total_to_pay'])) {
            $this->setTotalToPay($data['total_to_pay']);
        }

        if (isset($data['total_tax'])) {
            $this->setTotalTax($data['total_tax']);
        }

        if (isset($data['total_purchase'])) {
            $this->setTotalPurchase($data['total_purchase']);
        }

        if (isset($data['balance_in_favor'])) {
            $this->setBalanceInFavor($data['balance_in_favor']);
        }

        if (isset($data['freight'])) {
            $this->setFreight($data['freight']);
        }

        if (isset($data['insurance'])) {
            $this->setInsurance($data['insurance']);
        }

        if (isset($data['operation_condition'])) {
            $this->setOperationCondition($data['operation_condition']);
        }

        if (isset($data['incoterm'])) {
            $this->setIncoterm($data['incoterm']);
        }

        if (isset($data['electronic_payment_number'])) {
            $this->setElectronicPaymentNumber($data['electronic_payment_number']);
        }

        if (isset($data['observations'])) {
            $this->setObservations($data['observations']);
        }
    }

    /**
     * Get total amount not subject to tax
     */
    public function getTotalNotSubject(): float
    {
        return $this->totalNotSubject;
    }

    /**
     * Set total amount not subject to tax
     */
    public function setTotalNotSubject(float $totalNotSubject): void
    {
        $this->totalNotSubject = $totalNotSubject;
    }

    /**
     * Get total exempt amount
     */
    public function getTotalExempt(): float
    {
        return $this->totalExempt;
    }

    /**
     * Set total exempt amount
     */
    public function setTotalExempt(float $totalExempt): void
    {
        $this->totalExempt = $totalExempt;
    }

    /**
     * Get total taxable amount
     */
    public function getTotalTaxable(): float
    {
        return $this->totalTaxable;
    }

    /**
     * Set total taxable amount
     */
    public function setTotalTaxable(float $totalTaxable): void
    {
        $this->totalTaxable = $totalTaxable;
    }

    /**
     * Get sales subtotal
     */
    public function getSalesSubtotal(): float
    {
        return $this->salesSubtotal;
    }

    /**
     * Set sales subtotal
     */
    public function setSalesSubtotal(float $salesSubtotal): void
    {
        $this->salesSubtotal = $salesSubtotal;
    }

    /**
     * Get discount not subject to tax
     */
    public function getDiscountNotSubject(): float
    {
        return $this->discountNotSubject;
    }

    /**
     * Set discount not subject to tax
     */
    public function setDiscountNotSubject(float $discountNotSubject): void
    {
        $this->discountNotSubject = $discountNotSubject;
    }

    /**
     * Get discount exempt
     */
    public function getDiscountExempt(): float
    {
        return $this->discountExempt;
    }

    /**
     * Set discount exempt
     */
    public function setDiscountExempt(float $discountExempt): void
    {
        $this->discountExempt = $discountExempt;
    }

    /**
     * Get discount taxable
     */
    public function getDiscountTaxable(): float
    {
        return $this->discountTaxable;
    }

    /**
     * Set discount taxable
     */
    public function setDiscountTaxable(float $discountTaxable): void
    {
        $this->discountTaxable = $discountTaxable;
    }

    /**
     * Get discount percentage
     */
    public function getDiscountPercentage(): float
    {
        return $this->discountPercentage;
    }

    /**
     * Set discount percentage
     */
    public function setDiscountPercentage(float $discountPercentage): void
    {
        $this->discountPercentage = $discountPercentage;
    }

    /**
     * Get total discount
     */
    public function getTotalDiscount(): float
    {
        return $this->totalDiscount;
    }

    /**
     * Set total discount
     */
    public function setTotalDiscount(float $totalDiscount): void
    {
        $this->totalDiscount = $totalDiscount;
    }

    /**
     * Get global discount
     */
    public function getGlobalDiscount(): float
    {
        return $this->globalDiscount;
    }

    /**
     * Set global discount
     */
    public function setGlobalDiscount(float $globalDiscount): void
    {
        $this->globalDiscount = $globalDiscount;
    }

    /**
     * Get subtotal
     */
    public function getSubtotal(): float
    {
        return $this->subtotal;
    }

    /**
     * Set subtotal
     */
    public function setSubtotal(float $subtotal): void
    {
        $this->subtotal = $subtotal;
    }

    /**
     * Get iva retention
     */
    public function getIvaRetention(): float
    {
        return $this->ivaRetention;
    }

    /**
     * Set iva retention
     */
    public function setIvaRetention(float $ivaRetention): void
    {
        $this->ivaRetention = $ivaRetention;
    }

    /**
     * Get iva withheld
     */
    public function getIvaWithheld(): float
    {
        return $this->ivaWithheld;
    }

    /**
     * Set iva withheld
     */
    public function setIvaWithheld(float $ivaWithheld): void
    {
        $this->ivaWithheld = $ivaWithheld;
    }

    /**
     * Get rete renta
     */
    public function getReteRenta(): float
    {
        return $this->reteRenta;
    }

    /**
     * Set rete renta
     */
    public function setReteRenta(float $reteRenta): void
    {
        $this->reteRenta = $reteRenta;
    }

    /**
     * Get total
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * Set total
     */
    public function setTotal(float $total): void
    {
        $this->total = $total;
    }

    /**
     * Get total non taxable
     */
    public function getTotalNonTaxable(): float
    {
        return $this->totalNonTaxable;
    }

    /**
     * Set total non taxable
     */
    public function setTotalNonTaxable(float $totalNonTaxable): void
    {
        $this->totalNonTaxable = $totalNonTaxable;
    }

    /**
     * Get total to pay
     */
    public function getTotalToPay(): float
    {
        return $this->totalToPay;
    }

    /**
     * Set total to pay
     */
    public function setTotalToPay(float $totalToPay): void
    {
        $this->totalToPay = $totalToPay;
    }

    /**
     * Get total tax
     */
    public function getTotalTax(): float
    {
        return $this->totalTax;
    }

    /**
     * Set total tax
     */
    public function setTotalTax(float $totalTax): void
    {
        $this->totalTax = $totalTax;
    }

    /**
     * Get total purchase
     */
    public function getTotalPurchase(): float
    {
        return $this->totalPurchase;
    }

    /**
     * Set total purchase
     */
    public function setTotalPurchase(float $totalPurchase): void
    {
        $this->totalPurchase = $totalPurchase;
    }

    /**
     * Get balance in favor
     */
    public function getBalanceInFavor(): float
    {
        return $this->balanceInFavor;
    }

    /**
     * Set balance in favor
     */
    public function setBalanceInFavor(float $balanceInFavor): void
    {
        $this->balanceInFavor = $balanceInFavor;
    }

    /**
     * Get freight
     */
    public function getFreight(): float
    {
        return $this->freight;
    }

    /**
     * Set freight
     */
    public function setFreight(float $freight): void
    {
        $this->freight = $freight;
    }

    /**
     * Get insurance
     */
    public function getInsurance(): float
    {
        return $this->insurance;
    }

    /**
     * Set insurance
     */
    public function setInsurance(float $insurance): void
    {
        $this->insurance = $insurance;
    }

    /**
     * Get operation condition
     */
    public function getOperationCondition(): ?OperationCondition
    {
        return $this->operationCondition;
    }

    /**
     * Get operation condition code
     */
    public function getOperationConditionCode(): int
    {
        return (int) $this->getOperationCondition()?->getCode();
    }

    /**
     * Set operation condition
     */
    public function setOperationCondition(int $operationConditionCode): void
    {
        $operationCondition = (new DataLoader('condiciones-operacion'))->getByCode($operationConditionCode);

        $this->operationCondition = new OperationCondition($operationCondition);
    }

    /**
     * Get incoterm
     */
    public function getIncoterm(): ?Incoterm
    {
        return $this->incoterm;
    }

    /**
     * Set incoterm
     */
    public function setIncoterm(int $incotermCode): void
    {
        $incoterm = (new DataLoader('incoterms'))->getByCode($incotermCode);

        $this->incoterm = new Incoterm($incoterm);
    }

    /**
     * Get electronic payment number
     */
    public function getElectronicPaymentNumber(): ?string
    {
        return $this->electronicPaymentNumber;
    }

    /**
     * Set electronic payment number
     */
    public function setElectronicPaymentNumber(?string $electronicPaymentNumber): void
    {
        $this->electronicPaymentNumber = $electronicPaymentNumber;
    }

    /**
     * Get observations
     */
    public function getObservations(): ?string
    {
        return $this->observations;
    }

    /**
     * Set observations
     */
    public function setObservations(?string $observations): void
    {
        $this->observations = $observations;
    }

    /**
     * Convert to array
     */
    public function toArray(): array
    {
        return [
            'totalNoSuj' => $this->getTotalNotSubject(),
            'totalExenta' => $this->getTotalExempt(),
            'totalGravada' => $this->getTotalTaxable(),
            'subTotalVentas' => $this->getSalesSubtotal(),
            'descuNoSuj' => $this->getDiscountNotSubject(),
            'descuExenta' => $this->getDiscountExempt(),
            'descuGravada' => $this->getDiscountTaxable(),
            'porcentajeDescuento' => $this->getDiscountPercentage(),
            'totalDescu' => $this->getTotalDiscount(),
            'tributos' => $this->getTaxes(),
            'subTotal' => $this->getSubtotal(),
            'ivaRete1' => $this->getIvaRetention(),
            'reteRenta' => $this->getReteRenta(),
            'montoTotalOperacion' => $this->getTotal(),
            'totalNoGravado' => $this->getTotalNonTaxable(),
            'totalPagar' => $this->getTotalToPay(),
            'totalIva' => $this->getTotalTax(),
            'saldoFavor' => $this->getBalanceInFavor(),
            'condicionOperacion' => $this->getOperationConditionCode(),
            'numPagoElectronico' => $this->getElectronicPaymentNumber(),
        ];
    }
}
