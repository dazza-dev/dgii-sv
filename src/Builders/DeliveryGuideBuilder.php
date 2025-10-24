<?php

namespace DazzaDev\DgiiSv\Builders;

use DazzaDev\DgiiSv\Models\DeliveryGuide;

class DeliveryGuideBuilder extends BaseDocumentBuilder
{
    /**
     * Create document instance
     */
    protected function createDocument(): DeliveryGuide
    {
        return new DeliveryGuide($this->environmentCode, $this->accessKey, $this->documentData);
    }

    /**
     * Get document type for delivery guide
     */
    protected function getDocumentType(): string
    {
        return 'delivery-guide';
    }

    /**
     * Get the delivery guide instance
     */
    public function getDeliveryGuide(): DeliveryGuide
    {
        return $this->getDocument();
    }
}
