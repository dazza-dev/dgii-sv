<?php

namespace DazzaDev\DgiiSv\Models;

use DazzaDev\DgiiSv\Models\Base\Document;
use DazzaDev\DgiiSv\Traits\JsonTrait;

class ExportInvoice extends Document
{
    use JsonTrait;

    /**
     * ExportInvoice constructor
     */
    public function __construct(array $data = [])
    {
        $this->setDocumentType('11');
        $this->setVersion(1);

        // Initialize export invoice data
        parent::__construct($data);
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        $document = parent::toArray();

        return $document;
    }
}
