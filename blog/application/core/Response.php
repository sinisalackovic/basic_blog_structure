<?php

namespace Core;

class Response
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var string
     */
    private $outputFormat;

    /**
     * @var int
     */
    private $httpResponseCode;

    /**
     * Response constructor.
     */
    public function __construct()
    {
        $this->outputFormat = Constants::OUTPUT_FORMAT_DEFAULT;
    }

    /**
     * @param $httpResponseCode
     * @return $this
     */
    public function setHttpResponseCode($httpResponseCode)
    {
        $this->httpResponseCode = $httpResponseCode;
        return $this;
    }

    /**
     * @param $outputFormat
     * @return $this
     */
    public function setOutputFormat($outputFormat)
    {
        $this->outputFormat = $outputFormat;
        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return bool
     */
    public function isOutputFormatTwig()
    {
        return $this->outputFormat === Constants::OUTPUT_FORMAT_DEFAULT;
    }
}
