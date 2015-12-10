<?php

namespace Kendo\Request;

use Kendo\Controller\Controller;

/**
 * Class HttpRequest
 *
 * @package Kendo\Request
 */
class HttpRequest implements RequestInterface
{
    /**
     * @var \Exception
     */
    protected $exception;

    /**
     * @var string
     */
    protected $method = 'GET';

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @var string
     */
    protected $controllerName;

    /**
     * @var string
     */
    protected $actionName;

    /**
     * @var bool
     */
    protected $dispatched = false;

    /**
     * @var HttpResult
     */
    protected $result;

    /**
     * @var string
     */
    protected $path = '';

    /**
     * @var array
     */
    protected $query = [];

    /**
     * @var array
     */
    protected $fragment = [];

    /**
     * @param string $url
     */
    public function __construct($url)
    {
        $result = parse_url($url);
        $query = [];
        $fragment = [];
        $path = '';

        if (isset($result['path'])) {
            $path = $result['path'];
        }

        if (isset($result['query'])) {
            parse_str($result['query'], $query);
        }

        if (isset($result['fragment'])) {
            parse_str($result['fragment'], $fragment);
        }

        if (substr($path, 0, strlen(KENDO_BASE_URL)) == KENDO_BASE_URL) {
            $path = substr($path, strlen(KENDO_BASE_URL));
        }

        $this->setPath($path);
        $this->setQuery($query);
        $this->setFragment($fragment);

        // set all params
        if (!empty($_REQUEST)) {
            $this->setParams($_REQUEST);
        } else {
            $this->setParams(array_merge($query, $fragment));
        }
    }

    /**
     * @return \Exception
     */
    public function getException()
    {
        return $this->exception;
    }

    /**
     * @param \Exception $exception
     */
    public function setException($exception)
    {
        $this->exception = $exception;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        if (null == $this->path) {
            $this->path = '/';
        }

        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        if (empty($path)) {
            $path = '/';
        } else {
            $path = trim($path, '/');
        }
        $this->path = $path;
    }

    /**
     * @return array
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param array $query
     */
    public function setQuery($query)
    {
        $this->query = $query;
    }

    /**
     * @return array
     */
    public function getFragment()
    {
        return $this->fragment;
    }

    /**
     * @param array $fragment
     */
    public function setFragment($fragment)
    {
        $this->fragment = $fragment;
    }

    /**
     * @param string $name
     * @param int    $defaultValue
     *
     * @return int
     */
    public function getInt($name, $defaultValue = 0)
    {
        return (int)$this->getParam($name, $defaultValue);
    }

    /**
     * @param string $name
     * @param mixed  $defaultValue
     *
     * @return mixed
     */
    public function getParam($name, $defaultValue = null)
    {
        return !empty($this->params[ $name ]) ? $this->params[ $name ] : $defaultValue;
    }

    /**
     * @param        $name
     * @param string $defaultValue
     *
     * @return string
     */
    public function getString($name, $defaultValue = '')
    {
        return (string)$this->getParam($name, $defaultValue);
    }

    /**
     * @param       $name
     * @param array $defaultValue
     *
     * @return array
     */
    public function getArray($name, $defaultValue = [])
    {
        return isset($this->params[ $name ]) ? $this->params[ $name ] : $defaultValue;

    }

    /**
     * @param string $name
     * @param mixed  $value
     */
    public function setParam($name, $value)
    {
        $this->params[ $name ] = $value;
    }

    /**
     * @return array
     */
    public function get()
    {
        $ret = [];
        foreach (func_get_args() as $key) {
            $ret[] = $this->getParam($key);
        }

        return $ret;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param array $params
     */
    public function setParams($params)
    {
        foreach ($params as $name => $value) {
            $this->setParam($name, $value);
        }
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        return isset($this->params[ $name ]) ? $this->params[ $name ] : null;
    }


    /**
     * @param string $name
     * @param mixed  $value
     */
    public function __set($name, $value)
    {
        $this->params[ $name ] = $value;
    }

    /**
     * @return bool
     */
    public function execute()
    {

        if (!$this->getControllerName()) {
            \App::routingService()->match($this);
        }

        $step = 0;

        while ($this->isDispatched() == false && $step < 4) {
            // increment step at first to
            ++$step;
            $controllerClass = $this->getControllerName();

            try {

                if (!class_exists($controllerClass)) {
                    $this->forward('\Core\Controller\ErrorController', '404', false);
                } else {
                    $controller = new $controllerClass($this);

                    if (!$controller instanceof Controller) {
                        $this->forward('\Core\Controller\ErrorController', '404', false);
                    }

                    $controller->execute();

                    if ($this->dispatched)
                        $this->getResult()->setData($controller->render());
                }
            } catch (\Exception $e) {
                $this->setException($e);
                $this->forward('\Core\Controller\ErrorController', 'exception', false);
            }
        }

        return false;
    }

    /**
     * @return string
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * @param string $value
     */
    public function setControllerName($value)
    {
        $this->controllerName = (string)$value;
    }

    /**
     * @return bool
     */
    public function isDispatched()
    {
        return $this->dispatched;
    }

    /**
     * @param bool $value
     */
    public function setDispatched($value)
    {
        $this->dispatched = (bool)$value;
    }

    /**
     * @return HttpResult
     */
    public function getResult()
    {
        if (null == $this->result) {
            $this->result = new HttpResult();
        }

        return $this->result;
    }

    /**
     * @param HttpResult $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }

    /**
     * @return bool
     */
    public function isAjax()
    {
        return ('XMLHttpRequest' == $this->getHeader('X_REQUESTED_WITH'));
    }

    /**
     * @param string $name
     * @param null   $defaultValue
     *
     * @return mixed
     */
    public function getHeader($name, $defaultValue = null)
    {

        // Try to get it from the $_SERVER array first
        $checkName = 'HTTP_' . strtoupper(str_replace('-', '_', $name));
        if (isset($_SERVER[ $checkName ])) {
            return $_SERVER[ $checkName ];
        }


        if (function_exists('apache_request_headers')) {
            $headers = apache_request_headers();

            if (isset($headers[ $name ])) {
                return $headers[ $name ];
            }

            $name = strtolower($name);

            foreach ($headers as $key => $value) {
                if (strtolower($key) == $name) {
                    return $value;
                }
            }
        }

        return $defaultValue;
    }

    /**
     * @return bool
     */
    public function isPAjax()
    {
        return (null != $this->getHeader('X_PJAX'));
    }

    /**
     * @param  string $controllerName
     * @param  string $actionName
     * @param  bool   $dispatched
     */
    public function forward($controllerName, $actionName, $dispatched = false)
    {
        if (null != $controllerName) {
            $this->setControllerName($controllerName);
        }

        if (null != $actionName) {
            $this->setActionName($actionName);
        }

        $this->setDispatched($dispatched);
    }

    /**
     * @return string
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * @param string $value
     */
    public function setActionName($value)
    {
        $this->actionName = (string)$value;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->getResult()->getData();
    }

    /**
     * @return array
     */
    public function getGET()
    {
        return (array)$_GET;
    }

    /**
     * @return array
     */
    public function getPOST()
    {
        return (array)$_POST;
    }

    /**
     * @return bool
     */
    public function isPost()
    {
        return $this->getMethod() == 'POST';
    }

    /**
     * @return string
     */
    public function getFullControllerName()
    {
        $temp = trim(strtolower($this->getControllerName() . '.' . $this->getActionName()), '\\');

        return preg_replace('#\W+#mi', '_', str_replace('controller', '', $temp));
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod($method)
    {
        $this->method = strtoupper($method);
    }

    /**
     * @return bool
     */
    public function isGet()
    {
        return $this->getMethod() == 'GET';
    }

    /**
     * @return bool
     */
    public function isPut()
    {
        return $this->getMethod() == 'PUT';
    }

    /**
     * @return bool
     */
    public function isDelete()
    {
        return $this->getMethod() == 'DELETE';
    }

    /**
     * @return bool
     */
    public function isOptions()
    {
        return $this->getMethod() == 'OPTIONS';
    }

}