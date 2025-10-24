<?php

namespace DazzaDev\DgiiSv\Models\Base;

class IdentificationType extends BaseTypeModel
{
    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return $this->getBaseArray();
    }
}
