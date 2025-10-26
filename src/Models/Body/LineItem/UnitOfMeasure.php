<?php

namespace DazzaDev\DgiiSv\Models\Body\LineItem;

use DazzaDev\DgiiSv\Models\Base\BaseTypeModel;

class UnitOfMeasure extends BaseTypeModel
{
    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return $this->getBaseArray();
    }
}
