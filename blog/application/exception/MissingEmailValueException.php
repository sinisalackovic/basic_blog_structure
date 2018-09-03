<?php

namespace Exception;

use Exception;

class MissingEmailValueException extends Exception
{
    const ERROR_CODE = 004;

    /**
     * MissingEmailValueException constructor.
     */
    public function __construct()
    {
        $message = sprintf('Email value is missing.');
        $code    = self::ERROR_CODE;

        parent::__construct($message, $code);
    }
}
