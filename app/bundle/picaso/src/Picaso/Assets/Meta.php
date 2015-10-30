<?php

namespace Picaso\Assets;

/**
 * Class Meta
 *
 * @package Picaso\Assets
 */
class Meta implements Collection
{

    /**
     * @var array
     */
    protected $vars = [];

    /**
     * Default constructor
     */
    public function __construct()
    {
        $this->add('content-type', ['http-equiv' => 'content-type', 'content' => 'text/html']);
        $this->add('charset', ['charset' => 'utf-8']);
    }

    /**
     * @param string $name
     * @param array  $attributes
     *
     * @return Meta
     */
    public function add($name, $attributes)
    {
        $this->vars[ $name ] = $attributes;

        return $this;
    }

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
     * @param $name
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
     * @return Meta
     */
    public function remove($name)
    {
        if (isset($this->vars[ $name ])) {
            unset($this->vars[ $name ]);
        }

        return $this;
    }

    /**
     * clear all vars
     *
     * @return Meta
     */
    public function clear()
    {
        $this->vars = [];
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
            $response[] = '<meta ' . Manager::implodeAttributes($attributes) . '/>';
        }

        return implode(PHP_EOL, $response);
    }
}