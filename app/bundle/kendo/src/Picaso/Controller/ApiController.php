<?php

namespace Picaso\Controller;

use Picaso\Request\Request;
use Picaso\View\View;

/**
 * Class ApiController
 *
 * @package Picaso\Controller
 */
class ApiController implements Controller
{


    /**
     * @var \Picaso\View\View
     */
    protected $view;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->setRequest($request);
        $this->setView(null);
    }

    /**
     * @return \Picaso\View\View
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @param \Picaso\View\View $view
     */
    public function setView($view)
    {
        if (null == $view) {
            $view = new View();
        }
        $this->view = $view;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param Request $request
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
        return \App::routing()->redirect($name, $params);
    }

    /**
     * @param $url
     *
     * @return bool
     */
    public function redirectToUrl($url)
    {
        return \App::routing()->redirectToUrl($url);
    }
}