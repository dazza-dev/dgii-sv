<?php

namespace DazzaDev\DgiiSv\Models\Contingency;

use DazzaDev\DgiiSv\Traits\DocumentTypeTrait;

class ContingencyItem
{
    use DocumentTypeTrait;

    /**
     * Item number
     */
    private int $itemNumber = 1;

    /**
     * Generation code
     */
    private string $generationCode;

    /**
     * Contingency item constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize model data
     */
    protected function initialize(array $data): void
    {
        if (empty($data)) {
            return;
        }

        if (isset($data['item_number'])) {
            $this->setItemNumber($data['item_number']);
        }

        if (isset($data['document_type'])) {
            $this->setDocumentType($data['document_type']);
        }

        if (isset($data['generation_code'])) {
            $this->setGenerationCode($data['generation_code']);
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
     * Set generation code
     */
    public function setGenerationCode(string $generationCode): void
    {
        $this->generationCode = $generationCode;
    }

    /**
     * Get generation code
     */
    public function getGenerationCode(): string
    {
        return $this->generationCode;
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return [
            'noItem' => $this->getItemNumber(),
            'codigoGeneracion' => $this->getGenerationCode(),
            'tipoDoc' => $this->getDocumentType()->getCode(),
        ];
    }
}
