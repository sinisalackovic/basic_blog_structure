<?php

namespace Core;

class HttpRequest
{
    /**
     * @var array
     */
    private $params = [];

    /**
     * Return the method by which the request was made
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->getServer('REQUEST_METHOD');
    }

    /**
     * Return the uri by which the request was made
     *
     * @return string
     */
    public function getUri()
    {
        return $this->getServer('REQUEST_URI');
    }

    /**
     * Retrieve a member of the $_SERVER super global
     *
     * If no $key is passed, returns the entire $_SERVER array.
     *
     * @param string $key
     * @param mixed $default Default value to use if key not found
     * @return mixed Returns null if key does not exist
     */
    public function getServer($key = null, $default = null)
    {
        if ($key == null) {
            return $_SERVER;
        }

        return (isset($_SERVER[$key])) ? $_SERVER[$key] : $default;
    }

    /**
     * Retrieve a parameter
     *
     * Retrieves a parameter from the instance. If a
     * parameter matching the $key is not found, null is returned.
     *
     * @param mixed $key
     * @param mixed $default Default value to use if key not found
     * @return mixed
     */
    public function getParam($key, $default = null)
    {
        if (isset($this->params[$key])) {
            return $this->params[$key];
        }

        return $default;
    }

    /**
     * Retrieve an array of parameters
     *
     * Retrieves a merged array of parameters
     *
     * @return array
     */
    public function getParams()
    {
        $params = $this->params;

        if(isset($_GET) && is_array($_GET)) {
            $params += $_GET;
        }

        if (isset($_POST) && is_array($_POST)) {
            $params += $_POST;
        }

        return $params;
    }

    /**
     * Check if a param exists
     *
     * @param $key
     * @return mixed
     */
    public function hasParam($key)
    {
        return array_key_exists($key, $this->getParams());
    }
}
