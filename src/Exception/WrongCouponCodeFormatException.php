<?php

namespace App\Exception;

use Exception;

class WrongCouponCodeFormatException extends \Exception
{
    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        if (is_null($message)) {
            $message = 'Купон имеет неверный формат';
        }

        parent::__construct($message, $code, $previous);
    }
}
