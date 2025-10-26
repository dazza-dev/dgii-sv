<?php

namespace DazzaDev\DgiiSv\Models\Body\Payment;

use DazzaDev\DgiiSv\Models\Base\BaseTypeModel;

class PaymentMethod extends BaseTypeModel
{
    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return $this->getBaseArray();
    }
}
