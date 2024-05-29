<?php

namespace App\Tests\Unit;

use App\Exception\NotFoundTaxCodeException;
use App\Service\TaxService;
use Exception;
use PHPUnit\Framework\TestCase;

class TaxServiceTest extends TestCase
{
    private TaxService $taxService;

    public function setUp(): void
    {
        $this->taxService = new TaxService();
    }

    public function tearDown(): void
    {
        unset($this->taxService);
    }

    /**
     * @covers       \App\Service\TaxService::getPersentByCode
     * @dataProvider provider
     * @throws Exception
     */
    public function testCalculate(string $code, int $expected, string $message)
    {
        $this->assertEquals(
            $expected,
            $this->taxService->getPersentByCode($code),
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
                "DE123456789",
                19,
                'Код Германии 19%',
            ],
            [
                "IT12345678911",
                22,
                'Код Италия 22%',
            ],
            [
                "GR123456789",
                24,
                'Код Греции 24%',
            ],
            [
                "FRAA222222222",
                20,
                'Код Франции 20%',
            ],
        ];
    }

    /**
     * @covers \App\Service\TaxService::getPersentByCode
     * @throws Exception
     */
    public function testNotFoundTaxCodeException()
    {
        $this->expectException(NotFoundTaxCodeException::class);
        $tax = $this->taxService->getPersentByCode("RU11111111");
    }
}



