<?php

namespace Kendo\Controller;

use Kendo\Request\HttpRequest;
use Kendo\Request\RequestInterface;
use Kendo\View\View;

/**
 * Class ApiController
 *
 * @package Kendo\Controller
 */
class ApiController implements Controller
{


    /**
     * @var \Kendo\View\View
     */
    protected $view;

    /**
     * @var HttpRequest
     */
    protected $request;

    /**
     * @param HttpRequest $request
     */
    public function __construct(HttpRequest $request)
    {
        $this->setRequest($request);
        $this->setView(null);
    }

    /**
     * @return \Kendo\View\View
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @param \Kendo\View\View $view
     */
    public function setView($view)
    {
        if (null == $view) {
            $view = new View();
        }
        $this->view = $view;
    }

    /**
     * @return RequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param RequestInterface $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * @return string
     */
    public function render()
    {
        return $this->view->render();
    }

    /**
     * @return bool
     */
    public function execute()
    {
        $this->request->setDispatched(true);

        $methodName = $this->getMethodName();

        $this->{$methodName}();

        return true;
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
     * @throws NotFoundException
     */
    protected function getMethodName()
    {
        $methodName = 'action' . str_replace(' ', '', ucwords(str_replace(['_', '-', '.'], [' ', ' ', ' '], $this->request->getActionName())));

        if (!method_exists($this, $methodName)) {
            throw new NotFoundException("$methodName does not support in " . get_class($this));
        }

        return $methodName;
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