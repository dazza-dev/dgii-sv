<?php

namespace DazzaDev\DgiiSv\Models\Body;

use DazzaDev\DgiiSv\Models\Body\Tax\Tax;

class LineItem
{
    /**
     * Main code
     */
    private string $code;

    /**
     * Auxiliary code
     */
    private ?string $auxiliaryCode = null;

    /**
     * Description
     */
    private string $description;

    /**
     * Unit of measure
     */
    private string $unit;

    /**
     * Quantity
     */
    private float $quantity;

    /**
     * Unit price
     */
    private float $unitPrice;

    /**
     * Unit price without subsidy
     */
    private ?float $unitPriceWithoutSubsidy = null;

    /**
     * Discount
     */
    private float $discount = 0.0;

    /**
     * Total price without tax
     */
    private float $totalPriceWithoutTax;

    /**
     * Additional information
     */
    private array $additionalInfo = [];

    /**
     * Taxes
     */
    private array $taxes = [];

    /**
     * N° de ítem (numItem)
     */
    private int $itemNumber = 1;

    /**
     * Tipo de ítem (tipoItem)
     */
    private int $itemType = 1;

    /**
     * Número de documento relacionado (numeroDocumento)
     */
    private ?string $relatedDocumentNumber = null;

    /**
     * Unidad de medida (uniMedida)
     */
    private int $unitMeasure = 99;

    /**
     * Código del tributo especial (codTributo)
     */
    private ?string $tributeCode = null;

    /**
     * Códigos de tributos (tributos)
     *
     * @var string[]|null
     */
    private ?array $tributes = null;

    /**
     * Precio sugerido de venta (psv)
     */
    private float $suggestedSalePrice = 0.0;

    /**
     * No Gravado (noGravado)
     */
    private float $nonTaxable = 0.0;

    /**
     * Ventas no sujetas (ventaNoSuj)
     */
    private float $saleNotSubject = 0.0;

    /**
     * Ventas exentas (ventaExenta)
     */
    private float $saleExempt = 0.0;

    /**
     * Ventas gravadas (ventaGravada)
     */
    private float $saleTaxed = 0.0;

    /**
     * IVA por ítem (ivaItem)
     */
    private float $vatItem = 0.0;

    /**
     * LineItem constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize line item data
     */
    private function initialize(array $data): void
    {
        if (empty($data)) {
            return;
        }

        if (isset($data['code'])) {
            $this->setCode($data['code']);
        }

        if (isset($data['auxiliary_code'])) {
            $this->setAuxiliaryCode($data['auxiliary_code']);
        }
    }

    /**
     * Get main code
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Set main code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * Get auxiliary code
     */
    public function getAuxiliaryCode(): ?string
    {
        return $this->auxiliaryCode;
    }

    /**
     * Set auxiliary code
     */
    public function setAuxiliaryCode(string $auxiliaryCode): void
    {
        $this->auxiliaryCode = $auxiliaryCode;
    }

    /**
     * Get description
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * Get unit of measure
     */
    public function getUnit(): string
    {
        return $this->unit;
    }

    /**
     * Set unit of measure
     */
    public function setUnit(string $unit): void
    {
        $this->unit = $unit;
    }

    /**
     * Get quantity
     */
    public function getQuantity(): float
    {
        return $this->quantity;
    }

    /**
     * Set quantity
     */
    public function setQuantity(float $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * Get unit price
     */
    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    /**
     * Set unit price
     */
    public function setUnitPrice(float $unitPrice): void
    {
        $this->unitPrice = $unitPrice;
    }

    /**
     * Get unit price without subsidy
     */
    public function getUnitPriceWithoutSubsidy(): ?float
    {
        return $this->unitPriceWithoutSubsidy;
    }

    /**
     * Set unit price without subsidy
     */
    public function setUnitPriceWithoutSubsidy(?float $unitPriceWithoutSubsidy): void
    {
        $this->unitPriceWithoutSubsidy = $unitPriceWithoutSubsidy;
    }

    /**
     * Get discount
     */
    public function getDiscount(): float
    {
        return $this->discount;
    }

    /**
     * Set discount
     */
    public function setDiscount(float $discount): void
    {
        $this->discount = $discount;
    }

    /**
     * Get total price without tax
     */
    public function getTotalPriceWithoutTax(): float
    {
        return $this->totalPriceWithoutTax;
    }

    /**
     * Set total price without tax
     */
    public function setTotalPriceWithoutTax(float $totalPriceWithoutTax): void
    {
        $this->totalPriceWithoutTax = $totalPriceWithoutTax;
    }

    /**
     * Get additional information
     */
    public function getAdditionalInfo(): array
    {
        return $this->additionalInfo;
    }

    /**
     * Get taxes
     */
    public function getTaxes(): array
    {
        return $this->taxes;
    }

    /**
     * Set taxes
     */
    public function setTaxes(array $taxes): void
    {
        $this->taxes = [];
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

    /**
     * Convert to array for XML generation
     */
    public function toArray(): array
    {
        return [
            'code' => $this->getCode(),
            'auxiliary_code' => $this->getAuxiliaryCode(),
            'description' => $this->getDescription(),
            'unit' => $this->getUnit(),
            'quantity' => $this->getQuantity(),
            'unit_price' => $this->getUnitPrice(),
            'unit_price_without_subsidy' => $this->getUnitPriceWithoutSubsidy(),
            'discount' => $this->getDiscount(),
            'total_price_without_tax' => $this->getTotalPriceWithoutTax(),
            'additional_info' => array_map(function (AdditionalInfo $info) {
                return $info->toArray();
            }, $this->getAdditionalInfo()),
            'taxes' => array_map(function (Tax $tax) {
                return $tax->toArray();
            }, $this->getTaxes()),
        ];
    }
}
