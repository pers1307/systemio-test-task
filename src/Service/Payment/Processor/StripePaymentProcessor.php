<?php

namespace App\Service\Payment\Processor;

use Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor as StripePaymentProcessorSystemio;

class StripePaymentProcessor implements PaymentProcessorInterface
{
    private StripePaymentProcessorSystemio $stripePaymentProcessor;

    public function __construct()
    {
        $this->stripePaymentProcessor = new StripePaymentProcessorSystemio();
    }
    
    public function getPaymentType(): string
    {
        return 'stripe';
    }

    public function payment(float $price): void
    {
        $this->stripePaymentProcessor->processPayment($price);
    }
}
