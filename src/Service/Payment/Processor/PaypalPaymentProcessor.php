<?php

namespace App\Service\Payment\Processor;

use Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor as PaypalPaymentProcessorSystemio;

class PaypalPaymentProcessor implements PaymentProcessorInterface
{
    private PaypalPaymentProcessorSystemio $paypalPaymentProcessor;

    public function __construct()
    {
        $this->paypalPaymentProcessor = new PaypalPaymentProcessorSystemio();
    }

    public function getPaymentType(): string
    {
        return 'paypal';
    }

    public function payment(float $price): void
    {
        $this->paypalPaymentProcessor->pay(round($price));
    }
}
