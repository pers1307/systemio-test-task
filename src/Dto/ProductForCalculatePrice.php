<?php

declare(strict_types=1);

namespace App\Dto;

use App\Service\CouponParceService;
use App\Service\TaxService;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class ProductForCalculatePrice
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Positive]
        private readonly int $productId,
        #[Assert\NotBlank]
        private readonly ?string $taxNumber,
        private readonly ?string $couponCode,
    ) {
    }

    #[Assert\Callback]
    public function validate(ExecutionContextInterface $context, mixed $payload): void
    {
        if (!preg_match(TaxService::getAllRegExp(), $this->getTaxNumber())) {
            $context->buildViolation('Wrong tax code format')
                ->atPath('taxNumber')
                ->addViolation();
        }

        if (!empty($this->getCouponCode()) && !preg_match(CouponParceService::getAllRegExp(), $this->getCouponCode())) {
            $context->buildViolation('Wrong coupon code format')
                ->atPath('couponCode')
                ->addViolation();
        }
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getTaxNumber(): ?string
    {
        return $this->taxNumber;
    }

    public function getCouponCode(): ?string
    {
        return $this->couponCode;
    }
}
