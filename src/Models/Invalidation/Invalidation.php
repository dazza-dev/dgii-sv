<?php

namespace DazzaDev\DgiiSv\Models\Invalidation;

use DazzaDev\DgiiSv\Models\Base\DTEModel;
use DazzaDev\DgiiSv\Traits\IssuerTrait;

class Invalidation extends DTEModel
{
    use IssuerTrait;

    /**
     * Invalidation constructor
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->setVersion(2);
        $this->initialize($data);
    }

    /**
     * Set invalidation fields
     */
    public function initialize(array $data): void
    {
        if (empty($data)) {
            return;
        }
    }

    /**
     * Get invalidation issuer
     */
    public function getInvalidationIssuer(): array
    {
        $issuer = $this->getIssuer()->toArray();

        return [
            'nit' => $issuer['nit'],
            'nombre' => $issuer['nombre'],
            'tipoEstablecimiento' => $issuer['tipoEstablecimiento'],
            'nomEstablecimiento' => $issuer['nomEstablecimiento'],
            'codEstableMH' => $issuer['codEstableMH'],
            'codEstable' => $issuer['codEstable'],
            'codPuntoVentaMH' => $issuer['codPuntoVentaMH'],
            'codPuntoVenta' => $issuer['codPuntoVenta'],
            'telefono' => $issuer['telefono'],
            'correo' => $issuer['correo'],
        ];
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return [
            'identificacion' => array_merge(parent::toArray(), [
                'fecAnula' => $this->getIssueDate(),
                'horAnula' => $this->getIssueTime(),
            ]),
            'emisor' => $this->getInvalidationIssuer(),
            'motivo' => [
                'tipoAnulacion' => $this->getInvalidationTypeCode(),
                'motivoAnulacion' => $this->getInvalidationReason(),
            ],
        ];
    }
}
