<?php

namespace Kendo\Assets;

/**
 * Class Title
 *
 * @package Kendo\Assets
 */
class Title implements Collection
{

    /**
     * @var array
     */
    private $vars = [];

    /**
     * @var string
     */
    private $glue = '-';

    /**
     * @return array
     */
    public function getVars()
    {
        return $this->vars;
    }

    /**
     * @param array|string $vars
     */
    public function setVars($vars)
    {
        if (is_string($vars))
            $vars = [$vars];

        $this->vars = $vars;
    }

    /**
     * @param $vars
     */
    public function set($vars)
    {
        if (is_string($vars))
            $vars = [$vars];

        $this->vars = $vars;
    }

    /**
     * @param $string
     *
     * @return Title
     */
    public function add($string)
    {
        $this->vars[] = $string;

        return $this;
    }

    /**
     * @return Title
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
        return '<title>' . $this->toText() . '</title>';
    }

    /**
     * @return string
     */
    public function toText()
    {
        $response = [];

        foreach ($this->vars as $string) {
            $response[] = htmlentities($string);
        }

        return implode($this->getGlue(), $response);
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