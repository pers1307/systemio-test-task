<?php

namespace App\Service;

use App\Entity\Coupon;
use App\Entity\Product;
use App\Exception\NegativeCouponException;
use App\Exception\NotFoundCouponException;
use App\Exception\WrongCouponCodeFormatException;
use Doctrine\ORM\EntityManagerInterface;

class CouponService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly CouponParceService $couponParceService,
        private readonly CouponPriceService $couponPriceService
    ) {
    }

    /**
     * @throws WrongCouponCodeFormatException
     * @throws NegativeCouponException
     * @throws NotFoundCouponException
     */
    public function apply(Product $product, string $couponCode): int
    {
        $parceCoupon = $this->couponParceService->parce($couponCode);

        if (
            Coupon::TYPE_PERSENT === $parceCoupon->getType()
            && 100 < $parceCoupon->getValue()
        ) {
            throw new NegativeCouponException();
        }

        $couponRepository = $this->entityManager->getRepository(Coupon::class);
        $coupon = $couponRepository->findOneBy([
            'product' => $product,
            'type' => $parceCoupon->getType(),
            'value' => $parceCoupon->getValue(),
        ]);
        if (is_null($coupon)) {
            throw new NotFoundCouponException();
        }

        return $this->couponPriceService->calculate($product, $coupon);
    }
}
