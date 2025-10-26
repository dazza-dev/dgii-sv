<?php

namespace DazzaDev\DgiiSv\Traits;

trait JsonTrait
{
    /**
     * Convert array to Json
     */
    public function toJson(): string
    {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
