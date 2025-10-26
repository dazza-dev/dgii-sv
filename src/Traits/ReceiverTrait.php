<?php

namespace DazzaDev\DgiiSv\Traits;

use DazzaDev\DgiiSv\Models\Receiver\Receiver;

trait ReceiverTrait
{
    /**
     * Receiver information
     */
    private ?Receiver $receiver = null;

    /**
     * Get receiver
     */
    public function getReceiver(): ?Receiver
    {
        return $this->receiver;
    }

    /**
     * Set receiver
     */
    public function setReceiver(Receiver|array $receiver): void
    {
        $this->receiver = $receiver instanceof Receiver ? $receiver : new Receiver($receiver);
    }
}
