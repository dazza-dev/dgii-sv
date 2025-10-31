<?php

namespace DazzaDev\DgiiSv\Models\Geography;

use DazzaDev\DgiiSv\DataLoader;

class Address
{
    /**
     * Address complement
     */
    private ?string $complement = null;

    /**
     * Department
     */
    private ?Department $department = null;

    /**
     * Municipality
     */
    private ?Municipality $municipality = null;

    /**
     * Country
     */
    private ?Country $country = null;

    /**
     * Address constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize address from array
     */
    private function initialize(array $data): void
    {
        if (empty($data)) {
            return;
        }

        if (isset($data['complement'])) {
            $this->setComplement($data['complement']);
        }

        if (isset($data['department'])) {
            $this->setDepartment($data['department']);
        }

        if (isset($data['municipality'])) {
            $this->setMunicipality($data['municipality']);
        }

        if (isset($data['country'])) {
            $this->setCountry($data['country']);
        }
    }

    /**
     * Get address complement
     */
    public function getComplement(): ?string
    {
        return $this->complement;
    }

    /**
     * Set address complement
     */
    public function setComplement(string $complement): void
    {
        $this->complement = $complement;
    }

    /**
     * Get Department
     */
    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    /**
     * Set Department using string code, array or Department instance
     */
    public function setDepartment(Department|array|string $department): void
    {
        if ($department instanceof Department) {
            $this->department = $department;

            return;
        }

        if (is_array($department)) {
            $this->department = new Department($department);

            return;
        }

        // string code
        $data = (new DataLoader('departamentos'))->getByCode($department);
        $this->department = new Department($data);
    }

    /**
     * Get Municipality
     */
    public function getMunicipality(): ?Municipality
    {
        return $this->municipality;
    }

    /**
     * Set Municipality using string code, array or Municipality instance
     */
    public function setMunicipality(Municipality|array|string $municipality): void
    {
        if ($municipality instanceof Municipality) {
            $this->municipality = $municipality;

            return;
        }

        if (is_array($municipality)) {
            $this->municipality = new Municipality($municipality);

            return;
        }

        // string code
        $data = (new DataLoader('municipios'))->getByCode($municipality);
        $this->municipality = new Municipality($data);
    }

    /**
     * Get Country
     */
    public function getCountry(): ?Country
    {
        return $this->country;
    }

    /**
     * Set Country using string code, array or Country instance
     */
    public function setCountry(Country|array|string $country): void
    {
        if ($country instanceof Country) {
            $this->country = $country;

            return;
        }

        if (is_array($country)) {
            $this->country = new Country($country);

            return;
        }

        // string code
        $data = (new DataLoader('paises'))->getByCode($country);
        $this->country = new Country($data);
    }

    /**
     * Convert address to array with DGII keys
     */
    public function toArray(): array
    {
        return [
            'direccion' => [
                'departamento' => $this->getDepartment()?->getCode(),
                'municipio' => $this->getMunicipality()?->getCode(),
                'complemento' => $this->getComplement(),
            ],
        ];
    }
}
