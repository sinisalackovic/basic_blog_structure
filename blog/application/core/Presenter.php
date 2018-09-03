<?php

namespace Core;

class Presenter
{
    /**
     * @param Response $response
     * @param $templateName
     * @throws \Exception
     */
    public function render(Response $response, $templateName)
    {
        $response->isOutputFormatTwig()
            ? $this->renderTwigData($response->getData(), $templateName)
            : $this->renderJsonData($response->getData());
    }

    /**
     * @return \Twig_Loader_Filesystem
     */
    private function getFilesystemLoader()
    {
        return new \Twig_Loader_Filesystem('application/templates');
    }

    /**
     * @return \Twig_Environment
     */
    private function getTemplateEngine()
    {
        $twig = new \Twig_Environment($this->getFilesystemLoader(), [
            'debug' => true,
        ]);

        $twig->addExtension(new \Twig_Extension_Debug());

        return $twig;
    }

    /**
     * @param $data
     * @param $templateName
     * @throws \Exception
     * @throws \Twig_Error_Runtime
     */
    private function renderTwigData($data, $templateName)
    {
        if (!$this->getFilesystemLoader()->exists($templateName)) {
            throw new \Exception('Twig template does not exist: ' . $templateName, 500);
        }

        echo $this->getTemplateEngine()
            ->loadTemplate($templateName)
            ->render($data);
    }

    /**
     * @param $data
     */
    private function renderJsonData($data)
    {
        echo json_encode($data);
    }
}
