<?php

namespace DazzaDev\DgiiSv\Models\Base;

use DateTime;
use DazzaDev\DgiiSv\DateValidator;
use DazzaDev\DgiiSv\Enums\Environments;
use Ramsey\Uuid\Uuid;

abstract class DTEModel
{
    /**
     * Environment
     */
    private array $environment;

    /**
     * Version
     */
    private int $version = 1;

    /**
     * Generation code
     */
    private string $generationCode;

    /**
     * Issue date
     */
    private string $issueDate;

    /**
     * Issue time
     */
    private string $issueTime;

    /**
     * DTE constructor
     */
    public function __construct(array $data = [])
    {
        $this->setGenerationCode();
        $this->initialize($data);
    }

    /**
     * Initialize DTE data
     *
     * @param  array  $data  DTE data
     */
    private function initialize(array $data): void
    {
        if (empty($data)) {
            return;
        }

        if (isset($data['environment'])) {
            $this->setEnvironment($data['environment']);
        }

        if (isset($data['date'])) {
            $this->setDate($data['date']);
        }
    }

    /**
     * Set generation code
     */
    public function setGenerationCode(): void
    {
        $this->generationCode = strtoupper(Uuid::uuid4()->toString());
    }

    /**
     * Get generation code
     */
    public function getGenerationCode(): string
    {
        return $this->generationCode;
    }

    /**
     * Set environment
     */
    public function setEnvironment(string $environmentCode): void
    {
        $this->environment = Environments::from($environmentCode)->toArray();
    }

    /**
     * Get environment
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * Get version
     */
    public function getVersion(): int
    {
        return $this->version;
    }

    /**
     * Set version
     */
    public function setVersion(int $version): void
    {
        $this->version = $version;
    }

    /**
     * Set date
     */
    public function setDate(string|DateTime $date): void
    {
        $dateValidator = new DateValidator;

        $this->setIssueDate($dateValidator->getDate($date));
        $this->setIssueTime($dateValidator->getTime($date));
    }

    /**
     * Get datetime
     */
    public function getDateTime(): string
    {
        return $this->issueDate.' '.$this->issueTime;
    }

    /**
     * Get date
     */
    public function getIssueDate(): string
    {
        return $this->issueDate;
    }

    /**
     * Set issue date
     */
    public function setIssueDate(string $issueDate): void
    {
        $this->issueDate = $issueDate;
    }

    /**
     * Get issue time
     */
    public function getIssueTime(): string
    {
        return $this->issueTime;
    }

    /**
     * Set issue time
     */
    public function setIssueTime(string $issueTime): void
    {
        $this->issueTime = $issueTime;
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return [
            'version' => $this->getVersion(),
            'ambiente' => $this->getEnvironment()['code'],
            'codigoGeneracion' => $this->getGenerationCode(),
        ];
    }
}
