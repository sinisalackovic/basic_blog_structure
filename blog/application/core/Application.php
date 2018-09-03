<?php

namespace Core;

class Application
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
     * @var FrontController
     */
    private $frontController;

    /**
     * Application constructor.
     * @param RunnerInterface $runner
     */
    public function __construct(RunnerInterface $runner)
    {
        $request = new Request();
        $request->setServiceName($runner->getApplicationService());
        $request->setMethod($runner->getApplicationMethod());
        $request->setParams($runner->getApplicationParams());

        $this->request = $request;
    }

    public function run()
    {
        try {
            $this->runFrontController();
        } catch (\Exception $exception) {
            echo "<pre>"; var_dump($exception); die;
        }
    }

    /**
     * @return FrontController
     */
    public function getFrontController()
    {
        if (!$this->frontController instanceof FrontController) {
            $this->frontController = new FrontController();
        }
        return $this->frontController;
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        if (!$this->response instanceof Response) {
            $this->response = new Response();
        }
        return $this->response;
    }

    /**
     * @return $this
     */
    private function runFrontController()
    {
        $this->getFrontController()
            ->setRequest($this->request)
            ->setResponse($this->getResponse())
            ->run();

        $this->response = $this->getFrontController()->getResponse();
        return $this;
    }
}
