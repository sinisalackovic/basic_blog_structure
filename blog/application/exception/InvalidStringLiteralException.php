<?php

namespace Exception;

use Exception;

class InvalidStringLiteralException extends \Exception
{
    const ERROR_CODE = 001;

    /**
     * InvalidStringLiteralException constructor.
     * @param string $value
     */
    public function __construct($value)
    {
        $message = sprintf('Argument "%s" is invalid. Argument must be a STRING.', $value);
        $code    = self::ERROR_CODE;

        parent::__construct($message, $code);
    }
}