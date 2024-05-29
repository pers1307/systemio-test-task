<?php

namespace App\Exception;

use Exception;

class NotFoundTaxCodeException extends \Exception
{
    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        if (is_null($message)) {
            $message = 'Неизвестный налоговый номер';
        }

        parent::__construct($message, $code, $previous);
    }
}
