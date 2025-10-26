<?php

namespace DazzaDev\DgiiSv\Models\Base;

class Activity extends BaseTypeModel
{
    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return [
            'codActividad' => $this->getCode(),
            'descActividad' => $this->getName(),
        ];
    }
}
