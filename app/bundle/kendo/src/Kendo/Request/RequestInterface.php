<?php

namespace Kendo\Request;

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
    public function execute();

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
     * @return Result
     */
    public function getResult();

    /**
     * @return mixed
     */
    public function getResponse();

    /**
     * @return string
     */
    public function getMethod();
}
