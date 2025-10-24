<?php

namespace DazzaDev\DgiiSv\Models\Body\Payment;

use DazzaDev\DgiiSv\DataLoader;

class Payment
{
    /**
     * Payment method information
     */
    public PaymentMethod $paymentMethod;

    /**
     * Payment amount
     */
    public float $amount = 0.0;

    /**
     * Payment term (decimal value)
     */
    public float $term = 0.0;

    /**
     * Payment unit time
     */
    public string $unitTime = '';

    /**
     * Payment constructor
     */
    public function __construct(array $data = [])
    {
        // Initialize paymentMethod with empty PaymentMethod object
        $this->paymentMethod = new PaymentMethod;

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

        if (isset($data['term'])) {
            $this->setTerm($data['term']);
        }

        if (isset($data['unit_time'])) {
            $this->setUnitTime($data['unit_time']);
        }
    }

    /**
     * Get payment method
     */
    public function getPaymentMethod(): PaymentMethod
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
            $paymentMethodData = (new DataLoader('payment-methods'))->getByCode($paymentMethod);
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
     * Get payment term
     */
    public function getTerm(): float
    {
        return $this->term;
    }

    /**
     * Set payment term
     */
    public function setTerm(float $term): void
    {
        $this->term = $term;
    }

    /**
     * Get payment unit time
     */
    public function getUnitTime(): string
    {
        return $this->unitTime;
    }

    /**
     * Set payment unit time
     */
    public function setUnitTime(string $unitTime): void
    {
        $this->unitTime = $unitTime;
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return [
            'payment_method' => $this->getPaymentMethod()->toArray(),
            'amount' => $this->getAmount(),
            'term' => $this->getTerm(),
            'unit_time' => $this->getUnitTime(),
        ];
    }
}
