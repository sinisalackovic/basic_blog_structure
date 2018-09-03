<?php

namespace Common;

class Dictionary
{
    /**
     * @var array
     */
    private $data;

    /**
     * Dictionary constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function add($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    /**
     * @return integer
     */
    public function count()
    {
        return count($this->data);
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function get($key)
    {
        return $this->has($key)
            ? $this->data[$key]
            : null;
    }

    /**
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return array_key_exists($key, $this->data);
    }

    /**
     * @param $key
     * @return bool
     */
    public function hasNonEmptyValue($key)
    {
        return $this->has($key) && !empty($this->data[$key]);
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->data;
    }
}
