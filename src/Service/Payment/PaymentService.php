<?php

namespace App\Service\Payment;

use App\Exception\NotFoundPaymentProcessorException;
use App\Service\Payment\Processor\PaymentProcessorInterface;

class PaymentService
{
    /**
     * @var PaymentProcessorInterface[]
     */
    private array $processors = [];

    public function addProcessor(PaymentProcessorInterface $processor): void
    {
        $this->processors[] = $processor;
    }

    /**
     * @throws NotFoundPaymentProcessorException
     */
    public function payment(string $paymentType, float $price): void
    {
        foreach ($this->processors as $processor) {
            if ($paymentType == $processor->getPaymentType()) {
                $processor->payment($price);
                return;
            }
        }

        throw new NotFoundPaymentProcessorException();
    }
}
