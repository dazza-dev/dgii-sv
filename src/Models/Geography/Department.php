<?php

namespace DazzaDev\DgiiSv\Models\Geography;

use DazzaDev\DgiiSv\Models\Base\BaseTypeModel;

class Department extends BaseTypeModel
{
    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return $this->getBaseArray();
    }
}
