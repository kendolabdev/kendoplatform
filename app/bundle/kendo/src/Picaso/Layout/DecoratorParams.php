<?php

namespace Picaso\Layout;

/**
 * Class DecoratorParams
 * @package Picaso\Layout
 */
class DecoratorParams
{
    /**
     * @var string
     */
    protected $plugin = 'default';

    /**
     * @var array
     */
    protected $data = [];

    /**
     * DecoratorParams constructor.
     * @param $type
     * @param array $data
     */
    public function __construct($type, $data = [])
    {
        $this->data = $data;
        $this->plugin = $type;
    }

    /**
     * @return string
     */
    public function getPlugin()
    {
        return $this->plugin;
    }

    /**
     * @param string $plugin
     */
    public function setPlugin($plugin)
    {
        $this->plugin = $plugin;
    }

    /**
     * @param  string $name
     * @param  string $default_value
     * @return string|array
     */
    public function get($name, $default_value = '')
    {
        return isset($this->data[ $name ]) ? $this->data[ $name ] : $default_value;
    }

    /**
     * @param $name
     * @param $value
     */
    public function set($name, $value)
    {
        $this->data[ $name ] = $value;
    }

    /**
     * @param $name
     * @return array|string
     */
    public function __get($name)
    {
        return $this->get($name);
    }
}