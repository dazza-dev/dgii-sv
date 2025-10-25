<?php

namespace DazzaDev\DgiiSv\Models\Body\LineItem;

use DazzaDev\DgiiSv\Models\Base\BaseTypeModel;

class UnitMeasurement extends BaseTypeModel
{
    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return $this->getBaseArray();
    }
}
