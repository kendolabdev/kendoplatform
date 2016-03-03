<?php

namespace Kendo\Http;

use Kendo\Kernel\Application;
use Kendo\Kernel\ServiceInterface;

/**
 * Class Manager
 *
 * @package Kendo\Request
 */
class RequestManager extends HttpRequest implements ServiceInterface
{

    protected $app;

    /**
     * @var string
     */
    private $routeName;

    /**
     * @var array
     */
    private $routeParams;

    /**
     * @var Browser
     */
    private $browser;

    /**
     * @return string
     */
    public function getRouteName()
    {
        return $this->routeName;
    }

    /**
     * @param string $routeName
     */
    public function setRouteName($routeName)
    {
        $this->routeName = $routeName;
    }

    /**
     * @return array
     */
    public function getRouteParams()
    {
        return $this->routeParams;
    }

    /**
     * @param array $routeParams
     */
    public function setRouteParams($routeParams)
    {
        $this->routeParams = $routeParams;
    }


    /**
     * @param $name
     * @param $params
     */
    public function setRouting($name, $params)
    {
        $this->setRouteName($name);
        $this->setRouteParams($params);
    }

    /**
     *
     */
    public function getRouting()
    {
        return [$this->routeName, $this->routeParams];
    }

    /**
     * @return bool
     */
    public function isMobile()
    {
        return $this->getBrowser()->isMobile();
    }

    /**
     * @return Browser
     */
    public function getBrowser()
    {
        if (null == $this->browser) {
            $this->browser = new Browser();
        }

        return $this->browser;
    }

    /**
     * @return bool
     */
    public function isTablet()
    {
        return $this->getBrowser()->isTablet();
    }

    /**
     * @param \Kendo\Kernel\Application $app
     */
    public function bind(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @return array
     */
    public function alias()
    {
        return [];
    }

    /**
     *
     */
    public function bound()
    {
        $requestMethod = empty($_SERVER['REQUEST_METHOD']) ? 'GET' : $_SERVER['REQUEST_METHOD'];
        $requestUri = empty($_SERVER['REQUEST_URI']) ? '/' : $_SERVER['REQUEST_URI'];
        $requestUri = substr($requestUri, strlen(KENDO_BASE_DIR));
        $this->initWithUrl($requestUri);
        $this->setMethod($requestMethod);
        // set all params
        if (!empty($_REQUEST)) {
            $this->setParams($_REQUEST);
        }
    }
}