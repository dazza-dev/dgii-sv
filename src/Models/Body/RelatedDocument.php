<?php

namespace DazzaDev\DgiiSv\Models\Body;

use DazzaDev\DgiiSv\DataLoader;
use DazzaDev\DgiiSv\Models\Base\GenerationType;
use DazzaDev\DgiiSv\Traits\DocumentTypeTrait;

class RelatedDocument
{
    use DocumentTypeTrait;

    /**
     * Generation type
     */
    private ?GenerationType $generationType = null;

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

        if (isset($data['generation_type'])) {
            $this->setGenerationType($data['generation_type']);
        }

        if (isset($data['document_number'])) {
            $this->setDocumentNumber($data['document_number']);
        }

        if (isset($data['issue_date'])) {
            $this->setIssueDate($data['issue_date']);
        }
    }

    /**
     * Get generation type
     */
    public function getGenerationType(): ?GenerationType
    {
        return $this->generationType;
    }

    /**
     * Get generation type code
     */
    public function getGenerationTypeCode(): ?int
    {
        $code = $this->generationType?->getCode();

        return $code ? (int) $code : null;
    }

    /**
     * Set generation type
     */
    public function setGenerationType(int|string $generationTypeCode): void
    {
        $generationType = (new DataLoader('tipos-generacion-documento'))->getByCode($generationTypeCode);

        $this->generationType = new GenerationType($generationType);
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
            'tipoGeneracion' => $this->getGenerationTypeCode(),
            'numeroDocumento' => $this->getDocumentNumber(),
            'fechaEmision' => $this->getIssueDate(),
        ];
    }
}
