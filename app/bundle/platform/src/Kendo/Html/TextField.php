<?php

namespace Kendo\Html;


/**
 * Class TextField
 *
 * @package Kendo\Form
 */
class TextField extends HtmlElement implements FormField
{
    /**
     * @var string
     */
    protected $value;

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
        $this->setAttribute('value', (string) $value);
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function toHtml()
    {
        $this->beforeRender();

        return '<input ' . $this->_flat($this->attributes) . ' />';
    }

    /**
     * Override method
     */
    protected function init()
    {
        $this->setAttribute('type', 'text');
    }

}
