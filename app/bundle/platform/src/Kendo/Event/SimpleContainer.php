<?php
namespace Kendo\Event;

/**
 * Class SimpleContainer
 *
 * @package Kendo\Hook
 */
class SimpleContainer
{
    /**
     * @var array
     */
    protected $vars = [];

    /**
     * SimpleContainer constructor.
     *
     * @param array $vars
     */
    public function __construct($vars = [])
    {
        $this->vars = $vars;
    }

    /**
     * @param string $name
     * @param mixed  $value
     *
     * @return SimpleContainer
     */
    public function add($name, $value)
    {
        $this->vars[ $name ] = $value;

        return $this;
    }

    /**
     * @param string $name
     * @param null   $default
     *
     * @return mixed
     */
    public function get($name, $default = null)
    {
        return isset($this->vars[ $name ]) ? $this->vars[ $name ] : $default;
    }

    /**
     * @return SimpleContainer
     */
    public function reset()
    {
        $this->vars = [];

        return $this;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->vars;
    }
}