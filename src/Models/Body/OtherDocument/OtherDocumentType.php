<?php

namespace DazzaDev\DgiiSv\Models\Body\OtherDocument;

use DazzaDev\DgiiSv\Models\Base\BaseTypeModel;

class OtherDocumentType extends BaseTypeModel
{
    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return $this->getBaseArray();
    }
}
