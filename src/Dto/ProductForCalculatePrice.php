<?php

declare(strict_types=1);

namespace App\Dto;

class ProductForCalculatePrice
{
    public function __construct(
        private readonly int $productId,
        private readonly string $taxNumber,
        private readonly ?string $couponCode,
    ) {
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getTaxNumber(): string
    {
        return $this->taxNumber;
    }

    public function getCouponCode(): ?string
    {
        return $this->couponCode;
    }
}
