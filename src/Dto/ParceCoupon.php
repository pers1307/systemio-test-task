<?php

declare(strict_types=1);

namespace App\Dto;

class ParceCoupon
{
    public function __construct(
        private readonly string $type,
        private readonly int $value,
    ) {
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
