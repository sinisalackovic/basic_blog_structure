<?php

namespace Exception;

use Exception;

class InvalidEmailException extends Exception
{
    const ERROR_CODE = 005;

    /**
     * InvalidEmailException constructor.
     * @param string $value
     */
    public function __construct($value)
    {
        $message = sprintf('Email "%s" is invalid.', $value);
        $code    = self::ERROR_CODE;

        parent::__construct($message, $code);
    }
}
