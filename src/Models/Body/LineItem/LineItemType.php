<?php

namespace DazzaDev\DgiiSv\Models\Body\LineItem;

use DazzaDev\DgiiSv\Models\Base\BaseTypeModel;

class LineItemType extends BaseTypeModel
{
    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return $this->getBaseArray();
    }
}
