<?php

namespace DazzaDev\DgiiSv\Models\Body;

class AdditionalInfo
{
    /**
     * Additional info name
     */
    private string $name = '';

    /**
     * Additional info value
     */
    private string $value = '';

    /**
     * AdditionalInfo constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize additional info data
     */
    private function initialize(array $data): void
    {
        if (empty($data)) {
            return;
        }

        if (isset($data['name'])) {
            $this->setName($data['name']);
        }

        if (isset($data['value'])) {
            $this->setValue($data['value']);
        }
    }

    /**
     * Get additional info name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set additional info name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Get additional info value
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Set additional info value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'value' => $this->getValue(),
        ];
    }
}
