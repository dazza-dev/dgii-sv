<?php

namespace DazzaDev\DgiiSv\Models\Body;

class ThirdPartySale
{
    private string $nit = '';

    private string $name = '';

    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    private function initialize(array $data): void
    {
        if (isset($data['nit'])) {
            $this->setNit($data['nit']);
        }

        if (isset($data['nombre'])) {
            $this->setName($data['nombre']);
        } elseif (isset($data['name'])) {
            $this->setName($data['name']);
        }
    }

    public function getNit(): string
    {
        return $this->nit;
    }

    public function setNit(string $nit): void
    {
        $this->nit = $nit;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function toArray(): array
    {
        return [
            'nit' => $this->getNit(),
            'nombre' => $this->getName(),
        ];
    }
}
