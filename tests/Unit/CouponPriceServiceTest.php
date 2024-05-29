<?php

namespace App\Tests\Unit;

use App\Entity\Coupon;
use App\Entity\Product;
use App\Exception\NegativePriceException;
use App\Exception\UnknownCouponTypeException;
use App\Service\CouponPriceService;
use Exception;
use PHPUnit\Framework\TestCase;

class CouponPriceServiceTest extends TestCase
{
    private CouponPriceService $couponPriceService;

    public function setUp(): void
    {
        $this->couponPriceService = new CouponPriceService();
    }

    public function tearDown(): void
    {
        unset($this->couponPriceService);
    }

    /**
     * @covers       \App\Service\CouponPriceService::calculate
     * @dataProvider provider
     * @throws Exception
     */
    public function testCalculate(Product $product, Coupon $coupon, float $expected, string $message)
    {
        $this->assertEquals(
            $expected,
            $this->couponPriceService->calculate($product, $coupon),
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
                (new Product())
                    ->setPrice(100),
                (new Coupon())
                    ->setType(Coupon::TYPE_FIX)
                    ->setValue(10),
                90,
                'Продукт ценой 100 с фиксированной скидкой 10 евро',
            ],
            [
                (new Product())
                    ->setPrice(100),
                (new Coupon())
                    ->setType(Coupon::TYPE_PERSENT)
                    ->setValue(20),
                80,
                'Продукт ценой 100 со скидкой 20%',
            ],
        ];
    }

    /**
     * @covers \App\Service\CouponPriceService::calculate
     * @throws Exception
     */
    public function testUnknownCouponTypeException()
    {
        $this->expectException(UnknownCouponTypeException::class);

        $this->couponPriceService->calculate(
            new Product(),
            (new Coupon())->setType("Unknown")
        );
    }

    /**
     * @covers \App\Service\CouponPriceService::calculate
     * @throws Exception
     */
    public function testNegativePriceException()
    {
        $this->expectException(NegativePriceException::class);

        $this->couponPriceService->calculate(
            (new Product())->setPrice(100),
            (new Coupon())->setType(Coupon::TYPE_FIX)->setValue(101)
        );
    }
}



