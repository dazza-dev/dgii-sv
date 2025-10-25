<?php

namespace DazzaDev\DgiiSv\Models\Body;

use DazzaDev\DgiiSv\Traits\DocumentTypeTrait;

class OtherDocument
{
    use DocumentTypeTrait;

    /**
     * Document number
     */
    private ?string $documentNumber = null;

    /**
     * Document detail
     */
    private ?string $detail = null;

    /**
     * Constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize other document data
     */
    private function initialize(array $data): void
    {

        if (isset($data['document_type'])) {
            $this->setDocumentType($data['document_type']);
        }

        if (array_key_exists('document_number', $data)) {
            $this->setDocumentNumber($data['document_number']);
        }

        if (array_key_exists('detail', $data)) {
            $this->setDetail($data['detail']);
        }
    }

    /**
     * Get document number
     */
    public function getDocumentNumber(): ?string
    {
        return $this->documentNumber;
    }

    /**
     * Set document number
     */
    public function setDocumentNumber(string $number): void
    {
        $this->documentNumber = $number;
    }

    /**
     * Get document detail
     */
    public function getDetail(): ?string
    {
        return $this->detail;
    }

    /**
     * Set document detail
     */
    public function setDetail(?string $detail): void
    {
        $this->detail = $detail;
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return [
            'codDocAsociado' => $this->getDocumentType()->getCode(),
            'descDocumento' => $this->getDocumentNumber(),
            'detalleDocumento' => $this->getDetail(),
        ];
    }
}
