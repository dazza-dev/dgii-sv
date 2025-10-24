<?php

namespace DazzaDev\DgiiSv\Models\Body;

use DazzaDev\DgiiSv\Models\Body\Tax\Tax;

class Summary
{
    /**
     * Subtotal amount (without taxes)
     */
    public float $subtotal;

    /**
     * Total subsidy amount
     */
    public ?float $totalSubsidy = null;

    /**
     * Total discount amount
     */
    public float $totalDiscount = 0.0;

    /**
     * Reimbursement information
     */
    public ?Reimbursement $reimbursement = null;

    /**
     * Array of taxes
     */
    public array $taxes = [];

    /**
     * Tip amount
     */
    public ?float $tip = null;

    /**
     * Total amount (final total)
     */
    public float $total;

    /**
     * Totals constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize totals data
     */
    protected function initialize(array $data): void
    {
        if (empty($data)) {
            return;
        }

        if (isset($data['subtotal'])) {
            $this->setSubtotal($data['subtotal']);
        }

        if (isset($data['total_subsidy'])) {
            $this->setTotalSubsidy($data['total_subsidy']);
        }

        if (isset($data['total_discount'])) {
            $this->setTotalDiscount($data['total_discount']);
        }

        if (isset($data['reimbursement'])) {
            $this->setReimbursement($data['reimbursement']);
        }

        if (isset($data['taxes']) && is_array($data['taxes'])) {
            foreach ($data['taxes'] as $taxData) {
                $this->addTax($taxData);
            }
        }

        if (isset($data['tip'])) {
            $this->setTip($data['tip']);
        }

        if (isset($data['total'])) {
            $this->setTotal($data['total']);
        }
    }

    /**
     * Get subtotal amount
     */
    public function getSubtotal(): float
    {
        return $this->subtotal;
    }

    /**
     * Set subtotal amount
     */
    public function setSubtotal(float $subtotal): void
    {
        $this->subtotal = $subtotal;
    }

    /**
     * Get total subsidy amount
     */
    public function getTotalSubsidy(): ?float
    {
        return $this->totalSubsidy;
    }

    /**
     * Set total subsidy amount
     */
    public function setTotalSubsidy(float $totalSubsidy): void
    {
        $this->totalSubsidy = $totalSubsidy;
    }

    /**
     * Get total discount amount
     */
    public function getTotalDiscount(): float
    {
        return $this->totalDiscount;
    }

    /**
     * Set total discount amount
     */
    public function setTotalDiscount(float $totalDiscount): void
    {
        $this->totalDiscount = $totalDiscount;
    }

    /**
     * Get reimbursement information
     */
    public function getReimbursement(): ?Reimbursement
    {
        return $this->reimbursement;
    }

    /**
     * Set reimbursement information
     */
    public function setReimbursement(array|Reimbursement|null $reimbursement): void
    {
        if ($reimbursement === null) {
            $this->reimbursement = null;

            return;
        }

        if (is_array($reimbursement)) {
            $this->reimbursement = new Reimbursement($reimbursement);
        } else {
            $this->reimbursement = $reimbursement;
        }
    }

    /**
     * Get taxes array
     */
    public function getTaxes(): array
    {
        return $this->taxes;
    }

    /**
     * Set taxes array
     */
    public function setTaxes(array $taxes): void
    {
        $this->taxes = [];
        foreach ($taxes as $taxData) {
            $this->addTax($taxData);
        }
    }

    /**
     * Add tax to taxes array
     */
    public function addTax(array|Tax $tax): void
    {
        if (is_array($tax)) {
            $this->taxes[] = new Tax($tax);
        } else {
            $this->taxes[] = $tax;
        }
    }

    /**
     * Get tip amount
     */
    public function getTip(): ?float
    {
        return $this->tip;
    }

    /**
     * Set tip amount
     */
    public function setTip(float $tip): void
    {
        $this->tip = $tip;
    }

    /**
     * Get total amount
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * Set total amount
     */
    public function setTotal(float $total): void
    {
        $this->total = $total;
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return [
            'subtotal' => $this->getSubtotal(),
            'total_subsidy' => $this->getTotalSubsidy(),
            'total_discount' => $this->getTotalDiscount(),
            'reimbursement' => $this->getReimbursement()?->toArray(),
            'taxes' => array_map(fn(Tax $tax) => $tax->toArray(), $this->getTaxes()),
            'tip' => $this->getTip(),
            'total' => $this->getTotal(),
        ];
    }
}
