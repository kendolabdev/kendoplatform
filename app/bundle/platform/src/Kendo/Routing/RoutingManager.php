<?php

namespace Kendo\Routing;

use Kendo\Request\HttpRequest;
use Kendo\Request\RequestInterface;

/**
 * Class RoutingManager
 *
 * @package Kendo\Routing
 */
class RoutingManager
{
    /**
     * @var RequestInterface
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
     * Start to build routings
     */
    public function start()
    {
        $routings = \App::cacheService()
            ->get($cacheKey = 'platform_routing_start', 0);

        if (!$routings) {

            \App::emitter()
                ->emit('onRoutingStart', $this);

            \App::cacheService()
                ->set($cacheKey, serialize($this->byNames), 0);
        } else {

            $this->byNames = unserialize($routings);
        }


    }

    /**
     * @return RequestInterface
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
            if (!$route instanceof Route) continue;

            if (false != ($params = $route->match($path, $host))) {
                $request->setControllerName($params[ RequestInterface::CONTROLLER_KEY ]);
                $request->setActionName($params[ RequestInterface::ACTION_KEY ]);
                unset($params[ RequestInterface::CONTROLLER_KEY ], $params[ RequestInterface::ACTION_KEY ]);
                $request->setParams($params);

                \App::requestService()->setRouting($name, $params);

                return true;
            }
        }

        $request->setControllerName('\Platform\Core\Controller\ErrorController');
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
     * TODO: make IS_AJAX_LOAD_STATE more flexible
     *
     */
    public function redirectToUrl($url)
    {
        defined('IS_AJAX_LOAD_STATE') or define('IS_AJAX_LOAD_STATE', false);

        if (IS_AJAX_LOAD_STATE) {

            $require = \App::assetService()
                ->requirejs();

            $require->addScript('redirect', sprintf('replacePage("%s")', $url));

            exit(json_encode([
                'directive' => 'reload',
                'title'     => 'Untitled',
                'html'      => $require->renderScriptHtml(),
            ]));

        } else if (!headers_sent()) {
            header('location: ' . $url);
        } else {
        }

        return true;
    }
}