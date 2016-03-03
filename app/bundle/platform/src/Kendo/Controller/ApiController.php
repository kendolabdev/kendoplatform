<?php

namespace Kendo\Controller;

use Kendo\Http\HttpRequest;
use Kendo\View\View;

/**
 * Class ApiController
 *
 * @package Kendo\Controller
 */
class ApiController implements ControllerInterface
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
     * @return HttpRequest
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param HttpRequest $request
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
}