<?php

namespace DazzaDev\DgiiSv\Models;

use DazzaDev\DgiiSv\Models\Base\Document;
use DazzaDev\DgiiSv\Traits\JsonTrait;

class CreditNote extends Document
{
    use JsonTrait;

    /**
     * CreditNote constructor
     */
    public function __construct(array $data = [])
    {
        $this->setDocumentType('05');
        $this->setVersion(3);

        // Initialize credit note data
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
