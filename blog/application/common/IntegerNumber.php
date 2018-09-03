<?php

namespace Common;

use Exception\InvalidIntegerNumberException;

class IntegerNumber
{
    /*
     * @var integer
     */
    private $value;

    /**
     * IntegerNumber constructor.
     * @param $value
     * @throws InvalidIntegerNumberException
     */
    public function __construct($value)
    {
        if ($value === true || \filter_var($value, FILTER_VALIDATE_INT) === false) {
            throw new InvalidIntegerNumberException($value);
        }
        $this->value = \intval($value);
    }

    /*
     * @return integer
     */
    public function getValue()
    {
        return $this->value;
    }
}
