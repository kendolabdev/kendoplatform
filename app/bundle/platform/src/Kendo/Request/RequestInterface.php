<?php

namespace Kendo\Request;

use Kendo\Response\ResponseInterface;

/**
 * Interface Request
 *
 * @package Kendo\Request
 */
interface RequestInterface
{
    /**
     * Controller key
     */
    const CONTROLLER_KEY = 'controller';

    /**
     * Action key
     */
    const ACTION_KEY = 'action';

    /**
     * @param string $name
     * @param mixed  $defaultValue
     *
     * @return mixed
     */
    public function getParam($name, $defaultValue = null);

    /**
     * @param string $name
     * @param mixed  $value
     */
    public function setParam($name, $value);

    /**
     * @return array
     */
    public function getParams();

    /**
     * @param array $params
     */
    public function setParams($params);

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function __get($name);

    /**
     * @param string $name
     * @param mixed  $value
     */
    public function __set($name, $value);

    /**
     * @return bool
     */
    public function isDispatched();

    /**
     * @param bool $value
     */
    public function setDispatched($value);

    /**
     * @return bool
     */
    public function dispatch();

    /**
     * @param  string $controllerName
     * @param  string $actionName
     * @param  bool   $dispatched
     */
    public function forward($controllerName, $actionName, $dispatched = false);

    /**
     * @return string
     */
    public function getControllerName();

    /**
     * @param string $value
     */
    public function setControllerName($value);

    /**
     * @return string
     */
    public function getActionName();

    /**
     * @param string $value
     */
    public function setActionName($value);

    /**
     * @return ResponseInterface
     */
    public function getResponse();

    /**
     * @return string
     */
    public function getMethod();

    /**
     * @return bool
     */
    public function isAjaxFragment();

    /**
     * @return bool
     */
    public function isAjax();

    /**
     * @return bool
     */
    public function isGet();

    /**
     * @return bool
     */
    public function isPost();

    /**
     * @return bool
     */
    public function isDelete();

    /**
     * @return bool
     */
    public function isOptions();

    /**
     * @return bool
     */
    public function isHead();
}
