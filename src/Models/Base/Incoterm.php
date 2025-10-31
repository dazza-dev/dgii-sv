<?php

namespace DazzaDev\DgiiSv\Models\Base;

class Incoterm extends BaseTypeModel
{
    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return $this->getBaseArray();
    }
}
