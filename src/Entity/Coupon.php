<?php

namespace App\Entity;

use App\Repository\CouponRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CouponRepository::class)]
class Coupon
{
    public const TYPE_FIX = 'fix';
    public const TYPE_PERSENT = 'persent';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'coupons')]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private Product $product;

    #[ORM\Column(type: 'string', nullable: false, columnDefinition: "ENUM('fix', 'persent')")]
    private string $type;

    #[ORM\Column]
    private int $persent;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): static
    {
        $this->product = $product;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;
        return $this;
    }

    public function getPersent(): int
    {
        return $this->persent;
    }

    public function setPersent(int $persent): static
    {
        $this->persent = $persent;
        return $this;
    }
}
