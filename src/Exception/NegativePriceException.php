<?php

namespace App\Exception;

use Exception;

class NegativePriceException extends \Exception
{
    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        if (is_null($message)) {
            $message = 'Цена не может стать отрицательной';
        }

        parent::__construct($message, $code, $previous);
    }
}
