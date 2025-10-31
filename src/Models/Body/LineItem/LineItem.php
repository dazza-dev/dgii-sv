<?php

namespace DazzaDev\DgiiSv\Models\Body\LineItem;

use DazzaDev\DgiiSv\DataLoader;
use DazzaDev\DgiiSv\Models\Body\Tax\Tax;
use DazzaDev\DgiiSv\Traits\ItemTypeTrait;
use DazzaDev\DgiiSv\Traits\TaxTrait;

class LineItem
{
    use ItemTypeTrait;
    use TaxTrait;

    /**
     * Item Number (numItem)
     */
    private int $itemNumber = 1;

    /**
     * Related Document Number (numeroDocumento)
     */
    private ?string $relatedDocumentNumber = null;

    /**
     * Quantity (cantidad)
     */
    private ?float $quantity = null;

    /**
     * Code (codigo)
     */
    private ?string $code = null;

    /**
     * Description (descripcion)
     */
    private ?string $description = null;

    /**
     * Unit Of Measure (uniMedida)
     */
    private ?UnitOfMeasure $unitOfMeasure = null;

    /**
     * Precio unitario (precioUni)
     */
    private float $unitPrice = 0.0;

    /**
     * Discount (descuento)
     */
    private float $discount = 0.0;

    /**
     * Purchase (compra)
     */
    private float $purchase = 0.0;

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
     * Precio sugerido de venta (psv)
     */
    private float $suggestedSalePrice = 0.0;

    /**
     * No Gravado (noGravado)
     */
    private float $nonTaxable = 0.0;

    /**
     * IVA por ítem (ivaItem)
     */
    private float $taxAmount = 0.0;

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

        if (isset($data['description'])) {
            $this->setDescription($data['description']);
        }

        if (isset($data['unit_of_measure'])) {
            $this->setUnitOfMeasure((int) $data['unit_of_measure']);
        }

        if (isset($data['unit_price'])) {
            $this->setUnitPrice((float) $data['unit_price']);
        }

        if (isset($data['purchase'])) {
            $this->setPurchase((float) $data['purchase']);
        }

        if (isset($data['discount'])) {
            $this->setDiscount((float) $data['discount']);
        }

        if (isset($data['sale_not_subject'])) {
            $this->setSaleNotSubject((float) $data['sale_not_subject']);
        }

        if (isset($data['sale_exempt'])) {
            $this->setSaleExempt((float) $data['sale_exempt']);
        }

        if (isset($data['sale_taxed'])) {
            $this->setSaleTaxed((float) $data['sale_taxed']);
        }

        if (isset($data['suggested_sale_price'])) {
            $this->setSuggestedSalePrice((float) $data['suggested_sale_price']);
        }

        if (isset($data['non_taxable'])) {
            $this->setNonTaxable((float) $data['non_taxable']);
        }

        if (isset($data['tax_amount'])) {
            $this->setTaxAmount((float) $data['tax_amount']);
        }

        if (isset($data['tax_code'])) {
            $this->setTaxCode($data['tax_code']);
        }

        if (isset($data['taxes'])) {
            $this->setTaxes($data['taxes']);
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
    public function getCode(): ?string
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
     * Get description
     */
    public function getDescription(): ?string
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
    public function getUnitOfMeasure(): ?UnitOfMeasure
    {
        return $this->unitOfMeasure;
    }

    /**
     * Set unit of measure
     */
    public function setUnitOfMeasure(string|int $unitOfMeasureCode): void
    {
        $unitOfMeasure = (new DataLoader('unidades-medida'))->getByCode($unitOfMeasureCode);

        $this->unitOfMeasure = new UnitOfMeasure($unitOfMeasure);
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
     * Get purchase
     */
    public function getPurchase(): float
    {
        return $this->purchase;
    }

    /**
     * Set purchase
     */
    public function setPurchase(float $purchase): void
    {
        $this->purchase = $purchase;
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
     * Get sale not subject
     */
    public function getSaleNotSubject(): float
    {
        return $this->saleNotSubject;
    }

    /**
     * Set sale not subject
     */
    public function setSaleNotSubject(float $saleNotSubject): void
    {
        $this->saleNotSubject = $saleNotSubject;
    }

    /**
     * Get sale exempt
     */
    public function getSaleExempt(): float
    {
        return $this->saleExempt;
    }

    /**
     * Set sale exempt
     */
    public function setSaleExempt(float $saleExempt): void
    {
        $this->saleExempt = $saleExempt;
    }

    /**
     * Get sale taxed
     */
    public function getSaleTaxed(): float
    {
        return $this->saleTaxed;
    }

    /**
     * Set sale taxed
     */
    public function setSaleTaxed(float $saleTaxed): void
    {
        $this->saleTaxed = $saleTaxed;
    }

    /**
     * Get suggested sale price
     */
    public function getSuggestedSalePrice(): float
    {
        return $this->suggestedSalePrice;
    }

    /**
     * Set suggested sale price
     */
    public function setSuggestedSalePrice(float $suggestedSalePrice): void
    {
        $this->suggestedSalePrice = $suggestedSalePrice;
    }

    /**
     * Get non taxable
     */
    public function getNonTaxable(): float
    {
        return $this->nonTaxable;
    }

    /**
     * Set non taxable
     */
    public function setNonTaxable(float $nonTaxable): void
    {
        $this->nonTaxable = $nonTaxable;
    }

    /**
     * Get tax amount
     */
    public function getTaxAmount(): float
    {
        return $this->taxAmount;
    }

    /**
     * Set tax amount
     */
    public function setTaxAmount(float $taxAmount): void
    {
        $this->taxAmount = $taxAmount;
    }

    /**
     * Convert to array
     */
    public function toArray(): array
    {
        $taxes = null;
        if ($this->getTaxes() !== null) {
            $taxes = array_map(fn (Tax $tax) => $tax->getCode(), $this->getTaxes());
        }

        //
        return [
            'numItem' => $this->getItemNumber(),
            'tipoItem' => $this->getItemTypeCode(),
            'numeroDocumento' => $this->getRelatedDocumentNumber(),
            'cantidad' => $this->getQuantity(),
            'codigo' => $this->getCode(),
            'codTributo' => $this->getTaxCode(),
            'uniMedida' => (int) $this->getUnitOfMeasure()?->getCode(),
            'descripcion' => $this->getDescription(),
            'precioUni' => $this->getUnitPrice(),
            'montoDescu' => $this->getDiscount(),
            'ventaNoSuj' => $this->getSaleNotSubject(),
            'ventaExenta' => $this->getSaleExempt(),
            'ventaGravada' => $this->getSaleTaxed(),
            'tributos' => $taxes,
            'psv' => $this->getSuggestedSalePrice(),
            'noGravado' => $this->getNonTaxable(),
            'ivaItem' => $this->getTaxAmount(),
        ];
    }
}
