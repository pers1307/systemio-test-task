<?php

namespace App\Service;

use App\Dto\ParceCoupon;
use App\Entity\Coupon;
use App\Exception\WrongCouponCodeFormatException;

class CouponParceService
{
    /**
     * @throws WrongCouponCodeFormatException
     */
    public function parce(string $couponCode): ParceCoupon
    {
        if (preg_match('/F(\d{1,4})$/ui', $couponCode, $matches)) {
            return new ParceCoupon(
                Coupon::TYPE_FIX,
                intval($matches[1])
            );
        }
        if (preg_match('/P(\d{1,3})$/ui', $couponCode, $matches)) {
            return new ParceCoupon(
                Coupon::TYPE_PERSENT,
                intval($matches[1])
            );
        }

        throw new WrongCouponCodeFormatException();
    }
}
