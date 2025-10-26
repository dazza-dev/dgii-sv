<?php

namespace DazzaDev\DgiiSv\Traits;

trait NameTrait
{
    /**
     * Name of the person
     */
    private string $name = '';

    /**
     * Get name of the person
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set name of the person
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
