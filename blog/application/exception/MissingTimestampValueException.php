<?php

namespace Exception;

use Exception;

class MissingTimestampValueException extends Exception
{
    const ERROR_CODE = 002;

    /**
     * MissingTimestampValueException constructor.
     */
    public function __construct()
    {
        $message = sprintf('Timestamp value is missing.');
        $code    = self::ERROR_CODE;

        parent::__construct($message, $code);
    }
}
