<?php

namespace DazzaDev\DgiiSv;

use DazzaDev\DgiiJsonGenerator\Factories\DocumentBuilderFactory;

class Document
{
    /**
     * Environment Code
     */
    private string $environmentCode;

    /**
     * Document type
     */
    private string $documentType;

    /**
     * Document data
     */
    private array $documentData;

    /**
     * Document instance
     */
    private mixed $document;

    /**
     * Document JSON
     */
    private string $documentJson;

    /**
     * Constructor
     */
    public function __construct(string $environmentCode, string $documentType, array $documentData)
    {
        $this->setEnvironmentCode($environmentCode);
        $this->setDocumentType($documentType);
        $this->setDocumentData($documentData);
        $this->buildDocument();
    }

    /**
     * Set environment code
     */
    private function setEnvironmentCode(string $environmentCode): void
    {
        $this->environmentCode = $environmentCode;
    }

    /**
     * Set document type
     */
    private function setDocumentType(string $documentType): void
    {
        $this->documentType = $documentType;
    }

    /**
     * Set document data
     */
    private function setDocumentData(array $documentData): void
    {
        $this->documentData = $documentData;
    }

    /**
     * Build document using DocumentBuilderFactory
     */
    private function buildDocument(): void
    {
        $builder = DocumentBuilderFactory::create(
            $this->environmentCode,
            $this->documentType,
            $this->documentData
        );

        $this->document = $builder->getDocument();
        $this->documentJson = $builder->toJson();
    }

    /**
     * Get document type
     */
    public function getDocumentType(): string
    {
        return $this->documentType;
    }

    /**
     * Get document data
     */
    public function getDocumentData(): array
    {
        return $this->documentData;
    }

    /**
     * Get document instance
     */
    public function getDocument(): mixed
    {
        return $this->document;
    }

    /**
     * Get document JSON
     */
    public function getJson(): string
    {
        return $this->documentJson;
    }

    /**
     * Get version
     */
    public function getVersion(): int
    {
        return $this->document->getVersion();
    }

    /**
     * Get document type code
     */
    public function getDocumentTypeCode(): string
    {
        return $this->document->getDocumentType()->getCode();
    }

    /**
     * Get generation code
     */
    public function getGenerationCode(): string
    {
        return $this->document->getGenerationCode();
    }

    /**
     * Get control number
     */
    public function getControlNumber(): string
    {
        return $this->document->getControlNumber();
    }

    /**
     * Get sequential number
     */
    public function getSequentialNumber(): string
    {
        return $this->document->getSequentialNumber();
    }
}
