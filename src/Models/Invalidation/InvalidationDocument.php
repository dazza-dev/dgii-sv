<?php

namespace DazzaDev\DgiiSv\Models\Invalidation;

use DazzaDev\DgiiSv\Traits\DocumentTypeTrait;
use DazzaDev\DgiiSv\Traits\JsonTrait;
use DazzaDev\DgiiSv\Traits\ReceiverTrait;

class InvalidationDocument
{
    use DocumentTypeTrait;
    use JsonTrait;
    use ReceiverTrait;

    /**
     * Generation Code
     */
    private ?string $generationCode = null;

    /**
     * Replaced Generation Code
     */
    private ?string $replacedGenerationCode = null;

    /**
     * Received Signature
     */
    private ?string $receivedSignature = null;

    /**
     * Control Number
     */
    private ?string $controlNumber = null;

    /**
     * Emission Date
     */
    private ?string $emissionDate = null;

    /**
     * Tax Amount
     */
    private ?float $taxAmount = null;

    /**
     * Invalidation Document constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Set invalidation document fields
     */
    public function initialize(array $data): void
    {
        if (empty($data)) {
            return;
        }

        if (isset($data['document_type'])) {
            $this->setDocumentType($data['document_type']);
        }

        if (isset($data['generation_code'])) {
            $this->setGenerationCode($data['generation_code']);
        }

        if (isset($data['replaced_generation_code'])) {
            $this->setReplacedGenerationCode($data['replaced_generation_code']);
        }

        if (isset($data['received_signature'])) {
            $this->setReceivedSignature($data['received_signature']);
        }

        if (isset($data['control_number'])) {
            $this->setControlNumber($data['control_number']);
        }

        if (isset($data['emission_date'])) {
            $this->setEmissionDate($data['emission_date']);
        }

        if (isset($data['tax_amount'])) {
            $this->setTaxAmount($data['tax_amount']);
        }

        if (isset($data['receiver'])) {
            $this->setReceiver($data['receiver']);
        }
    }

    /**
     * Set generation code
     */
    public function setGenerationCode(string $generationCode): void
    {
        $this->generationCode = $generationCode;
    }

    /**
     * Get Generation Code
     */
    public function getGenerationCode(): ?string
    {
        return $this->generationCode;
    }

    /**
     * Set received signature
     */
    public function setReceivedSignature(string $receivedSignature): void
    {
        $this->receivedSignature = $receivedSignature;
    }

    /**
     * Get Received Signature
     */
    public function getReceivedSignature(): ?string
    {
        return $this->receivedSignature;
    }

    /**
     * Set control number
     */
    public function setControlNumber(string $controlNumber): void
    {
        $this->controlNumber = $controlNumber;
    }

    /**
     * Get Control Number
     */
    public function getControlNumber(): ?string
    {
        return $this->controlNumber;
    }

    /**
     * Set emission date
     */
    public function setEmissionDate(string $emissionDate): void
    {
        $this->emissionDate = $emissionDate;
    }

    /**
     * Get Emission Date
     */
    public function getEmissionDate(): ?string
    {
        return $this->emissionDate;
    }

    /**
     * Set tax amount
     */
    public function setTaxAmount(float $taxAmount): void
    {
        $this->taxAmount = $taxAmount;
    }

    /**
     * Get Tax Amount
     */
    public function getTaxAmount(): ?float
    {
        return $this->taxAmount;
    }

    /**
     * Set replaced generation code
     */
    public function setReplacedGenerationCode(string $replacedGenerationCode): void
    {
        $this->replacedGenerationCode = $replacedGenerationCode;
    }

    /**
     * Get Replaced Generation Code
     */
    public function getReplacedGenerationCode(): ?string
    {
        return $this->replacedGenerationCode;
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        $receiver = $this->getReceiver();

        return [
            'tipoDte' => $this->getDocumentType()?->getCode(),
            'codigoGeneracion' => $this->getGenerationCode(),
            'selloRecibido' => $this->getReceivedSignature(),
            'numeroControl' => $this->getControlNumber(),
            'fecEmi' => $this->getEmissionDate(),
            'montoIva' => $this->getTaxAmount(),
            'codigoGeneracionR' => $this->getReplacedGenerationCode(),
            'tipoDocumento' => $receiver->getIdentificationType()?->getCode(),
            'numDocumento' => $receiver->getIdentificationNumber(),
            'nombre' => $receiver->getName(),
            'telefono' => $receiver->getPhone(),
            'correo' => $receiver->getEmail(),
        ];
    }
}
