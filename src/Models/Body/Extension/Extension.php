<?php

namespace DazzaDev\DgiiSv\Models\Body\Extension;

class Extension
{
    /**
     * Delivered person
     */
    private ?Delivered $delivered = null;

    /**
     * Received person
     */
    private ?Received $received = null;

    /**
     * Observations
     */
    private ?string $observations = null;

    /**
     * Vehicle plate
     */
    private ?string $vehicle_plate = null;

    /**
     * Extension constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize extension data
     */
    private function initialize(array $data): void
    {
        if (empty($data)) {
            return;
        }

        if (isset($data['delivered'])) {
            $this->setDelivered($data['delivered']);
        }

        if (isset($data['received'])) {
            $this->setReceived($data['received']);
        }

        if (isset($data['observations'])) {
            $this->setObservations($data['observations']);
        }

        if (isset($data['vehicle_plate'])) {
            $this->setVehiclePlate($data['vehicle_plate']);
        }
    }

    /**
     * Get delivered person
     */
    public function getDelivered(): ?Delivered
    {
        return $this->delivered;
    }

    /**
     * Set delivered person
     */
    public function setDelivered(Delivered|array $delivered): void
    {
        $this->delivered = $delivered instanceof Delivered ? $delivered : new Delivered($delivered);
    }

    /**
     * Get received person
     */
    public function getReceived(): ?Received
    {
        return $this->received;
    }

    /**
     * Set received person
     */
    public function setReceived(Received|array $received): void
    {
        $this->received = $received instanceof Received ? $received : new Received($received);
    }

    /**
     * Get observations
     */
    public function getObservations(): ?string
    {
        return $this->observations;
    }

    /**
     * Set observations
     */
    public function setObservations(string $observations): void
    {
        $this->observations = $observations;
    }

    /**
     * Get vehicle plate
     */
    public function getVehiclePlate(): ?string
    {
        return $this->vehicle_plate;
    }

    /**
     * Set vehicle plate
     */
    public function setVehiclePlate(string $vehicle_plate): void
    {
        $this->vehicle_plate = $vehicle_plate;
    }

    /**
     * Convert extension to array
     */
    public function toArray(): array
    {
        return [
            'nombEntrega' => $this->getDelivered()->getName(),
            'docuEntrega' => $this->getDelivered()->getIdentificationNumber(),
            'nombRecibe' => $this->getReceived()->getName(),
            'docuRecibe' => $this->getReceived()->getIdentificationNumber(),
            'observaciones' => $this->getObservations(),
            'placaVehiculo' => $this->getVehiclePlate(),
        ];
    }
}
