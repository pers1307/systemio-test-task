<?php

namespace App\Exception;

use Exception;

class NotFoundProductException extends \Exception
{
    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        if (is_null($message)) {
            $message = 'Продукт не существует';
        }

        parent::__construct($message, $code, $previous);
    }
}
