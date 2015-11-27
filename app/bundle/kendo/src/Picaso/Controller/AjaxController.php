<?php

namespace Picaso\Controller;

use Picaso\Request\HttpRequest;

/**
 * Class AjaxController
 *
 * @package Picaso\Controller
 */
class AjaxController implements Controller
{
    /**
     * @var HttpRequest
     */
    protected $request;

    /**
     * @var array
     */
    protected $response = [];

    /**
     * @param HttpRequest $request
     */
    public function __construct(HttpRequest $request)
    {
        $this->request = $request;
        $this->init();
    }

    protected function init()
    {
        header('Content-Type: application/json');
    }

    /**
     * @param string $script
     * @param array  $data
     *
     * @return string
     */
    public function partial($script, $data)
    {
        return \App::viewHelper()->partial($script, $data);
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function execute()
    {
        try {
            $this->request->setDispatched(true);

            $methodName = $this->getMethodName();

            if (!method_exists($this, $methodName)) {
                throw new \InvalidArgumentException("method does not exists");
            }

            $this->{$methodName}();

        } catch (\Exception $e) {
            $this->request->setException($e);
            $this->forward('\Core\Controller\Ajax\ErrorController', 'exception');
        }

        return true;
    }

    /**
     * @return string
     * @throws NotFoundException
     */
    protected function getMethodName()
    {
        $methodName = 'action' . str_replace(' ', '', ucwords(str_replace(['_', '-', '.'], [' ', ' ', ' '], $this->request->getActionName())));

        if (!method_exists($this, $methodName)) {
            $msg = strtr(":controller:::method does not support", [
                ':controller' => $this->request->getControllerName(),
                ':method'     => $methodName,
            ]);
            throw new NotFoundException($msg);
        }

        return $methodName;
    }

    /**
     * @param string $controllerName
     * @param string $actionName
     *
     * @return true
     */
    public function forward($controllerName, $actionName)
    {
        $this->request->forward($controllerName, $actionName, false);

        return true;
    }

    /**
     * @return string
     */
    public function render()
    {
        return json_encode($this->response);
    }

    /**
     * @param string $name
     * @param array  $params
     *
     * @return true
     */
    public function redirect($name, $params = null)
    {
        return \App::routingService()->redirect($name, $params);
    }

    /**
     * @param $url
     *
     * @return bool
     */
    public function redirectToUrl($url)
    {
        return \App::routingService()->redirectToUrl($url);
    }
}