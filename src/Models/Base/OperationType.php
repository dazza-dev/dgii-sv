<?php

namespace DazzaDev\DgiiSv\Models\Base;

class OperationType extends BaseTypeModel
{
    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return $this->getBaseArray();
    }
}
