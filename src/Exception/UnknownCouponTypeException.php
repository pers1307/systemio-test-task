<?php

namespace App\Exception;

use Exception;

class UnknownCouponTypeException extends \Exception
{
    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        if (is_null($message)) {
            $message = 'Неизвестный формат купона';
        }

        parent::__construct($message, $code, $previous);
    }
}
