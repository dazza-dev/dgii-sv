<?php

namespace DazzaDev\DgiiSv\Models\Body\Payment;

use DazzaDev\DgiiSv\DataLoader;

class Payment
{
    /**
     * Payment method information
     */
    public ?PaymentMethod $paymentMethod = null;

    /**
     * Payment amount
     */
    public float $amount = 0.0;

    /**
     * Payment reference
     */
    public ?string $reference = null;

    /**
     * Payment term period
     */
    public ?int $termPeriod = null;

    /**
     * Payment term type
     */
    public ?PaymentTermType $termType = null;

    /**
     * Payment constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize payment data
     */
    protected function initialize(array $data): void
    {
        if (empty($data)) {
            return;
        }

        if (isset($data['payment_method'])) {
            $this->setPaymentMethod($data['payment_method']);
        }

        if (isset($data['amount'])) {
            $this->setAmount($data['amount']);
        }

        if (isset($data['reference'])) {
            $this->setReference($data['reference']);
        }

        if (isset($data['term_period'])) {
            $this->setTermPeriod($data['term_period']);
        }

        if (isset($data['term_type'])) {
            $this->setTermType($data['term_type']);
        }
    }

    /**
     * Get payment method
     */
    public function getPaymentMethod(): ?PaymentMethod
    {
        return $this->paymentMethod;
    }

    /**
     * Set payment method
     */
    public function setPaymentMethod(PaymentMethod|array|int|string $paymentMethod): void
    {
        if (is_array($paymentMethod)) {
            $this->paymentMethod = new PaymentMethod($paymentMethod);
        } elseif (is_int($paymentMethod) || is_string($paymentMethod)) {
            $paymentMethodData = (new DataLoader('metodos-pago'))->getByCode($paymentMethod);
            $this->paymentMethod = new PaymentMethod($paymentMethodData);
        } else {
            $this->paymentMethod = $paymentMethod;
        }
    }

    /**
     * Get payment amount
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * Set payment amount
     */
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * Get payment reference
     */
    public function getReference(): ?string
    {
        return $this->reference;
    }

    /**
     * Set payment reference
     */
    public function setReference(string $reference): void
    {
        $this->reference = $reference;
    }

    /**
     * Get payment term period
     */
    public function getTermPeriod(): ?int
    {
        return $this->termPeriod;
    }

    /**
     * Set payment term period
     */
    public function setTermPeriod(int $termPeriod): void
    {
        $this->termPeriod = $termPeriod;
    }

    /**
     * Get payment unit time
     */
    public function getTermType(): ?PaymentTermType
    {
        return $this->termType;
    }

    /**
     * Set payment term type
     */
    public function setTermType(PaymentTermType|array|string $termType): void
    {
        if (is_array($termType)) {
            $this->termType = new PaymentTermType($termType);
        } elseif (is_int($termType) || is_string($termType)) {
            $termTypeData = (new DataLoader('plazos-pago'))->getByCode($termType);
            $this->termType = new PaymentTermType($termTypeData);
        } else {
            $this->termType = $termType;
        }
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return [
            'codigo' => $this->getPaymentMethod()?->getCode(),
            'montoPago' => $this->getAmount(),
            'referencia' => $this->getReference(),
            'periodo' => $this->getTermPeriod(),
            'plazo' => $this->getTermType()?->getCode(),
        ];
    }
}
