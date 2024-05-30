<?php

namespace App\Service\Payment\Processor;

interface PaymentProcessorInterface
{
    public function getPaymentType(): string;

    public function payment(float $price): void;
}
