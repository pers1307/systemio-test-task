<?php

namespace App\Exception;

use Exception;

class NegativeCouponException extends \Exception
{
    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        if (is_null($message)) {
            $message = 'Купон не может иметь скидку больше 100%';
        }

        parent::__construct($message, $code, $previous);
    }
}
