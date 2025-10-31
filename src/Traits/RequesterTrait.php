<?php

namespace DazzaDev\DgiiSv\Traits;

use DazzaDev\DgiiSv\Models\Body\Requester;

trait RequesterTrait
{
    /**
     * Requester information
     */
    private ?Requester $requester = null;

    /**
     * Get requester
     */
    public function getRequester(): ?Requester
    {
        return $this->requester;
    }

    /**
     * Set requester
     */
    public function setRequester(Requester|array $requester): void
    {
        $this->requester = $requester instanceof Requester ? $requester : new Requester($requester);
    }
}
