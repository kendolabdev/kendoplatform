<?php

namespace Picaso\Controller;

use Picaso\Request\HttpRequest;
use Picaso\View\View;

/**
 * Class DefaultController
 *
 * @package Picaso\Controller
 */
class DefaultController implements Controller
{

    /**
     * @var HttpRequest
     */
    protected $request;

    /**
     * @var \Picaso\View\View
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
        \App::layoutService()
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
        $lp = \App::layoutService()
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
                $this->forward('\User\Controller\AuthController', 'login');
            }

            if (!$this->passMaintenanceMode()) {
                $accept = false;
                $this->forward('\Core\Controller\MaintenanceController', 'index');
            }

            if ($accept) {
                $this->request->setDispatched(true);

                $methodName = $this->getMethodName();

                $this->{$methodName}();
            }
        } catch (\Exception $e) {
            $this->request->setException($e);
            $this->forward('\Core\Controller\ErrorController', 'exception');
        }

        return true;
    }


    /**
     * @param string $controllerName
     * @param string $actionName
     *
     * @return bool
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
            $msg = strtr(":controller:::method does not support", [
                ':controller' => $this->request->getControllerName(),
                ':method'     => $methodName,
            ]);
            throw new NotFoundException($msg);
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

    /**
     * @return bool
     */
    protected function passNetworkBrowseMode()
    {
        if (\App::authService()->logged())
            return true;

        return \App::setting('core', 'network_mode') ? false : true;
    }

    /**
     * @return bool
     */
    protected function passMaintenanceMode()
    {
        if (!\App::setting('core', 'maintenance'))
            return true;

        if (!empty($_SESSION['maintenance']) and $_SESSION['maintenance'] == \App::setting('core', 'maintenance_code'))
            return true;

        return false;
    }
}