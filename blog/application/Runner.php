<?php

namespace App;

use Core\Constants;
use Core\Presenter;
use Core\HttpRequest;
use Core\Application;
use Core\RunnerInterface;

class Runner implements RunnerInterface
{
    /**
     * @var Application
     */
    private $application;

    /**
     * @var string
     */
    private $applicationService;

    /**
     * @var string
     */
    private $applicationMethod;

    /**
     * @var HttpRequest
     */
    private $httpRequest;

    public function run()
    {
        $this->sessionStart();

        $this
            ->parseApplicationService()
            ->parseApplicationMethod();

        $this->application = new Application($this);
        $this->application->run();

        $templatePath = join('/', [
            strtolower($this->getApplicationService()),
            strtolower($this->getApplicationMethod()),
        ]);

        (new Presenter())->render(
            $this->application->getResponse(),
            $templatePath.'.twig'
        );
    }

    /**
     * @return string
     */
    public function getApplicationService()
    {
        return $this->applicationService;
    }

    /**
     * @return string
     */
    public function getApplicationMethod()
    {
        return $this->applicationMethod;
    }

    /**
     * @return array
     */
    public function getApplicationParams()
    {
        return $this->getHttpRequest()->getParams();
    }

    /**
     * Do lazy load first or create a new instance
     *
     * @return HttpRequest
     */
    public function getHttpRequest()
    {
        if(!$this->httpRequest instanceof HttpRequest) {
            $this->httpRequest = new HttpRequest();
        }
        return $this->httpRequest;
    }

    /**
     * @return $this
     */
    private function parseApplicationService()
    {
        $service = trim(parse_url($this->getHttpRequest()->getUri(), PHP_URL_PATH), "/");

        $this->applicationService = empty($service)
            ? 'Index'
            : ucwords($service);

        return $this;
    }

    /**
     * @return $this
     */
    private function parseApplicationMethod()
    {
        $method = $this->getHttpRequest()->getMethod();
        $id     = $this->getHttpRequest()->hasParam('id');

        $this->applicationMethod = ($method == "GET" && empty($id))
            ? 'Index'
            : ucwords(strtolower($method));

        return $this;
    }

    private function sessionStart()
    {
        session_save_path(Constants::PATH_SESSION);
        ini_set('session.save_path', Constants::PATH_SESSION);
    }
}
