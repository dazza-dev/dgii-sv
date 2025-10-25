<?php

namespace DazzaDev\DgiiSv\Models\Base;

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

        return [
            'identificacion' => $identification,
            'emisor' => $this->getIssuer()?->toArray(),
            'receptor' => $this->getReceiver()?->toArray(),
        ];
    }
}
