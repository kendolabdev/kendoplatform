<?php

namespace Picaso\Controller;

use Picaso\Request\HttpRequest;

/**
 * Interface Controller
 *
 * @package Picaso\Controller
 */
interface Controller
{

    /**
     * @param HttpRequest $request
     */
    public function __construct(HttpRequest $request);

    /**
     * @return bool
     */
    public function execute();

    /**
     * @param string $controllerName
     * @param string $actionName
     */
    public function forward($controllerName, $actionName);

    /**
     * @return string
     */
    public function render();

    /**
     * @param string $name
     * @param array  $params
     *
     * @return true
     */
    public function redirect($name, $params = null);

    /**
     * @param string $url
     *
     * @return true
     */
    public function redirectToUrl($url);
}