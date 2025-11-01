<?php

namespace DazzaDev\DgiiSv\Models\Invalidation;

use DazzaDev\DgiiSv\DataLoader;
use DazzaDev\DgiiSv\Models\Base\DTEModel;
use DazzaDev\DgiiSv\Traits\IssuerTrait;
use DazzaDev\DgiiSv\Traits\JsonTrait;
use DazzaDev\DgiiSv\Traits\RequesterTrait;
use DazzaDev\DgiiSv\Traits\ResponsibleTrait;

class Invalidation extends DTEModel
{
    use IssuerTrait;
    use JsonTrait;
    use RequesterTrait;
    use ResponsibleTrait;

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

        if (isset($data['type'])) {
            $this->setInvalidationType($data['type']);
        }

        if (isset($data['reason'])) {
            $this->setInvalidationReason($data['reason']);
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
        $issuer = $this->getIssuer();

        return [
            'nit' => $issuer->getNit(),
            'nombre' => $issuer->getLegalName(),
            'tipoEstablecimiento' => $issuer->getEstablishment()?->getType()?->getCode(),
            'nomEstablecimiento' => $issuer->getEstablishment()?->getName(),
            'codEstableMH' => $issuer->getEstablishment()?->getInternalCode(),
            'codEstable' => $issuer->getEstablishment()?->getCode(),
            'codPuntoVentaMH' => $issuer->getSalePoint()?->getInternalCode(),
            'codPuntoVenta' => $issuer->getSalePoint()?->getCode(),
            'telefono' => $issuer->getPhone(),
            'correo' => $issuer->getEmail(),
        ];
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        $requester = $this->getRequester();
        $responsible = $this->getResponsible();

        //
        return [
            'identificacion' => array_merge(parent::toArray(), [
                'fecAnula' => $this->getIssueDate(),
                'horAnula' => $this->getIssueTime(),
            ]),
            'emisor' => $this->getInvalidationIssuer(),
            'motivo' => [
                'tipoAnulacion' => $this->getInvalidationCode(),
                'motivoAnulacion' => $this->getCustomInvalidationReason(),
                'nombreResponsable' => $responsible->getName(),
                'tipDocResponsable' => $responsible->getIdentificationType()?->getCode(),
                'numDocResponsable' => $responsible->getIdentificationNumber(),
                'nombreSolicita' => $requester->getName(),
                'tipDocSolicita' => $requester->getIdentificationType()?->getCode(),
                'numDocSolicita' => $requester->getIdentificationNumber(),
            ],
        ];
    }
}
