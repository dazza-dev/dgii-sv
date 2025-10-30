<?php

namespace DazzaDev\DgiiSv\Models\Issuer;

use DazzaDev\DgiiSv\DataLoader;

class Establishment
{
    /**
     * Establishment Type
     */
    private ?EstablishmentType $type = null;

    /**
     * Establishment Code
     */
    private ?string $code = null;

    /**
     * Internal Code
     */
    private ?string $internalCode = null;

    /**
     * Establishment Constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize model data
     */
    protected function initialize(array $data): void
    {
        if (empty($data)) {
            return;
        }

        if (isset($data['type'])) {
            $this->setType($data['type']);
        }

        if (isset($data['code'])) {
            $this->setCode($data['code']);
        }

        if (isset($data['internal_code'])) {
            $this->setInternalCode($data['internal_code']);
        }
    }

    /**
     * Get Establishment Type
     */
    public function getType(): ?EstablishmentType
    {
        return $this->type;
    }

    /**
     * Set Establishment Type
     */
    public function setType(string $typeCode): void
    {
        $type = (new DataLoader('tipos-establecimiento'))->getByCode($typeCode);

        $this->type = new EstablishmentType($type);
    }

    /**
     * Get Establishment Code
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * Set Establishment Code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * Get Internal Code
     */
    public function getInternalCode(): ?string
    {
        return $this->internalCode;
    }

    /**
     * Set Internal Code
     */
    public function setInternalCode(string $internalCode): void
    {
        $this->internalCode = $internalCode;
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        $data = [
            'codEstableMH' => $this->getCode(),
            'codEstable' => $this->getInternalCode(),
        ];

        // Add Establishment Type if available
        if ($this->getType()) {
            $data['tipoEstablecimiento'] = $this->getType()->getCode();
        }

        return $data;
    }
}
