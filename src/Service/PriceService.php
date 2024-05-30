<?php

namespace App\Service;

use App\Dto\ProductForCalculatePrice;
use App\Entity\Product;
use App\Exception\NegativeCouponException;
use App\Exception\NotFoundCouponException;
use App\Exception\NotFoundProductException;
use App\Exception\NotFoundTaxCodeException;
use App\Exception\WrongCouponCodeFormatException;
use Doctrine\ORM\EntityManagerInterface;

class PriceService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly TaxService $taxService,
        private readonly CouponService $couponService
    ) {
    }

    /**
     * @param ProductForCalculatePrice $productForCalculatePrice
     * @throws NotFoundProductException
     * @throws NotFoundTaxCodeException
     * @throws NegativeCouponException
     * @throws NotFoundCouponException
     * @throws WrongCouponCodeFormatException
     */
    public function calculate(ProductForCalculatePrice $productForCalculatePrice): float
    {
        $productRepository = $this->entityManager->getRepository(Product::class);
        /** @var Product $product */
        $product = $productRepository->find($productForCalculatePrice->getProductId());
        if (is_null($product)) {
            throw new NotFoundProductException();
        }

        $price = $product->getPrice();
        if (!is_null($productForCalculatePrice->getCouponCode())) {
            $price = $this->couponService->apply($product, $productForCalculatePrice->getCouponCode());
        }

        $taxPersentage = $this->taxService->getPersentByCode($productForCalculatePrice->getTaxNumber());
        return $price + ($price * $taxPersentage / 100);
    }
}
