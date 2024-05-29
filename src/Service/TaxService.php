<?php

namespace App\Service;

use App\Exception\NotFoundTaxCodeException;

class TaxService
{
    /**
     * @throws NotFoundTaxCodeException
     */
    public function getPersentByCode(string $code): int
    {
        if (preg_match('/DE\d{9}$/ui', $code)) {
            return 19;
        }
        if (preg_match('/IT\d{11}$/ui', $code)) {
            return 22;
        }
        if (preg_match('/GR\d{9}$/ui', $code)) {
            return 24;
        }
        if (preg_match('/FR[A-Z]{2}\d{9}$/ui', $code)) {
            return 20;
        }

        throw new NotFoundTaxCodeException();
    }
}
