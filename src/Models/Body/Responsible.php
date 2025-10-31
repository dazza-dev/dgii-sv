<?php

namespace DazzaDev\DgiiSv\Models\Body;

use DazzaDev\DgiiSv\Models\Body\Extension\PersonBase;

class Responsible extends PersonBase
{
    /**
     * Array representation using DGII Spanish keys
     */
    public function toArray(): array
    {
        return [
            'nombreResponsable' => $this->getName(),
            'tipoDocResponsable' => $this->getIdentificationType()->getCode(),
            'numeroDocResponsable' => $this->getIdentificationNumber(),
        ];
    }
}
