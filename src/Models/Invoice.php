<?php

namespace DazzaDev\DgiiSv\Models;

use DazzaDev\DgiiSv\Models\Base\Document;
use DazzaDev\DgiiSv\Traits\JsonTrait;

class Invoice extends Document
{
    use JsonTrait;

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
