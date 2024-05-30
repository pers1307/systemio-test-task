<?php

namespace App\Service;

use App\Exception\NotFoundTaxCodeException;

class TaxService
{
    public const GERMAN_REGEXP = 'DE\d{9}$';
    public const ITALIAN_REGEXP = 'IT\d{11}$';
    public const GREECE_REGEXP = 'GR\d{9}$';
    public const FRANCE_REGEXP = 'FR[A-Z]{2}\d{9}$';

    public static function getAllRegExp(): string
    {
        return '/'
            . self::GERMAN_REGEXP
            . '|' . self::ITALIAN_REGEXP
            . '|' . self::GREECE_REGEXP
            . '|' . self::FRANCE_REGEXP
            . '/ui';
    }

    public static function wrapRegexp(string $regExp): string
    {
        return '/' . $regExp . '/ui';
    }

    /**
     * @throws NotFoundTaxCodeException
     */
    public function getPersentByCode(string $code): int
    {
        if (preg_match($this->wrapRegexp(self::GERMAN_REGEXP), $code)) {
            return 19;
        }
        if (preg_match($this->wrapRegexp(self::ITALIAN_REGEXP), $code)) {
            return 22;
        }
        if (preg_match($this->wrapRegexp(self::GREECE_REGEXP), $code)) {
            return 24;
        }
        if (preg_match($this->wrapRegexp(self::FRANCE_REGEXP), $code)) {
            return 20;
        }

        throw new NotFoundTaxCodeException();
    }
}
