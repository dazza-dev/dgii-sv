<?php

namespace DazzaDev\DgiiSv\Models\Body\Payment;

use DazzaDev\DgiiSv\Models\Base\BaseTypeModel;

class PaymentTermType extends BaseTypeModel
{
    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return $this->getBaseArray();
    }
}
