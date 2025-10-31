<?php

namespace DazzaDev\DgiiSv\Models\Body\Extension;

use DazzaDev\DgiiSv\Traits\IdentificationTrait;
use DazzaDev\DgiiSv\Traits\NameTrait;

class PersonBase
{
    use IdentificationTrait;
    use NameTrait;

    /**
     * PersonBase constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize person base data
     */
    private function initialize(array $data): void
    {
        if (empty($data)) {
            return;
        }

        if (isset($data['name'])) {
            $this->setName($data['name']);
        }

        if (isset($data['identification_type'])) {
            $this->setIdentificationType($data['identification_type']);
        }

        if (isset($data['identification_number'])) {
            $this->setIdentificationNumber($data['identification_number']);
        }
    }

    /**
     * Convert person base to array
     */
    public function toArray(): array
    {
        $data['name'] = $this->getName();

        // Add identification type if it exists
        if ($this->getIdentificationType() !== null) {
            $data['identification_type'] = $this->getIdentificationType()->getCode();
        }

        // Add identification number
        $data['identification_number'] = $this->getIdentificationNumber();

        return $data;
    }
}
