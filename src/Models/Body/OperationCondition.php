<?php

namespace DazzaDev\DgiiSv\Models\Body;

use DazzaDev\DgiiSv\Models\Base\BaseTypeModel;

class OperationCondition extends BaseTypeModel
{
    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return $this->getBaseArray();
    }
}
