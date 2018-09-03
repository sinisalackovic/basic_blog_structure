<?php

namespace Core;

class Request
{
    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $serviceName;

    /**
     * @var array
     */
    private $params;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->params = [];
    }

    /**
     * @param $method
     * @return $this
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @param $serviceName
     * @return $this
     */
    public function setServiceName($serviceName)
    {
        $this->serviceName = $serviceName;
        return $this;
    }

    /**
     * @param array $params
     * @return $this
     */
    public function setParams(array $params)
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @return string
     */
    public function getServiceName()
    {
        return $this->serviceName;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function getParam($key)
    {
        if (array_key_exists($key, $this->params)) {
            return $this->params[$key];
        }
    }
}
