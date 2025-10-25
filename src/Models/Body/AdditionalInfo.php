<?php

namespace DazzaDev\DgiiSv\Models\Body;

class AdditionalInfo
{
    /**
     * Field name
     */
    private string $field = '';

    /**
     * Field label
     */
    private string $label = '';

    /**
     * Field value
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

        if (isset($data['field'])) {
            $this->setField($data['field']);
        }

        if (isset($data['label'])) {
            $this->setLabel($data['label']);
        }

        if (isset($data['value'])) {
            $this->setValue($data['value']);
        }
    }

    /**
     * Get field name
     */
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * Set field name
     */
    public function setField(string $field): void
    {
        $this->field = $field;
    }

    /**
     * Get field label
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * Set field label
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    /**
     * Get field value
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Set field value
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
            'campo' => $this->getField(),
            'etiqueta' => $this->getLabel(),
            'valor' => $this->getValue(),
        ];
    }
}
