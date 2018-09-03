<?php

namespace Common;

use Exception;

class NotAnObjectException extends Exception
{
    const ERROR_MESSAGE = 'Call to a member function %s() on a non-object. Expected the "%s" object type.';
    const ERROR_CODE    = 006;

    /**
     * NotAnObjectException constructor.
     * @param string $function
     * @param string $expected
     */
    public function __construct($function, $expected)
    {
        parent::__construct(sprintf(self::ERROR_MESSAGE, $function, $expected), self::ERROR_CODE);
    }
}
