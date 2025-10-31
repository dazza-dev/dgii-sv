<?php

namespace DazzaDev\DgiiSv\Traits;

use DazzaDev\DgiiSv\DataLoader;
use DazzaDev\DgiiSv\Models\Body\ItemType;

trait ItemTypeTrait
{
    /**
     * Item Type (tipoItem)
     */
    private ?ItemType $itemType = null;

    /**
     * Get item type
     */
    public function getItemType(): ?ItemType
    {
        return $this->itemType;
    }

    /**
     * Get item type code
     */
    public function getItemTypeCode(): ?int
    {
        $code = $this->getItemType()?->getCode();

        return $code ? (int) $code : null;
    }

    /**
     * Set item type
     */
    public function setItemType(int $itemTypeCode): void
    {
        $itemType = (new DataLoader('tipos-item'))->getByCode($itemTypeCode);

        $this->itemType = new ItemType($itemType);
    }
}
