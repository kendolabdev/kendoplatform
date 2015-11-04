<?php

namespace Picaso\Assets;

/**
 * Class Link
 *
 * @package Picaso\Assert
 */
class Link implements Collection
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
     * @param array  $attributes
     *
     * @return Link
     */
    public function add($name, $attributes)
    {
        $this->vars[ $name ] = $attributes;

        return $this;
    }

    /**
     * @param $array
     *
     * @return Link
     */
    public function addAll($array)
    {
        $this->vars = array_merge($this->vars, $array);

        return $this;
    }

    /**
     * @param string $name
     * @param array  $attributes
     *
     * @return $this
     */
    public function prepend($name, $attributes)
    {
        if (!is_array($attributes)) {
            $attributes = ['href' => $attributes, 'rel' => 'stylesheet', 'type' => 'text/css'];
        }

        $this->vars = array_merge([$name => $attributes], $this->vars);

        return $this;
    }

    /**
     * @param array $array
     *
     * @return Link
     */
    public function prependAll($array)
    {
        $this->vars = array_merge($array, $this->vars);

        return $this;
    }

    /**
     * @param string $name
     *
     * @return array|null
     */
    public function get($name)
    {
        return isset($this->vars[ $name ]) ? $this->vars[ $name ] : null;
    }

    /**
     * @param string $name
     *
     * @return Link
     */
    public function remove($name)
    {
        if (isset($this->vars[ $name ])) {
            unset($this->vars[ $name ]);
        }

        return $this;
    }

    /**
     * Clear all vars
     *
     * @return Link
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
        $response = [];
        foreach ($this->vars as $attributes) {
            if (empty($attributes)) {
                continue;
            }
            $response[] = '<link ' . Manager::implodeAttributes($attributes) . '/>';
        }

        return implode(PHP_EOL, $response);
    }
}