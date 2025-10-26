<?php

namespace DazzaDev\DgiiSv\Models\Body\Tax;

use DazzaDev\DgiiSv\Models\Base\BaseTypeModel;

class TaxType extends BaseTypeModel
{
    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return $this->getBaseArray();
    }
}
