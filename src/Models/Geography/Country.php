<?php

namespace DazzaDev\DgiiSv\Models\Geography;

use DazzaDev\DgiiSv\Models\Base\BaseTypeModel;

class Country extends BaseTypeModel
{
    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return $this->getBaseArray();
    }
}
