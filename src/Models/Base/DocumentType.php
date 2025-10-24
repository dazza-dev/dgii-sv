<?php

namespace DazzaDev\DgiiSv\Models\Base;

class DocumentType extends BaseTypeModel
{
    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return $this->getBaseArray();
    }
}
