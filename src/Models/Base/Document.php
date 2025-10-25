<?php

namespace DazzaDev\DgiiSv\Models\Base;

use DazzaDev\DgiiSv\Models\Body\AdditionalInfo;
use DazzaDev\DgiiSv\Models\Body\RelatedDocument;
use DazzaDev\DgiiSv\Traits\DocumentTypeTrait;
use DazzaDev\DgiiSv\Traits\IssuerTrait;
use DazzaDev\DgiiSv\Traits\ReceiverTrait;

class Document extends DTEModel
{
    use DocumentTypeTrait;
    use IssuerTrait;
    use ReceiverTrait;

    /**
     * Currency
     */
    private string $currency = 'USD';

    /**
     * Additional information
     *
     * @var AdditionalInfo[]
     */
    private array $additionalInfo = [];

    /**
     * Related document (documentoRelacionado)
     */
    private ?RelatedDocument $relatedDocument = null;

    /**
     * Document constructor
     *
     * @param  array  $data  DTE data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->initialize($data);
    }

    /**
     * Initialize document
     */
    private function initialize(array $data): void
    {
        if (empty($data)) {
            return;
        }

        if (isset($data['document_type'])) {
            $this->setDocumentType($data['document_type']);
        }

        if (isset($data['currency'])) {
            $this->setCurrency($data['currency']);
        }

        if (isset($data['issuer'])) {
            $this->setIssuer($data['issuer']);
        }

        if (isset($data['receiver'])) {
            $this->setReceiver($data['receiver']);
        }

        // Additional info
        if (isset($data['additional_info'])) {
            $this->setAdditionalInfo($data['additional_info']);
        }

        // Related document
        if (isset($data['related_document'])) {
            $this->setRelatedDocument($data['related_document']);
        }
    }

    /**
     * Get currency
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * Set currency
     */
    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * Get additional info
     *
     * @return AdditionalInfo[]
     */
    public function getAdditionalInfo(): array
    {
        return $this->additionalInfo;
    }

    /**
     * Set additional info
     */
    public function setAdditionalInfo(array $additionalInfo): void
    {
        $this->additionalInfo = [];
        foreach ($additionalInfo as $info) {
            $this->addAdditionalInfo($info);
        }
    }

    /**
     * Add additional info item
     */
    public function addAdditionalInfo(array|AdditionalInfo $info): void
    {
        $this->additionalInfo[] = $info instanceof AdditionalInfo ? $info : new AdditionalInfo($info);
    }

    /**
     * Get related document
     */
    public function getRelatedDocument(): ?RelatedDocument
    {
        return $this->relatedDocument;
    }

    /**
     * Set related document
     */
    public function setRelatedDocument(array|RelatedDocument $relatedDocument): void
    {
        $this->relatedDocument = $relatedDocument instanceof RelatedDocument ? $relatedDocument : new RelatedDocument($relatedDocument);
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        $identification = array_merge(parent::toArray(), [
            'tipoDte' => $this->getDocumentType()->getCode(),
            'fecEmi' => $this->getIssueDate(),
            'horEmi' => $this->getIssueTime(),
            'tipoMoneda' => $this->getCurrency(),
        ]);

        $document = [
            'identificacion' => $identification,
            'emisor' => $this->getIssuer()?->toArray(),
            'receptor' => $this->getReceiver()?->toArray(),
            'documentoRelacionado' => $this->getRelatedDocument()?->toArray(),
        ];

        // Appendices
        if (! empty($this->getAdditionalInfo())) {
            $document['apendice'] = array_map(fn (AdditionalInfo $info) => $info->toArray(), $this->getAdditionalInfo());
        }

        return $document;
    }
}
