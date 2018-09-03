<?php

namespace Common;

class Collection implements \Iterator, \Countable
{

    /**
     * @var string
     */
    private $factory;

    /**
     * @var array
     */
    private $keyMap;

    /**
     * @var array
     */
    private $objects;

    /**
     * @var int
     */
    private $pointer;

    /**
     * @var array
     */
    private $rawData;

    /**
     * @var int
     */
    private $total;

    /**
     * Collection constructor.
     * @param array $rawData
     * @param $factory
     */
    public function __construct(array $rawData, $factory)
    {
        $this->factory = $factory;
        $this->keyMap  = array_keys($rawData);
        $this->objects = [];
        $this->pointer = 0;
        $this->rawData = $rawData;
    }

    /**
     * @return int
     */
    public function count()
    {
        if ($this->total === null) {
            $this->total = count($this->rawData);
        }
        return $this->total;
    }

    /**
     * @return mixed|null
     */
    public function current()
    {
        if ($this->pointer >= $this->count()) {
            return null;
        }
        if ($this->hasCurrentObject()) {
            return $this->currentObject();
        }
        if ($this->hasCurrentRawData()) {
            $this->addCurrentRawDataToObjects();
            return $this->currentObject();
        }
    }

    /**
     * @return array
     */
    public function getRawData()
    {
        return $this->rawData;
    }

    public function hasData()
    {
        return $this->count() > 0;
    }

    /**
     * @return int
     */
    public function key()
    {
        return $this->pointer;
    }

    public function next()
    {
        if ($this->pointer < $this->count()) {
            $this->pointer++;
        }
    }

    public function rewind()
    {
        $this->pointer = 0;
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return $this->current() !== null;
    }

    private function addCurrentRawDataToObjects()
    {
        $this->factory->set(new Dictionary($this->currentRawData()));
        $this->objects[$this->pointer] = $this->factory->reconstitute();
    }

    /**
     * @return array
     */
    private function currentRawData()
    {
        return $this->rawData[$this->keyMap[$this->pointer]];
    }

    /**
     * @return bool
     */
    private function hasCurrentObject()
    {
        return isset($this->objects[$this->pointer]);
    }

    /**
     * @return bool
     */
    private function hasCurrentRawData()
    {
        return isset($this->rawData[$this->keyMap[$this->pointer]]);
    }

    /**
     * @return mixed|null
     */
    private function currentObject()
    {
        return $this->hasCurrentObject()
            ? $this->objects[$this->pointer]
            : null;
    }
}
