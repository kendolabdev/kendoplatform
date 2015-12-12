<?php

namespace Kendo\Routing;

/**
 * Class FilterPrefix
 *
 * @package Kendo\Routing
 */
class FilterPrefix implements FilterInterface
{

    /**
     * @var string
     */
    private $prefix = 'default';

    /**
     * @param array $params
     */
    public function __construct($params)
    {
        if (!empty($params['prefix'])) {
            $this->setPrefix($params['prefix']);
        }

    }


    /**
     * @param array $params
     *
     * @return bool|array
     */
    public function filter($params)
    {
        // TODO: Implement filter() method.

        $stuff = $params['stuff'];

        /* split by splish */

        $arr = explode('/', str_replace('//', '/', $stuff));

        $params['action'] = array_pop($arr);

        foreach ($arr as $index => $ar) {
            $arr[ $index ] = \App::inflect($ar);
        }

        $module = array_shift($arr);

        $prefix = $this->getPrefix();

        if (!empty($params['prefix'])) {
            $prefix = $params['prefix'];
        }

        $params['controller'] = '\\' . $module . '\\Controller\\' . \App::inflect($prefix) . '\\' . implode('\\', $arr) . 'Controller';


        return $params;
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param string $prefix
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    /**
     * @return boolean
     */
    public function isChain()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function stopOnFail()
    {
        return true;
    }
}