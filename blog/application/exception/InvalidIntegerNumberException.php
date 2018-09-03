<?php

namespace Exception;

use Exception;

class InvalidIntegerNumberException extends Exception
{
    const ERROR_CODE = 003;

    /**
     * InvalidIntegerNumberException constructor.
     * @param string $value
     */
    public function __construct($value)
    {
        $message = sprintf('Argument "%s" is invalid. Argument must be an Integer.', $value);
        $code    = self::ERROR_CODE;

        parent::__construct($message, $code);
    }
}