<?php

namespace Common;

use Exception\InvalidStringLiteralException;

class StringLiteral
{
    /**
     * @var string
     */
    private $value;
    
    /**
     * StringLiteral constructor.
     * @param $value string
     * @throws \Exception
     */
    public function __construct($value)
    {
        if (!\is_string($value)) {
            throw new InvalidStringLiteralException($value);
        }
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }

    /**
     * @param StringLiteral $value
     * @return bool
     */
    public function equals(StringLiteral $value)
    {
        return $this->value === $value->__toString();
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return strlen($this->value) === 0;
    }
}
