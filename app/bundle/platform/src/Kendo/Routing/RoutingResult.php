<?php
namespace Kendo\Routing;

/**
 * Result container
 *
 * Class Result
 *
 * @package Kendo\Routing
 */
class RoutingResult
{
    /**
     * @var array
     */
    private $vars = [];

    /**
     * @param array $vars
     */
    public function construct($vars = [])
    {
        $this->vars = $vars;
    }

    /**
     * @param $name
     * @param $value
     *
     * @return RoutingResult
     */
    public function set($name, $value)
    {
        $this->vars[ $name ] = $value;
    }

    /**
     * @param string $name
     * @param mixed  $defaultValue
     *
     * @return mixed
     */
    public function get($name, $defaultValue = null)
    {
        return isset($this->vars[ $name ]) ? $this->vars[ $name ] : $defaultValue;
    }

    /**
     * @param array $vars
     *
     * @return RoutingResult
     */
    public function addVars($vars)
    {
        foreach ($vars as $name => $value) {
            $this->vars[ $name ] = $value;
        }

        return $this;
    }

    /**
     * Set new vars
     *
     * @param array $vars
     */
    public function setVars($vars)
    {
        $this->vars = $vars;
    }

    /**
     *
     */
    public function reset()
    {
        $this->vars = [];
    }

    /**
     * @return array
     */
    public function getVars()
    {
        return $this->vars;
    }
}