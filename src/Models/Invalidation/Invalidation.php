<?php

namespace DazzaDev\DgiiSv\Models\Invalidation;

use DateTime;
use DazzaDev\DgiiSv\DateValidator;
use DazzaDev\DgiiSv\Models\Base\DTEModel;
use DazzaDev\DgiiSv\Traits\IssuerTrait;

class Invalidation extends DTEModel
{
    use IssuerTrait;

    /**
     * Contingency start date
     */
    private ?string $startDate = null;

    /**
     * Contingency start time
     */
    private ?string $startTime = null;

    /**
     * Contingency end date
     */
    private ?string $endDate = null;

    /**
     * Contingency end time
     */
    private ?string $endTime = null;

    /**
     * Contingency items
     */
    private array $contingencyItems = [];

    /**
     * Contingency constructor
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->setVersion(2);
        $this->initialize($data);
    }

    /**
     * Set contingency fields
     */
    public function initialize(array $data): void
    {
        if (empty($data)) {
            return;
        }

        if (isset($data['start_date'])) {
            $this->setStartDate($data['start_date']);
        }

        if (isset($data['type'])) {
            $this->setContingencyType($data['type']);
        }

        if (isset($data['reason'])) {
            $this->setContingencyReason($data['reason']);
        }
    }

    /**
     * Set start date
     */
    public function setStartDate(string|DateTime $date): void
    {
        $dateValidator = new DateValidator;

        $this->startDate = $dateValidator->getDate($date);
        $this->startTime = $dateValidator->getTime($date);
    }

    /**
     * Get start date
     */
    public function getStartDate(): ?string
    {
        return $this->startDate;
    }

    /**
     * Get start time
     */
    public function getStartTime(): ?string
    {
        return $this->startTime;
    }

    /**
     * Set contingency items
     */
    public function setContingencyItems(array $contingencyItems): void
    {
        $this->contingencyItems = [];
        foreach ($contingencyItems as $i => $item) {
            $this->contingencyItems[] = new ContingencyItem([
                'item_number' => $i + 1,
                'document_type' => $item['document_type'],
                'generation_code' => $item['generation_code'],
            ]);
        }
    }

    /**
     * Get contingency items
     */
    public function getContingencyItems(): array
    {
        return $this->contingencyItems;
    }

    /**
     * Get contingency issuer
     */
    public function getContingencyIssuer(): array
    {
        $issuer = $this->getIssuer()->toArray();

        return [
            'nit' => $issuer['nit'],
            'nombre' => $issuer['nombre'],
            'nombreResponsable' => $issuer['nombreResponsable'],
            'tipoDocResponsable' => $issuer['tipoDocResponsable'],
            'numeroDocResponsable' => $issuer['numeroDocResponsable'],
            'tipoEstablecimiento' => $issuer['tipoEstablecimiento'],
            'codEstableMH' => $issuer['codEstableMH'],
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
                'fTransmision' => $this->getIssueDate(),
                'hTransmision' => $this->getIssueTime(),
            ]),
            'emisor' => $this->getContingencyIssuer(),
            'detalleDTE' => array_map(function (ContingencyItem $item) {
                return $item->toArray();
            }, $this->getContingencyItems()),
            'motivo' => [
                'fecAnula' => $this->getIssueDate(),
                'horAnula' => $this->getIssueTime(),
                'hInicio' => $this->getStartTime(),
                'hFin' => $this->getEndTime(),
                'tipoContingencia' => $this->getContingencyTypeCode(),
                'motivoContingencia' => $this->getCustomReason(),
            ],
        ];
    }
}
