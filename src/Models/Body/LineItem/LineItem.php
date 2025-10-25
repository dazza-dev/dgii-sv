<?php

namespace DazzaDev\DgiiSv\Models\Body\LineItem;

use DazzaDev\DgiiSv\DataLoader;
use DazzaDev\DgiiSv\Models\Body\Tax\Tax;

class LineItem
{
    /**
     * Item Number (numItem)
     */
    private int $itemNumber = 1;

    /**
     * Item Type (tipoItem)
     */
    private ?LineItemType $itemType = null;

    /**
     * Related Document Number (numeroDocumento)
     */
    private ?string $relatedDocumentNumber = null;

    /**
     * Quantity (cantidad)
     */
    private ?string $quantity = null;

    /**
     * Code (codigo)
     */
    private ?string $code = null;

    /**
     * Unit Measure (uniMedida)
     */
    private ?int $unitMeasure = null;

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

        if (isset($data['item_number'])) {
            $this->setItemNumber($data['item_number']);
        }

        if (isset($data['item_type'])) {
            $this->setItemType((int) $data['item_type']);
        }

        if (isset($data['related_document_number'])) {
            $this->setRelatedDocumentNumber($data['related_document_number']);
        }

        if (isset($data['quantity'])) {
            $this->setQuantity((float) $data['quantity']);
        }

        if (isset($data['code'])) {
            $this->setCode($data['code']);
        }

        if (isset($data['unit_measure'])) {
            $this->setUnitMeasure((int) $data['unit_measure']);
        }
    }

    /**
     * Get item number
     */
    public function getItemNumber(): int
    {
        return $this->itemNumber;
    }

    /**
     * Set item number
     */
    public function setItemNumber(int $itemNumber): void
    {
        $this->itemNumber = $itemNumber;
    }

    /**
     * Get item type
     */
    public function getItemType(): ?LineItemType
    {
        return $this->itemType;
    }

    /**
     * Set item type
     */
    public function setItemType(int $itemTypeCode): void
    {
        $itemType = (new DataLoader('tipos-item'))->getByCode($itemTypeCode);

        $this->itemType = new LineItemType($itemType);
    }

    /**
     * Get related document number
     */
    public function getRelatedDocumentNumber(): ?string
    {
        return $this->relatedDocumentNumber;
    }

    /**
     * Set related document number
     */
    public function setRelatedDocumentNumber(string $relatedDocumentNumber): void
    {
        $this->relatedDocumentNumber = $relatedDocumentNumber;
    }

    /**
     * Get quantity
     */
    public function getQuantity(): ?float
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
     * Get unit of measure
     */
    public function getUnitMeasure(): string
    {
        return $this->unitMeasure;
    }

    /**
     * Set unit of measure
     */
    public function setUnitMeasure(int $unitMeasure): void
    {
        $this->unitMeasure = $unitMeasure;
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
            'numItem' => $this->getItemNumber(),
            'tipoItem' => $this->getItemType()->getCode(),
            'quantity' => $this->getQuantity(),
            'taxes' => array_map(function (Tax $tax) {
                return $tax->toArray();
            }, $this->getTaxes()),
        ];
    }
}
