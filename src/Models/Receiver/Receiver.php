<?php

namespace DazzaDev\DgiiSv\Models\Receiver;

use DazzaDev\DgiiSv\DataLoader;
use DazzaDev\DgiiSv\Models\Base\Activity;
use DazzaDev\DgiiSv\Models\Base\IdentificationType;
use DazzaDev\DgiiSv\Models\Geography\Address;
use DazzaDev\DgiiSv\Traits\ActivityTrait;
use DazzaDev\DgiiSv\Traits\EntityTrait;
use DazzaDev\DgiiSv\Traits\IdentificationNumberTrait;
use DazzaDev\DgiiSv\Traits\NameTrait;

class Receiver
{
    use ActivityTrait;
    use EntityTrait;
    use IdentificationNumberTrait;
    use NameTrait;

    /**
     * Identification type
     */
    private IdentificationType $identificationType;

    /**
     * Issuer constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize issuer data
     */
    private function initialize(array $data): void
    {
        if (empty($data)) {
            return;
        }

        if (isset($data['identification_type'])) {
            $this->setIdentificationType($data['identification_type']);
        }

        if (isset($data['identification_number'])) {
            $this->setIdentificationNumber($data['identification_number']);
        }

        if (isset($data['nrc'])) {
            $this->setNrc($data['nrc']);
        }

        if (isset($data['name'])) {
            $this->setName($data['name']);
        }

        if (isset($data['phone'])) {
            $this->setPhone($data['phone']);
        }

        if (isset($data['email'])) {
            $this->setEmail($data['email']);
        }

        if (isset($data['address'])) {
            $this->setAddress($data['address']);
        }

        if (isset($data['activity'])) {
            $this->setActivity($data['activity']);
        }
    }

    /**
     * Get NIT
     */
    public function getIdentificationType(): IdentificationType
    {
        return $this->identificationType;
    }

    /**
     * Set Identification Type
     */
    public function setIdentificationType(string $identificationTypeCode): void
    {
        $identificationType = (new DataLoader('tipos-identificacion'))->getByCode($identificationTypeCode);

        $this->identificationType = new IdentificationType($identificationType);
    }

    /**
     * Array representation using DGII Spanish keys
     */
    public function toArray(): array
    {
        $data = [
            'tipoDocumento' => $this->getIdentificationType()->getCode(),
            'numDocumento' => $this->getIdentificationNumber(),
            'nrc' => $this->getNrc(),
            'nombre' => $this->getName(),
            'telefono' => $this->getPhone(),
            'correo' => $this->getEmail(),
        ];

        // Add address data if available
        if ($this->address instanceof Address) {
            $data = array_merge($data, $this->address->toArray());
        }

        // Add activity data if available
        if ($this->activity instanceof Activity) {
            $data = array_merge($data, $this->activity->toArray());
        }

        return $data;
    }
}
