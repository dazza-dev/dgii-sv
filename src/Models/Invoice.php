<?php

namespace DazzaDev\DgiiSv\Models;

use DazzaDev\DgiiSv\Models\Base\Document;

class Invoice extends Document
{
    /**
     * Invoice constructor
     */
    public function __construct(array $data = [])
    {
        $this->setDocumentType('01');
        $this->setVersion(1);

        // Initialize invoice data
        parent::__construct($data);
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return parent::toArray();
    }
}
