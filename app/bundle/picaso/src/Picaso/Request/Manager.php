<?php

namespace Picaso\Request;

/**
 * Class Manager
 *
 * @package Picaso\Request
 */
class Manager
{

    /**
     * @var Request
     */
    private $initiator;

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
     * Default constructor
     */
    public function __construct()
    {

    }

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
     * @return HttpRequest
     */
    public function getInitiator()
    {
        if (null == $this->initiator) {
            $this->initiator = $this->makeInitiator();
        }

        return $this->initiator;
    }

    /**
     * @param Request $initiator
     */
    public function setInitiator($initiator)
    {
        $this->initiator = $initiator;
    }

    /**
     * @return Request
     */
    public function makeInitiator()
    {
        $requestUri = substr($_SERVER['REQUEST_URI'], strlen(PICASO_BASE_DIR));

        $request = new HttpRequest($requestUri);

        $request->setMethod($_SERVER['REQUEST_METHOD']);

        return $request;

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

}