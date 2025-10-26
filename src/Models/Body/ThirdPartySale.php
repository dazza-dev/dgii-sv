<?php

namespace DazzaDev\DgiiSv\Models\Body;

use DazzaDev\DgiiSv\Traits\NameTrait;

class ThirdPartySale
{
    use NameTrait;

    /**
     * NIT of the third party
     */
    private string $nit = '';

    /**
     * Third party sale constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize third party sale data
     */
    private function initialize(array $data): void
    {
        if (empty($data)) {
            return;
        }

        if (isset($data['nit'])) {
            $this->setNit($data['nit']);
        }

        if (isset($data['name'])) {
            $this->setName($data['name']);
        }
    }

    /**
     * Get third party sale NIT
     */
    public function getNit(): string
    {
        return $this->nit;
    }

    /**
     * Set third party sale NIT
     */
    public function setNit(string $nit): void
    {
        $this->nit = $nit;
    }

    /**
     * Convert third party sale to array
     */
    public function toArray(): array
    {
        return [
            'nit' => $this->getNit(),
            'nombre' => $this->getName(),
        ];
    }
}
