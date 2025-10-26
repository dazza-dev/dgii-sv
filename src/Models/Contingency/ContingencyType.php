<?php

namespace DazzaDev\DgiiSv\Models\Contingency;

use DazzaDev\DgiiSv\Models\Base\BaseTypeModel;

class ContingencyType extends BaseTypeModel
{
    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return $this->getBaseArray();
    }
}
