<?php

namespace DazzaDev\DgiiSv\Models\Base;

use DazzaDev\DgiiSv\Traits\NameTrait;

abstract class BaseTypeModel
{
    use NameTrait;

    /**
     * Model code
     */
    protected string $code = '';

    /**
     * BaseModel constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize model data
     */
    protected function initialize(array $data): void
    {
        if (empty($data)) {
            return;
        }

        if (isset($data['code'])) {
            $this->setCode($data['code']);
        }

        if (isset($data['name'])) {
            $this->setName($data['name']);
        }
    }

    /**
     * Get model code
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Set model code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * Get base array representation
     */
    protected function getBaseArray(): array
    {
        return [
            'code' => $this->getCode(),
            'name' => $this->getName(),
        ];
    }

    /**
     * Get array representation
     */
    abstract public function toArray(): array;
}
