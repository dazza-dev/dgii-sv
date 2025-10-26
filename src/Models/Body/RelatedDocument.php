<?php

namespace DazzaDev\DgiiSv\Models\Body;

use DazzaDev\DgiiSv\Traits\DocumentTypeTrait;

class RelatedDocument
{
    use DocumentTypeTrait;

    /**
     * Generation code
     */
    private ?string $generationCode = null;

    /**
     * Document number
     */
    private ?string $documentNumber = null;

    /**
     * Issue date
     */
    private ?string $issueDate = null;

    /**
     * Constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize related document data
     */
    public function initialize(array $data = []): void
    {
        if (isset($data['document_type'])) {
            $this->setDocumentType($data['document_type']);
        }

        if (isset($data['generation_code'])) {
            $this->setGenerationCode($data['generation_code']);
        }

        if (isset($data['document_number'])) {
            $this->setDocumentNumber($data['document_number']);
        }

        if (isset($data['issue_date'])) {
            $this->setIssueDate($data['issue_date']);
        }
    }

    /**
     * Get generation code
     */
    public function getGenerationCode(): ?string
    {
        return $this->generationCode;
    }

    /**
     * Set generation code
     */
    public function setGenerationCode(?string $generationCode): void
    {
        $this->generationCode = $generationCode;
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
    public function setDocumentNumber(?string $documentNumber): void
    {
        $this->documentNumber = $documentNumber;
    }

    /**
     * Get issue date
     */
    public function getIssueDate(): ?string
    {
        return $this->issueDate;
    }

    /**
     * Set issue date
     */
    public function setIssueDate(?string $issueDate): void
    {
        $this->issueDate = $issueDate;
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return [
            'tipoDocumento' => $this->getDocumentType()?->getCode(),
            'codigoGeneracion' => $this->getGenerationCode(),
            'numDocumento' => $this->getDocumentNumber(),
            'fechaEmision' => $this->getIssueDate(),
        ];
    }
}
