<?php

namespace DazzaDev\DgiiSv\Factories;

use DazzaDev\DgiiSv\Builders\BaseDocumentBuilder;
use DazzaDev\DgiiSv\Builders\CreditNoteBuilder;
use DazzaDev\DgiiSv\Builders\DebitNoteBuilder;
use DazzaDev\DgiiSv\Builders\DeliveryGuideBuilder;
use DazzaDev\DgiiSv\Builders\InvoiceBuilder;
use DazzaDev\DgiiSv\Builders\WithholdingReceiptBuilder;
use InvalidArgumentException;

class DocumentBuilderFactory
{
    public const INVOICE = 'invoice';

    public const CREDIT_NOTE = 'credit-note';

    public const DEBIT_NOTE = 'debit-note';

    public const DELIVERY_GUIDE = 'delivery-guide';

    public const WITHHOLDING_RECEIPT = 'withholding-receipt';

    /**
     * Create a document builder based on document type name
     */
    public static function create(int $environmentCode, string $documentType, array $documentData): BaseDocumentBuilder
    {
        return match ($documentType) {
            self::INVOICE => new InvoiceBuilder($environmentCode, $documentData),
            self::CREDIT_NOTE => new CreditNoteBuilder($environmentCode, $documentData),
            self::DEBIT_NOTE => new DebitNoteBuilder($environmentCode, $documentData),
            self::DELIVERY_GUIDE => new DeliveryGuideBuilder($environmentCode, $documentData),
            self::WITHHOLDING_RECEIPT => new WithholdingReceiptBuilder($environmentCode, $documentData),
            default => throw new InvalidArgumentException("Unsupported document type: {$documentType}")
        };
    }

    /**
     * Create an invoice builder
     */
    public static function createInvoice(int $environmentCode, array $documentData): InvoiceBuilder
    {
        return new InvoiceBuilder($environmentCode, $documentData);
    }

    /**
     * Create a credit note builder
     */
    public static function createCreditNote(int $environmentCode, array $documentData): CreditNoteBuilder
    {
        return new CreditNoteBuilder($environmentCode, $documentData);
    }

    /**
     * Create a debit note builder
     */
    public static function createDebitNote(int $environmentCode, array $documentData): DebitNoteBuilder
    {
        return new DebitNoteBuilder($environmentCode, $documentData);
    }

    /**
     * Create a delivery guide builder
     */
    public static function createDeliveryGuide(int $environmentCode, array $documentData): DeliveryGuideBuilder
    {
        return new DeliveryGuideBuilder($environmentCode, $documentData);
    }

    /**
     * Create a withholding receipt builder
     */
    public static function createWithholdingReceipt(int $environmentCode, array $documentData): WithholdingReceiptBuilder
    {
        return new WithholdingReceiptBuilder($environmentCode, $documentData);
    }
}
