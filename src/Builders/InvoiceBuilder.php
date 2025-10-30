<?php

namespace DazzaDev\DgiiSv\Builders;

use DazzaDev\DgiiSv\Models\Invoice;

class InvoiceBuilder extends BaseDocumentBuilder
{
    /**
     * Create document instance
     */
    protected function createDocument(): Invoice
    {
        return new Invoice($this->documentData);
    }

    /**
     * Get document type for XML generation
     */
    protected function getDocumentType(): string
    {
        return 'invoice';
    }

    /**
     * Get invoice (alias for getDocument with proper return type)
     */
    public function getInvoice(): Invoice
    {
        return $this->document;
    }
}
