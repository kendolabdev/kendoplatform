<?php

namespace Kendo\Assets;

/**
 * Class Desc
 *
 * @package Kendo\Assets
 */
class Desc implements Collection
{


    /**
     * @var array
     */
    private $vars = [];

    /**
     * @var string
     */
    private $glue = ', ';


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
        if (is_string($vars)) {
            $vars = [$vars];
        }
        $this->vars = $vars;
    }

    /**
     * @param $string
     *
     * @return Desc
     */
    public function add($string)
    {
        $this->vars[] = $string;

        return $this;
    }

    /**
     * @return Desc
     */
    public function clear()
    {
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

        foreach ($this->vars as $string) {
            $response[] = htmlentities($string);
        }

        return '<meta name="description" content="' . implode($this->getGlue(), $response) . '"/>';
    }

    /**
     * @return string
     */
    public function getGlue()
    {
        return $this->glue;
    }

    /**
     * @param string $glue
     */
    public function setGlue($glue)
    {
        $this->glue = $glue;

    }
}