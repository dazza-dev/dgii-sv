<?php

namespace DazzaDev\DgiiSv\Models\Body\OtherDocument;

use DazzaDev\DgiiSv\DataLoader;

class OtherDocument
{
    /**
     * Document Type
     */
    private ?OtherDocumentType $documentType = null;

    /**
     * Document description
     */
    private ?string $description = null;

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
        if (empty($data)) {
            return;
        }

        if (isset($data['document_type'])) {
            $this->setDocumentType($data['document_type']);
        }

        if (isset($data['description'])) {
            $this->setDescription($data['description']);
        }

        if (isset($data['detail'])) {
            $this->setDetail($data['detail']);
        }
    }

    /**
     * Get document type
     */
    public function getDocumentType(): OtherDocumentType
    {
        return $this->documentType;
    }

    /**
     * Set document type
     */
    public function setDocumentType(string $documentTypeCode): void
    {
        $documentType = (new DataLoader('otros-documentos-asociados'))->getByCode($documentTypeCode);

        $this->documentType = new OtherDocumentType($documentType);
    }

    /**
     * Get document number
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set document number
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
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
            'descDocumento' => $this->getDescription(),
            'detalleDocumento' => $this->getDetail(),
        ];
    }
}
