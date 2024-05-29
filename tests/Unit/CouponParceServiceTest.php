<?php

namespace App\Tests\Unit;

use App\Dto\ParceCoupon;
use App\Entity\Coupon;
use App\Exception\WrongCouponCodeFormatException;
use App\Service\CouponParceService;
use App\Service\TaxService;
use Exception;
use PHPUnit\Framework\TestCase;

class CouponParceServiceTest extends TestCase
{
    private CouponParceService $couponParceService;

    public function setUp(): void
    {
        $this->couponParceService = new CouponParceService();
    }

    public function tearDown(): void
    {
        unset($this->couponParceService);
    }

    /**
     * @covers       \App\Service\CouponParceService::parce
     * @dataProvider provider
     * @throws Exception
     */
    public function testCalculate(string $code, ParceCoupon $expected, string $message)
    {
        $this->assertEquals(
            $expected,
            $this->couponParceService->parce($code),
            $message
        );
    }

    /**
     * @throws \Exception
     */
    private function provider(): array
    {
        return [
            [
                "F1",
                new ParceCoupon(
                    Coupon::TYPE_FIX,
                    1
                ),
                'Фиксированный купон на 1 евро',
            ],
            [
                "F10",
                new ParceCoupon(
                    Coupon::TYPE_FIX,
                    10
                ),
                'Фиксированный купон на 10 евро',
            ],
            [
                "F110",
                new ParceCoupon(
                    Coupon::TYPE_FIX,
                    110
                ),
                'Фиксированный купон на 110 евро',
            ],
            [
                "F1000",
                new ParceCoupon(
                    Coupon::TYPE_FIX,
                    1000
                ),
                'Фиксированный купон на 1000 евро',
            ],
            //
            [
                "P1",
                new ParceCoupon(
                    Coupon::TYPE_PERSENT,
                    1
                ),
                'Купон на скидку 1%',
            ],
            [
                "P10",
                new ParceCoupon(
                    Coupon::TYPE_PERSENT,
                    10
                ),
                'Купон на скидку 10%',
            ],
            [
                "P100",
                new ParceCoupon(
                    Coupon::TYPE_PERSENT,
                    100
                ),
                'Купон на скидку 100%',
            ],
        ];
    }

    /**
     * @covers \App\Service\TaxService::getPersentByCode
     * @throws Exception
     */
    public function testWrongCouponCodeFormatException()
    {
        $this->expectException(WrongCouponCodeFormatException::class);

        $this->couponParceService->parce("D10");
    }
}



