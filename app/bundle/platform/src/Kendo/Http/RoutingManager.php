<?php

namespace Kendo\Http;

use Kendo\Kernel\Application;
use Kendo\Kernel\KernelServiceAgreement;

/**
 * Class RoutingManager
 *
 * @package Kendo\Routing
 */
class RoutingManager extends KernelServiceAgreement
{

    /**
     * router by name
     *
     * @var Router[]
     */
    private $masters = [];

    /**
     * Children router by name
     *
     * @var Router[]
     */
    private $children = [];

    /**
     * @var array
     */
    private $indexs = [];

    /**
     * @var array
     */
    private $temporary = [];

    /**
     * @param \Kendo\Kernel\Application $app
     */
    public function bind(Application $app)
    {
        parent::bind($app);
    }


    /**
     * Start to build routings
     */
    public function bound()
    {
        $routings = \App::cacheService()
            ->get($cacheKey = 'platform_routing_start', 0);

        if (!$routings) {

            \App::emitter()->emit('onRoutingStart', $this);

            $this->compileRoutes();

            \App::cacheService()
                ->set($cacheKey, serialize([$this->masters, $this->children, $this->indexs]), 0);

        } else {
            list($this->masters, $this->children, $this->indexs) = unserialize($routings);
        }
    }

    /**
     * has router
     *
     * @param string $name
     *
     * @return bool
     */
    public function hasRoute($name)
    {
        return isset($this->masters[ $name ]);
    }

    /**
     * @param  string $name
     *
     * @return Router
     * @throws \InvalidArgumentException
     */
    public function getRoute($name)
    {
        if (isset($this->masters[ $name ])) {
            return $this->masters[ $name ];

        }

        if (isset($this->children[ $name ])) {
            return $this->children[ $name ];
        }

        throw new \InvalidArgumentException(sprintf('Unexpected route "%s"', $name));


    }

    /**
     * @param string                    $group
     * @param string                    $uri
     * @param string                    $host
     * @param \Kendo\Http\RoutingResult $result
     *
     * @return bool
     */
    public function resolveChildren($group, $uri, $host, RoutingResult $result)
    {
        if (empty($this->indexs[ $group ]))
            return false;

        foreach ($this->indexs[ $group ] as $name) {

            if (!isset($this->children[ $name ])) {
                continue;
            }
            if ($this->children[ $name ]->resolve($uri, $host, $result)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @ignore
     * @codeCoverageIgnore
     *
     * @param $replacements
     *
     * @return array
     */
    protected function correctReplacementsForChildRoute($replacements)
    {

        $result = [];

        foreach ($replacements as $key => $value) {
            $key = preg_replace('(\W+)', '', $key);
            $value = '/' . trim($value, '/');

            $key1 = '(/<' . $key . '>)';
            $key2 = '/<' . $key . '>';


            $result[ $key1 ] = $value;
            $result[ $key2 ] = $value;

        }

        return $result;
    }

    /**
     * @ignore
     * @codeCoverageIgnore
     *
     * @param array $child
     * @param array $parent
     *
     * @return \Kendo\Http\Router
     */
    protected function correctChildData($child, $parent)
    {
        if (empty($child['replacements'])) {
            throw new \InvalidArgumentException(sprintf('Missing params "replacements"'));
        }

        $replacements = $this->correctReplacementsForChildRoute($child['replacements']);

        unset($child['replacements']);

        if (!empty($parent['protocol'])) {
            $child['protocol'] = $parent['protocol'];
        }

        if (!empty($parent['uri'])) {
            $child['uri'] = strtr($parent['uri'], $replacements);
        }

        if (!empty($parent['host'])) {
            $child['host'] = strtr($parent['host'], $replacements);
        }

        if (!empty($parent['defaults'])) {
            if (!empty($child['defaults'])) {
                $child['defaults'] = array_merge($parent['defaults'], $child['defaults']);
            } else {
                $child['defaults'] = $parent['defaults'];
            }
        }

        return $child;
    }

    /**
     * @ignore
     *
     * @param array $params
     *
     * @return Router
     */
    protected function create($params)
    {
        if (!is_array($params))
            throw new \InvalidArgumentException("Invalid params " . var_export($params, 1));
        $class = null;
        switch (true) {
            case !empty($params['class']):
                $class = $params['class'];
                break;
            default:
                $class = '\\Kendo\\Http\\Router';
        }

        return new $class($params);
    }

    /**
     * @ignore
     */
    private function compileRoutes()
    {
        $this->masters = [];
        $this->children = [];

        // clone delegate children data
        foreach ($this->temporary['delegate'] as $name => $delegate) {
            $combine = [];

            if (!empty($this->temporary['children'][ $name ])) {
                $combine = $this->temporary['children'][ $name ];
            }

            if (!empty($this->temporary['children'][ $delegate ])) {
                $combine = array_merge($combine, $this->temporary['children'][ $delegate ]);

            }
            $this->temporary['children'][ $name ] = $combine;
            $this->temporary['children'][ $delegate ] = $combine;
        }

        /**
         * add children
         */
        foreach ($this->temporary['master'] as $name => $master) {
            if (!empty($this->temporary['children'][ $name ])) {
                $this->temporary['master'][ $name ]['children'] = array_keys($this->temporary['children'][ $name ]);
            }
        }

        // re-merged all data for children

        foreach ($this->temporary['children'] as $group => $children) {
            if (empty($this->temporary['master'][ $group ])) {
                throw new \InvalidArgumentException(sprintf('Unexpected group "%s", Could not compile children', $group));
            }
            $master = $this->temporary['master'][ $group ];
            foreach ($children as $name => $child) {
                $this->temporary['children'][ $group ][ $name ] = $this->correctChildData($child, $master);
                $this->indexs[ $group ][] = $group . '/' . $name;
            }
        }

        /**
         * Initial we create master rules
         */
        foreach ($this->temporary['master'] as $name => $master) {
            $this->masters[ $master['name'] ] = $this->create($master);
        }

        foreach ($this->temporary['children'] as $group => $children) {
            foreach ($children as $name => $child) {
                $key = $group . '/' . $name;
                $this->children[ $key ] = $this->create($child);
            }
        }
        unset($this->temporary);
    }

    /**
     * @param array $params Routing Params
     *
     * @return RoutingManager
     */
    public function add($params)
    {
        $arr = explode('/', $params['name'], 2);

        if (count($arr) == 2) {
            $params['name'] = $arr[1];
            $this->temporary['children'][ $arr[0] ][ $arr[1] ] = $params;
        } else {
            $this->temporary['master'][ $params['name'] ] = $params;
        }

        if (isset($params['delegate'])) {
            $this->temporary['delegate'][ $params['name'] ] = $params['delegate'];
        }

        return $this;
    }

    /**
     * @param string $name
     * @param array  $params
     *
     * @return string
     */
    public function getUrl($name, $params = [])
    {
        return $this->getRoute($name)->getUrl($params);
    }

    /**
     * @param $any
     * @param $params
     *
     * @return string
     */
    public function getAdminUrl($any, $params)
    {
        if (!empty($any)) {
            $params['any'] = $any;
        }

        return $this->getRoute('admin')->getUrl($params);
    }


    /**
     * @param HttpRequest $request
     *
     * @return bool
     */
    public function resolve(HttpRequest $request)
    {
        /**
         * pre-filter to match request
         */


        if (KENDO_PROFILER) {
            $profilerKey = \App::profiler()->start('request', 'routing.resolve', $request->getPath());
        }

        $path = $request->getPath();
        $host = null;
        $result = new RoutingResult([]);
        $matched = false;

        // ensure it's not children
        foreach ($this->masters as $name => $route) {

            if (!$route->resolve($path, $host, $result)) {
                continue;
            }

            $vars = $result->getVars();

            $request->setControllerName($vars[ HttpRequest::CONTROLLER_KEY ]);
            $request->setActionName($vars[ HttpRequest::ACTION_KEY ]);

            unset($vars[ HttpRequest::CONTROLLER_KEY ], $vars[ HttpRequest::ACTION_KEY ]);

            $request->setParams($vars);

            \App::requester()->setRouting($name, $vars);

            $matched = true;

            break;
        }

        if (!$matched) {
            $request->setControllerName('Platform\Core\Controller\ErrorController');
            $request->setActionName('404');
        }

        if (KENDO_PROFILER and !empty($profilerKey)) {
            \App::profiler()->stop($profilerKey);
        }

        return true;
    }
}