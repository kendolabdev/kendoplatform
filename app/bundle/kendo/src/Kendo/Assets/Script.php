<?php

namespace Kendo\Assets;

/**
 * Class Script
 *
 * @package Kendo\Assets
 */
class Script implements Collection
{

    /**
     * @var array
     */
    private $vars = [];

    /**
     * @return array
     */
    public function getVars()
    {
        return $this->vars;
    }

    /**
     * @param array $vars
     */
    public function setVars($vars)
    {
        $this->vars = $vars;
    }

    /**
     * @param string $name
     * @param string $attributes
     *
     * @return Script
     */
    public function add($name, $attributes)
    {
        $this->vars[ $name ] = $attributes;

        return $this;
    }

    /**
     * @param  string $name
     *
     * @return string|null
     */
    public function get($name)
    {
        return isset($this->vars[ $name ]) ? $this->vars[ $name ] : null;
    }

    /**
     * @param  string $name
     *
     * @return Script
     */
    public function remove($name)
    {
        if (isset($this->vars[ $name ])) {
            unset($this->vars[ $name ]);
        }

        return $this;
    }

    /**
     * @return Script
     */
    public function clear()
    {
        $this->vars = [];

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }

    /**
     * @return string
     */
    public function render()
    {
        if (empty($this->vars)) {
            return '';
        }

        return implode("; ", $this->vars);
    }
}