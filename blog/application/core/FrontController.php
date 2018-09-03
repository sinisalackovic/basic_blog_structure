<?php

namespace Core;

class FrontController
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var Response
     */
    private $response;

    /**
     * @var ServiceAbstract
     */
    private $service;

    /**
     * @var string
     */
    private $fullServiceName;

    public function run()
    {
        $this->isDispatchable()
            ? $this->dispatch()
            : $this->response->setHttpResponseCode(404);
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @param Response $response
     * @return $this
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;
        return $this;
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return bool
     */
    public function isDispatchable()
    {
        $this
            ->constructFullServiceName()
            ->serviceFactory();

        return $this->service instanceof ServiceAbstract;
    }

    private function dispatch()
    {
        $this->service
            ->setRequest($this->request)
            ->setResponse($this->response)
            ->run();
    }

    /**
     * @return $this
     */
    private function constructFullServiceName()
    {
        $this->fullServiceName = join('\\', [
            'Service',
            $this->request->getServiceName(),
            $this->request->getMethod()
        ]);

        return $this;
    }

    /**
     * @return bool
     */
    private function serviceExist()
    {
        return class_exists($this->fullServiceName);
    }

    /**
     * @return $this
     */
    private function serviceFactory()
    {
        if ($this->serviceExist()) {
            $serviceName   = $this->fullServiceName;
            $this->service = new $serviceName();
        }
        return $this;
    }
}
