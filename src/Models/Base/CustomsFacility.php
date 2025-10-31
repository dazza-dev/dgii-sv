<?php

namespace DazzaDev\DgiiSv\Models\Base;

class CustomsFacility extends BaseTypeModel
{
    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return $this->getBaseArray();
    }
}
