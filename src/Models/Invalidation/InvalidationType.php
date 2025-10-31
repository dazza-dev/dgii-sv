<?php

namespace DazzaDev\DgiiSv\Models\Invalidation;

use DazzaDev\DgiiSv\Models\Base\BaseTypeModel;

class InvalidationType extends BaseTypeModel
{
    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return $this->getBaseArray();
    }
}
