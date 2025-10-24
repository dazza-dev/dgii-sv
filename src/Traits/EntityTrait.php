<?php

namespace DazzaDev\DgiiSv\Traits;

use DazzaDev\DgiiSv\Models\Geography\Address;

trait EntityTrait
{
    /**
     * NRC
     */
    private string $nrc = '';

    /**
     * Phone
     */
    private string $phone = '';

    /**
     * Email
     */
    private string $email = '';

    /**
     * Address
     */
    private ?Address $address = null;

    /**
     * Get NRC
     */
    public function getNrc(): string
    {
        return $this->nrc;
    }

    /**
     * Set NRC
     */
    public function setNrc(string $nrc): void
    {
        $this->nrc = $nrc;
    }

    /**
     * Get Phone
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * Set Phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * Get Email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set Email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * Get Address
     */
    public function getAddress(): ?Address
    {
        return $this->address;
    }

    /**
     * Set Address using array or Address instance
     */
    public function setAddress(Address|array $address): void
    {
        if ($address instanceof Address) {
            $this->address = $address;

            return;
        }

        $this->address = new Address($address);
    }
}
