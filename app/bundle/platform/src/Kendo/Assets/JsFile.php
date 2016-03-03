<?php

namespace Kendo\Assets;

/**
 * Class JsFile
 */
class JsFile implements Collection
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
     * @return JsFile
     */
    public function add($name, $attributes)
    {
        if (is_array($attributes)) {
            $this->vars[ $name ] = $attributes;
        } else {
            $this->vars[ $name ] = ['src' => $attributes];
        }

        return $this;
    }

    /**
     * @param $array
     *
     * @return JsFile
     */
    public function addAll($array)
    {
        $this->vars = array_merge($this->vars, $array);

        return $this;
    }

    /**
     * @param string       $name
     * @param array|string $attributes
     *
     * @return JsFile
     */
    public function prepend($name, $attributes)
    {
        if (is_string($attributes)) {
            $attributes = ['src' => $attributes];
        }

        $array = [$name => $attributes];
        $this->vars = array_merge($array, $this->vars);

        return $this;

    }

    /**
     * @param array $array
     *
     * @return JsFile
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
     * @return JsFile
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
     * @return JsFile
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

        if (empty($this->vars)) {
            return '';
        }

        foreach ($this->vars as $attributes) {
            if (empty($attributes)) {
                continue;
            }
            $response[] = '<script type="text/javascript" ' . AssetsManager::implodeAttributes($attributes) . ' ></script>';
        }

        return implode(PHP_EOL, $response);
    }
}