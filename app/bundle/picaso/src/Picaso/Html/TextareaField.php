<?php

namespace Picaso\Html;

/**
 * Class TextareaField
 *
 * @package Picaso\Html
 */
class TextareaField extends HtmlElement implements FormField
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

        return '<textarea ' . $this->_flat($this->attributes) . '>' . $this->getValue() . '</textarea>';
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

}