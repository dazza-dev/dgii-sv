<?php

namespace DazzaDev\DgiiSv;

use DazzaDev\DgiiJsonGenerator\Enums\Environments;
use DazzaDev\DgiiSv\Exceptions\DocumentException;
use DazzaDev\DgiiSv\Traits\File;
use DazzaDev\DgiiSvSender\Sender;
use DazzaDev\DgiiSvSigner\Signer;

class Client
{
    use File;

    /**
     * Is test environment
     */
    private bool $isTestEnvironment;

    /**
     * Environment
     */
    protected array $environment;

    /**
     * Document instance
     */
    protected ?Document $document = null;

    /**
     * Document type (temporary storage)
     */
    private ?string $documentType = null;

    /**
     * Signed document
     */
    protected string $signedDocument;

    /**
     * Auth Token
     */
    protected ?string $authToken = null;

    /**
     * Certificate
     */
    protected array $certificate;

    /**
     * Signer
     */
    protected ?Signer $signer = null;

    /**
     * Sender
     */
    protected Sender $sender;

    /**
     * Constructor
     */
    public function __construct(bool $test = false)
    {
        $this->isTestEnvironment = $test;

        // Set environment
        if ($this->isTestEnvironment) {
            $this->setEnvironment(Environments::TEST);
        } else {
            $this->setEnvironment(Environments::PRODUCTION);
        }

        // Initialize Sender
        $this->sender = new Sender;

        // Set test mode
        if ($this->isTestEnvironment) {
            $this->sender->setTestMode(true);
        }
    }

    /**
     * Set environment
     */
    protected function setEnvironment(Environments $environment): void
    {
        $this->environment = $environment->toArray();
    }

    /**
     * Get environment
     */
    public function getEnvironment(): array
    {
        return $this->environment;
    }

    /**
     * Is test environment
     */
    protected function isTestEnvironment(): bool
    {
        return $this->environment['code'] == Environments::TEST->value;
    }

    /**
     * Set credentials
     */
    public function setCredentials(array $credentials): void
    {
        $this->sender->setNit($credentials['nit']);

        // Authenticate client
        $this->authToken = $this->sender->auth(
            $credentials['nit'],
            $credentials['password']
        );
    }

    /**
     * Set certificate
     */
    public function setCertificate(array $certificate): void
    {
        $this->certificate = $certificate;

        // Set Signer
        $this->signer = new Signer(
            certificatePath: $this->certificate['path'],
            privatePassword: $this->certificate['password']
        );
    }

    /**
     * Set document type
     */
    public function setDocumentType(string $documentType): void
    {
        $this->documentType = $documentType;
    }

    /**
     * Get document type
     */
    public function getDocumentType(): string
    {
        return $this->documentType;
    }

    /**
     * Get document type Code
     */
    public function getDocumentTypeCode(): string
    {
        return match ($this->documentType) {
            'invoice' => '01',
            'tax-credit-invoice' => '03',
            'delivery-note' => '04',
            'credit-note' => '05',
            'debit-note' => '06',
            'export-invoice' => '11',
            'exempt-taxpayer-invoice' => '14',
            'donation-receipt' => '15',
            default => '',
        };
    }

    /**
     * Set document data
     */
    public function setDocumentData(array $documentData): void
    {
        $this->document = new Document(
            $this->environment['code'],
            $this->documentType,
            $documentData
        );
    }

    /**
     * Get Document
     */
    public function getDocument(): Document
    {
        return $this->document;
    }

    /**
     * Signed document
     */
    public function getSignedDocument(): string
    {
        return $this->signedDocument;
    }

    /**
     * Sign document
     */
    public function signDocument(): string
    {
        if (! $this->document) {
            throw new DocumentException('Documento no establecido. Llama a setDocumentData() primero.');
        }

        if (! $this->signer) {
            throw new DocumentException('Certificado no establecido. Llama a setCertificate() primero.');
        }

        // Validate file path
        $this->validateFilePath();

        // Document JSON
        $jsonString = $this->document->getJson();

        // Sign document
        $this->signedDocument = $this->signer->sign($jsonString);

        // Save signed document
        $this->saveFile(
            $this->getDocumentType(),
            $this->document->getGenerationCode(),
            $this->signedDocument
        );

        return $this->signedDocument;
    }

    /**
     * Send document
     */
    public function sendDocument(): array
    {
        if (! $this->document) {
            throw new DocumentException('Document not set. Call setDocumentData() first.');
        }

        // Sign document
        $this->signDocument();

        // Send document
        $send = $this->sender->send(
            sendId: rand(),
            version: $this->document->getVersion(),
            documentType: $this->document->getDocumentTypeCode(),
            generationCode: $this->document->getGenerationCode(),
            signedJson: $this->signedDocument
        );

        return $send;
    }

    /**
     * Send batch document
     */
    public function sendBatch(string $sendId, string $documentType, array $documents): array
    {
        $this->setDocumentType($documentType);

        $signedJsonDocuments = [];
        foreach ($documents as $document) {
            $this->setDocumentData($document);
            $signedJsonDocuments[] = $this->signDocument();
        }

        // Send batch document
        $send = $this->sender->sendBatch(
            sendId: $sendId,
            version: $this->document->getVersion(),
            signedJsonDocuments: $signedJsonDocuments
        );

        return $send;
    }

    /**
     * Send contingency event
     */
    public function contingencyEvent(): array
    {
        if (! $this->document) {
            throw new DocumentException('Document not set. Call setDocumentData() first.');
        }

        // Sign document
        $this->signDocument();

        // Send document
        $send = $this->sender->contingencyEvent($this->signedDocument);

        return $send;
    }

    /**
     * Invalidate document
     */
    public function invalidateDocument(): array
    {
        if (! $this->document) {
            throw new DocumentException('Document not set. Call setDocumentData() first.');
        }

        // Sign document
        $this->signDocument();

        // Send document
        $send = $this->sender->invalidate(
            sendId: rand(),
            version: $this->document->getVersion(),
            signedJson: $this->signedDocument
        );

        return $send;
    }

    /**
     * Search
     */
    public function search(string $documentType, string $generationCode): array
    {
        $this->setDocumentType($documentType);

        // Search document
        $search = $this->sender->search(
            documentType: $this->getDocumentTypeCode(),
            generationCode: $generationCode
        );

        if (! $search) {
            throw new DocumentException('No se encontró el documento.');
        }

        return $search;
    }

    /**
     * Search batch
     */
    public function searchBatch(string $batchCode): array
    {
        $response = $this->sender->searchBatch(
            batchCode: $batchCode
        );

        if (! $response) {
            throw new DocumentException('No se encontró el lote.');
        }

        return $response;
    }
}
