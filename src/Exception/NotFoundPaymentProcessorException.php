<?php

namespace App\Exception;

use Exception;

class NotFoundPaymentProcessorException extends \Exception
{
    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        if (is_null($message)) {
            $message = 'Такой тип платежной системы не найден';
        }

        parent::__construct($message, $code, $previous);
    }
}
