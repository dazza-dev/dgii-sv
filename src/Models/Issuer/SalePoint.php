<?php

namespace DazzaDev\DgiiSv\Models\Issuer;

class SalePoint
{
    /**
     * Code MH of the sale point
     */
    private ?string $code = null;

    /**
     * Internal code of the sale point (codPuntoVenta)
     */
    private ?string $internalCode = null;

    /**
     * Sale Point Constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize sale point data
     */
    protected function initialize(array $data): void
    {
        if (empty($data)) {
            return;
        }

        if (isset($data['code'])) {
            $this->setCode($data['code']);
        }

        if (isset($data['internal_code'])) {
            $this->setInternalCode($data['internal_code']);
        }
    }

    /**
     * Get code MH of the sale point
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * Set code MH of the sale point
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * Get internal code of the sale point
     */
    public function getInternalCode(): ?string
    {
        return $this->internalCode;
    }

    /**
     * Set internal code of the sale point
     */
    public function setInternalCode(string $internalCode): void
    {
        $this->internalCode = $internalCode;
    }

    /**
     * Array representation with DGII keys
     */
    public function toArray(): array
    {
        return [
            'codPuntoVentaMH' => $this->getCode(),
            'codPuntoVenta' => $this->getInternalCode(),
        ];
    }
}
