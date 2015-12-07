<?php
namespace Kendo\Assets;

/**
 * Class Breadcrum
 *
 * @package Kendo\Assets
 */
class Breadcrum implements Collection
{

    /**
     * @var array
     */
    private $vars = [];

    /**
     * @param array $vars
     */
    public function setVars($vars)
    {
        $this->vars = $vars;
    }

    /**
     * @param array $var
     */
    public function add($var)
    {
        $this->vars[] = $var;
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
        // TODO: Implement render() method.
    }
}