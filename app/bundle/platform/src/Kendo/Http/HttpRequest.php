<?php

namespace Kendo\Http;

use Kendo\Controller\ControllerInterface;

/**
 * Class HttpRequest
 *
 * @package Kendo\Request
 */
class HttpRequest
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
     * @var HttpResponse
     */
    protected $response;

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
    public function __construct($url = null)
    {
        if ($url) {
            $this->initWithUrl($url);
        }
    }

    public function initWithUrl($url)
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
        $this->setParams(array_merge($query, $fragment));
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
     * <code>
     *
     * list($var1,$var2,$var3)  = $request->getList('var1','var2','var3')
     *
     * <code>
     * @return array
     */
    public function getList()
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
        $this->getList();

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
    public function dispatch()
    {

        try {
            if (!$this->getControllerName()) {
                app()->routing()->resolve($this);
            }
        } catch (\Exception $ex) {
            $this->setControllerName('\Platform\Core\Controller\ErrorController');
            $this->setException($ex);
        }

        $step = 0;

        while ($this->isDispatched() == false && $step < 4) {
            // increment step at first to
            ++$step;
            $controllerName = $this->getControllerName();

            try {
                if (!class_exists($controllerName)) {
                    throw new \RuntimeException('Missing class ' . $controllerName);
                } else {

                    $controller = new $controllerName($this);

                    if (!$controller instanceof ControllerInterface) {
                        $this->forward('Platform\Core\Controller\ErrorController', '404');
                    }

                    $controller->execute();

                    if ($this->dispatched) {
                        $this->getResponse()->setContent($controller->render());
                    }

                }
            } catch (\Exception $e) {
                var_dump($e);
                $this->setException($e);
                $this->forward('Platform\Core\Controller\ErrorController', 'exception');
            }
        }

        return false;
    }

    /**
     * Is ajax fragment request
     *
     * @return bool
     */
    public function isAjaxFragment()
    {
        return !!$this->getParam('__ajax_load_page');
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
        $this->controllerName = '\\' . trim((string)$value, '\\');
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
     * @return HttpResponse
     */
    public function getResponse()
    {
        if (null == $this->response) {
            $this->response = new HttpResponse($this);
        }

        return $this->response;
    }

    /**
     * @param HttpResponse $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
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
     * Forward request
     *
     * @param  string $controllerName Controller Name
     * @param  string $actionName     Action Name
     *
     * @return true
     */
    public function forward($controllerName, $actionName)
    {

        if (null != $controllerName) {
            $this->setControllerName($controllerName);
        }

        if (null != $actionName) {
            $this->setActionName($actionName);
        }

        $this->setDispatched(false);

        return true;
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
        return str_replace('_controller', '', _underscore([$this->getControllerName(), $this->getActionName()]));
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

        $method = strtoupper((string)$method);

        if (!in_array($method, ['GET', 'POST', 'DELETE', 'PUT', 'DELETE', 'OPTIONS'])) {
            $method = 'GET';
        }

        $this->method = $method;
    }

    /**
     * @param string $method
     *
     * @return bool
     */
    public function isMethod($method)
    {
        if (is_array($method)) {
            return in_array($this->getMethod(), array_map("strtoupper", $method));
        }

        return strtoupper($method) == $this->getMethod();
    }

    /**
     * @return bool
     */
    public function isGet()
    {
        return $this->getMethod() == 'GET';
    }

    /**
     * @param string $routeName
     * @param array  $params
     * @param int    $httpStatusCode
     *
     * @return bool
     */
    public function redirect($routeName, $params = [], $httpStatusCode = 401)
    {
        $this->redirectToUrl(app()->routing()->getUrl($routeName, $params), $httpStatusCode);

        return true;
    }

    /**
     * @param string $url
     * @param int    $httpStatusCode
     *
     * @return bool
     */
    public function redirectToUrl($url, $httpStatusCode = 401)
    {
        if ($this->isAjaxFragment()) {

            $require = app()->assetService()
                ->requirejs();

            $require->addScript('redirect', sprintf('replacePage("%s")', $url));

            exit(json_encode([
                'directive' => 'reload',
                'title'     => 'Untitled',
                'html'      => $require->renderScriptHtml(),
            ]));
        } else if (!headers_sent()) {
            http_response_code($httpStatusCode);
            header('location: ' . $url);
        } else {
            // how to process this case
        }

        return true;
    }
}