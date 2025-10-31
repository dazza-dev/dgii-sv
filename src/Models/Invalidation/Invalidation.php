<?php

namespace DazzaDev\DgiiSv\Models\Invalidation;

use DazzaDev\CarvajalXmlGenerator\DataLoader;
use DazzaDev\DgiiSv\Models\Base\DTEModel;
use DazzaDev\DgiiSv\Traits\IssuerTrait;

class Invalidation extends DTEModel
{
    use IssuerTrait;

    /**
     * Invalidation type
     */
    private ?InvalidationType $invalidationType = null;

    /**
     * Invalidation reason
     */
    private ?string $invalidationReason = null;

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
     * Get invalidation type
     */
    public function getInvalidationType(): ?InvalidationType
    {
        return $this->invalidationType;
    }

    /**
     * Set invalidation type
     */
    public function setInvalidationType(string|int $invalidationTypeCode): void
    {
        $invalidationType = (new DataLoader('tipos-invalidacion'))->getByCode($invalidationTypeCode);

        $this->invalidationType = new InvalidationType($invalidationType);
    }

    /**
     * Get invalidation code
     */
    public function getInvalidationCode(): ?int
    {
        $code = $this->getInvalidationType()?->getCode();

        return $code ? (int) $code : null;
    }

    /**
     * Set contingency reason
     */
    public function setInvalidationReason(string $invalidationReason): void
    {
        $this->invalidationReason = $invalidationReason;
    }

    /**
     * Get invalidation reason
     */
    public function getInvalidationReason(): ?string
    {
        return $this->invalidationReason;
    }

    /**
     * Get custom invalidation reason
     */
    public function getCustomInvalidationReason(): ?string
    {
        return $this->getInvalidationReason()
            ?? $this->getInvalidationType()?->getName();
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
                'tipoAnulacion' => $this->getInvalidationCode(),
                'motivoAnulacion' => $this->getCustomInvalidationReason(),
            ],
        ];
    }
}
