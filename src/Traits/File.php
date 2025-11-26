<?php

namespace DazzaDev\DgiiSv\Traits;

use DazzaDev\DgiiSv\Exceptions\FileException;

trait File
{
    /**
     * File path
     */
    protected ?string $filePath = null;

    /**
     * File name
     */
    protected ?string $fileName = null;

    /**
     * File path
     */
    protected function validateFilePath()
    {
        if (is_null($this->filePath)) {
            throw new FileException('File path is not set');
        }
    }

    /**
     * Set file path
     */
    public function setFilePath(string $filePath): void
    {
        $this->filePath = $filePath;
    }

    /**
     * Get file path
     */
    public function getFilePath()
    {
        $this->validateFilePath();

        return $this->filePath;
    }

    /**
     * Set file name
     */
    public function setFileName(string $fileName): void
    {
        $this->fileName = $fileName;
    }

    /**
     * Get file name
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * Save file
     */
    protected function saveFile(string $documentType, string $fileName, string $fileContent): string
    {
        // Create directories
        $this->createDirectories($documentType);

        // Set file name
        $this->setFileName($fileName.'.jws');

        // Save signed XML document
        $filePath = $this->getFilePath().'/'.$documentType.'/'.$this->getFileName();
        $file = file_put_contents($filePath, $fileContent);

        if (! $file) {
            throw new FileException('Error saving file: '.$filePath);
        }

        return $file;
    }

    /**
     * Create directories
     */
    protected function createDirectories(string $documentType): void
    {
        $filePath = $this->getFilePath().'/'.$documentType;

        // Create base directory if it doesn't exist
        if (! file_exists($filePath)) {
            mkdir($filePath, 0777, true);
        }
    }
}
