<?php

namespace DazzaDev\DgiiSv\Traits;

use DazzaDev\DgiiSv\DataLoader;
use DazzaDev\DgiiSv\Models\Contingency\ContingencyType;

trait ContingencyTypeTrait
{
    /**
     * Contingency type
     */
    private ?ContingencyType $contingencyType = null;

    /**
     * Contingency reason
     */
    private ?string $contingencyReason = null;

    /**
     * Set contingency type
     */
    public function setContingencyType(string|int $contingencyTypeCode): void
    {
        $contingencyType = (new DataLoader('tipos-contingencia'))->getByCode($contingencyTypeCode);

        $this->contingencyType = new ContingencyType($contingencyType);
    }

    /**
     * Get contingency type
     */
    public function getContingencyType(): ?ContingencyType
    {
        return $this->contingencyType;
    }

    /**
     * Get contingency type
     */
    public function getContingencyTypeCode(): ?int
    {
        $code = $this->getContingencyType()?->getCode();

        return $code ? (int) $code : null;
    }

    /**
     * Set contingency reason
     */
    public function setContingencyReason(string $contingencyReason): void
    {
        $this->contingencyReason = $contingencyReason;
    }

    /**
     * Get contingency reason
     */
    public function getContingencyReason(): ?string
    {
        return $this->contingencyReason;
    }

    /**
     * Get custom reason
     */
    public function getCustomReason(): ?string
    {
        return $this->getContingencyReason()
            ?? $this->getContingencyType()?->getName();
    }
}
