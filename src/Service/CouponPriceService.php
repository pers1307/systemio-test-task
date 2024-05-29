<?php

namespace App\Service;

use App\Entity\Coupon;
use App\Entity\Product;
use App\Exception\NegativePriceException;
use App\Exception\UnknownCouponTypeException;

class CouponPriceService
{
    /**
     * @throws NegativePriceException
     * @throws UnknownCouponTypeException
     */
    public function calculate(Product $product, Coupon $coupon): float
    {
        if (Coupon::TYPE_FIX === $coupon->getType()) {
            $price = $product->getPrice() - $coupon->getValue();
            if ($price < 0) {
                throw new NegativePriceException();
            }
            return $price;
        }
        if (Coupon::TYPE_PERSENT === $coupon->getType()) {
            return $product->getPrice() * (100 - $coupon->getValue()) / 100;
        }

        throw new UnknownCouponTypeException();
    }
}
