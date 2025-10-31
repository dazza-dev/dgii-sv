<?php

namespace DazzaDev\DgiiSv\Traits;

use DazzaDev\DgiiSv\Models\Body\Responsible;

trait ResponsibleTrait
{
    /**
     * Responsible
     */
    private ?Responsible $responsible = null;

    /**
     * Get Responsible
     */
    public function getResponsible(): ?Responsible
    {
        return $this->responsible;
    }

    /**
     * Set Responsible using array or Responsible instance
     */
    public function setResponsible(Responsible|array $responsible): void
    {
        if ($responsible instanceof Responsible) {
            $this->responsible = $responsible;

            return;
        }

        $this->responsible = new Responsible($responsible);
    }
}
