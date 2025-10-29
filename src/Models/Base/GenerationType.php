<?php

namespace DazzaDev\DgiiSv\Models\Base;

class GenerationType extends BaseTypeModel
{
    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return $this->getBaseArray();
    }
}
