<?php

namespace DazzaDev\DgiiSv\Models\Body\Extension;

use DazzaDev\DgiiSv\Traits\IdentificationNumberTrait;
use DazzaDev\DgiiSv\Traits\NameTrait;

class PersonBase
{
    use IdentificationNumberTrait;
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

        if (isset($data['identification_number'])) {
            $this->setIdentificationNumber($data['identification_number']);
        }
    }

    /**
     * Convert person base to array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'identification_number' => $this->getIdentificationNumber(),
        ];
    }
}
