<?php

namespace App\Service;

use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;

class ErrorFormatService
{
    public function format(ConstraintViolationList $errors): array
    {
        $formatErrors = [];
        /** @var ConstraintViolation $error */
        foreach ($errors as $error) {
            $formatErrors[$error->getPropertyPath()] = $error->getMessage();
        }

        return $formatErrors;
    }
}
