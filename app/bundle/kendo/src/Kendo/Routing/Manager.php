<?php

namespace Kendo\Routing;

use Kendo\Request\HttpRequest;
use Kendo\Request\Request;

/**
 * Class Manager
 *
 * @package Kendo\Routing
 */
class Manager
{
    /**
     * @var HttpRequest
     */
    private $request;

    /**
     * router by name
     *
     * @var array
     */
    private $byNames = [];

    /**
     * @ignore
     */
    public function __construct()
    {

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
     * has router
     *
     * @param string $name
     *
     * @return bool
     */
    function hasRoute($name)
    {
        return isset($this->byNames[ $name ]);
    }

    /**
     * @param  string $name
     *
     * @return Route
     * @throws \InvalidArgumentException
     */
    function getRoute($name)
    {

        if (!isset($this->byNames[ $name ])) {
            throw new \InvalidArgumentException("Route {$name} does not found!");
        }

        return $this->byNames[ $name ];
    }

    /**
     * @param string $name
     * @param array  $params
     *
     * @return Route
     */
    function addRoute($name, $params)
    {
        $class = null;
        switch (true) {
            case !empty($params['class']):
                $class = $params['class'];
                break;
            default:
                $class = '\\Kendo\\Routing\\Route';
        }

        return $this->byNames[ $name ] = new $class($name, $params);
    }

    /**
     * @param string $name
     * @param array  $params
     *
     * @return string
     */
    function getUrl($name, $params = [])
    {
        return $this->getRoute($name)->getUrl($params);
    }


    /**
     * @param HttpRequest $request
     *
     * @return bool
     */
    function match(HttpRequest $request)
    {
        $this->request = $request;

        /**
         * pre-filter to match request
         */
        $path = $request->getPath();

        $host = null;

        foreach ($this->byNames as $name => $route) {
            if (false != ($params = $route->match($path, $host))) {
                $request->setControllerName($params[ Request::CONTROLLER_KEY ]);
                $request->setActionName($params[ Request::ACTION_KEY ]);
                unset($params[ Request::CONTROLLER_KEY ], $params[ Request::ACTION_KEY ]);
                $request->setParams($params);

                \App::requestService()->setRouting($name, $params);

                return true;
            }
        }

        $request->setControllerName('\Core\Controller\Error');
        $request->setActionName('notfound');

        return true;
    }

    /**
     * @param string $name
     * @param array  $params
     *
     * @return true
     */
    public function redirect($name, $params = [])
    {
        $url = $this->getUrl($name, $params);

        $this->redirectToUrl($url);

        return true;
    }

    /**
     * @param $url
     *
     * @return true
     */
    public function redirectToUrl($url)
    {
        if (IS_AJAX_LOAD_STATE) {

            $require = \App::assetService()
                ->requirejs();

            $require->addScript('redirect', sprintf('replacePage("%s")', $url));

            exit(json_encode([
                'directive' => 'reload',
                'title'     => 'Untitled',
                'html'      => $require->renderScriptHtml(),
            ]));

        } else {
            header('location: ' . $url);
        }

        return true;
    }


}