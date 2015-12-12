<?php

namespace Kendo\Html;

/**
 * Class ButtonField
 *
 * @package Kendo\Html
 */
class ButtonField extends HtmlElement implements FormField
{
    /**
     * @var string
     */
    protected $value;

    /**
     * @return string
     */
    public function toHtml()
    {
        $this->beforeRender();

        return '<button ' . $this->_flat($this->attributes) . '>' . $this->getLabel() . '</button>';
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return bool
     */
    public function hasLabel()
    {
        return false;
    }
}