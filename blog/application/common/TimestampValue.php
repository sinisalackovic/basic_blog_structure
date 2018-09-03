<?php

namespace Common;

use Exception\MissingTimestampValueException;

class TimestampValue
{
    /**
     * @var int
     */
    private $value;

    /**
     * TimestampValue constructor.
     * @param $value
     * @throws MissingTimestampValueException
     */
    public function __construct($value)
    {
        if (empty($value)) {
            throw new MissingTimestampValueException();
        }

        $this->value = $value;
    }
    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->value;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return (int) $this->value;
    }

    /**
     * @param string $format
     * @return string
     */
    public function getFormatted($format = 'Y-m-d')
    {
        return date($format, $this->value);
    }
}
