<?php

namespace Kendo\Controller;

use Kendo\Http\HttpRequest;
use Kendo\View\View;

/**
 * Class DefaultController
 *
 * @package Kendo\Controller
 */
class DefaultController implements ControllerInterface
{

    /**
     * @var HttpRequest
     */
    protected $request;

    /**
     * @var \Kendo\View\View
     */
    protected $view;

    /**
     * @param HttpRequest $request
     */
    public function __construct(HttpRequest $request)
    {

        $this->setRequest($request);
        $this->setView(null);
        $this->init();
    }

    /**
     * Initialize
     * Call this method end of constructor
     * Override this method
     */
    protected function init()
    {
        app()->layouts()
            ->setPageName($this->request->getFullControllerName());
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
        if (null == $this->view) {
            $view = new View();
        }
        $this->view = $view;
    }

    /**
     * prepare content layout params
     */
    public function prepareRenderByContentLayoutParams()
    {
        $lp = app()->layouts()
            ->getContentLayoutParams();

        $this->view->setScript($lp);
    }

    /**
     * Before render process
     */
    protected function onBeforeRender()
    {
    }

    /**
     * @return string
     */
    public function render()
    {
        $this->onBeforeRender();

        return $this->view->render();
    }


    /**
     * @return bool
     */
    public function execute()
    {
        try {
            $accept = true;

            if (!$this->passNetworkBrowseMode()) {
                $accept = false;
                $this->request->forward('\Platform\User\Controller\AuthController', 'login');
            }

            if (!$this->passMaintenanceMode()) {
                $accept = false;
                $this->request->forward('\Platform\Core\Controller\MaintenanceController', 'index');
            }

            if ($accept) {
                $this->request->setDispatched(true);

                $methodName = $this->getMethodName();

                $this->{$methodName}();
            }
        } catch (\Exception $e) {
            $this->request->setException($e);
            $this->request->forward('\Platform\Core\Controller\ErrorController', 'exception');
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
     * @return bool
     */
    protected function passNetworkBrowseMode()
    {
        if (app()->auth()->logged())
            return true;

        return app()->setting('core', 'network_mode') ? false : true;
    }

    /**
     * @return bool
     */
    protected function passMaintenanceMode()
    {
        if (!app()->setting('core', 'maintenance'))
            return true;

        if (!empty($_SESSION['maintenance']) and $_SESSION['maintenance'] == app()->setting('core', 'maintenance_code'))
            return true;

        return false;
    }
}