<?php

namespace Common;

use Exception\InvalidEmailException;
use Exception\MissingEmailValueException;

class Email
{
    /**
     * @var string
     */
    private $value;

    /**
     * Email constructor.
     * @param string $value
     * @throws MissingEmailValueException
     * @throws InvalidEmailException
     */
    public function __construct($value)
    {
        if (empty($value)) {
            throw new MissingEmailValueException($value);
        }

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException($value);
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
}
