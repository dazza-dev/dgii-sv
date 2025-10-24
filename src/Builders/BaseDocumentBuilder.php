<?php

namespace DazzaDev\DgiiSv\Builders;

use DazzaDev\DgiiSv\Enums\Environments;
use DazzaDev\DgiiSv\Models\CreditNote;
use DazzaDev\DgiiSv\Models\Customer;
use DazzaDev\DgiiSv\Models\DebitNote;
use DazzaDev\DgiiSv\Models\DeliveryGuide;
use DazzaDev\DgiiSv\Models\Document;
use DazzaDev\DgiiSv\Models\Invoice;
use DazzaDev\DgiiSv\Models\Issuer;
use DazzaDev\DgiiSv\Models\Receiver;
use DazzaDev\DgiiSv\Models\WithholdingReceipt;
use InvalidArgumentException;

abstract class BaseDocumentBuilder
{
    protected int $environmentCode;

    protected array $documentData;

    protected string $accessKey;

    protected Document $document;

    public function __construct(int $environmentCode, array $documentData)
    {
        $this->environmentCode = $environmentCode;
        $this->documentData = $documentData;

        // Validate required data
        $this->validateRequiredData();

        // Initialize document (implemented by child classes)
        $this->document = $this->createDocument();

        // Set document properties
        $this->setDocumentProperties();

        // Set customer
        $this->setCustomer();

        // Set company
        $this->setCompany();
    }

    /**
     * Create document instance (must be implemented by child classes)
     */
    abstract protected function createDocument(): Invoice|CreditNote|DebitNote|DeliveryGuide|WithholdingReceipt;

    /**
     * Get document type for XML generation (must be implemented by child classes)
     */
    abstract protected function getDocumentType(): string;

    /**
     * Get additional required fields specific to document type
     */
    protected function getAdditionalRequiredFields(): array
    {
        return [];
    }

    /**
     * Get document
     */
    public function getDocument(): Document
    {
        return $this->document;
    }

    /**
     * Get document number
     */
    public function getDocumentNumber(): string
    {
        return $this->document->getDocumentNumber();
    }

    /**
     * Validate required data
     */
    protected function validateRequiredData(): void
    {
        $baseRequiredFields = [
            'date',
            'sequential',
            'company',
            'customer',
        ];

        // Merge with document-specific required fields
        $requiredFields = array_merge($baseRequiredFields, $this->getAdditionalRequiredFields());

        foreach ($requiredFields as $field) {
            if (! isset($this->documentData[$field])) {
                throw new InvalidArgumentException("Missing required field: {$field}");
            }
        }
    }

    /**
     * Set document properties
     */
    protected function setDocumentProperties(): void
    {
        // Set date
        $this->document->setDate($this->documentData['date']);

        // Set environment
        $this->document->setEnvironment(Environments::from($this->environmentCode));

        // Set sequential
        $this->document->setSequential($this->documentData['sequential']);

        // Establishment
        $establishment = new Establishment($this->documentData['establishment']);
        $this->document->setEstablishment($establishment);

        // Emission Point
        $emissionPoint = new EmissionPoint($this->documentData['emission_point']);
        $this->document->setEmissionPoint($emissionPoint);
    }

    /**
     * Set company
     */
    protected function setCompany(): void
    {
        $companyData = $this->documentData['company'];
        $company = new Issuer($companyData);
        $this->document->setCompany($company);
    }

    /**
     * Set customer
     */
    protected function setCustomer(): void
    {
        $customerData = $this->documentData['customer'];
        $customer = new Receiver($customerData);
        $this->document->setCustomer($customer);
    }
}
