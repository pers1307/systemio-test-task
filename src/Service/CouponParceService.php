<?php

namespace App\Service;

use App\Dto\ParceCoupon;
use App\Entity\Coupon;
use App\Exception\WrongCouponCodeFormatException;

class CouponParceService
{
    public const FIX_REGEXP = 'F(\d{1,4})$';
    public const PERSENT_REGEXP = 'P(\d{1,3})$';

    public static function getAllRegExp(): string
    {
        return '/'
            . self::FIX_REGEXP
            . '|' . self::PERSENT_REGEXP
            . '/ui';
    }

    public static function wrapRegexp(string $regExp): string
    {
        return '/' . $regExp . '/ui';
    }

    /**
     * @throws WrongCouponCodeFormatException
     */
    public function parce(string $couponCode): ParceCoupon
    {
        if (preg_match(self::wrapRegexp(self::FIX_REGEXP), $couponCode, $matches)) {
            return new ParceCoupon(
                Coupon::TYPE_FIX,
                intval($matches[1])
            );
        }
        if (preg_match(self::wrapRegexp(self::PERSENT_REGEXP), $couponCode, $matches)) {
            return new ParceCoupon(
                Coupon::TYPE_PERSENT,
                intval($matches[1])
            );
        }

        throw new WrongCouponCodeFormatException();
    }
}
