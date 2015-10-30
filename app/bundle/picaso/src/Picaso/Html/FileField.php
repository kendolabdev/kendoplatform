<?php

namespace Picaso\Html;

/**
 * Class FileField
 *
 * @package Picaso\Html
 */
class FileField extends TextField
{
    /**
     * @var bool
     */
    protected $multiple = false;

    /**
     * @return string
     */
    public function toHtml()
    {
        $this->beforeRender();

        $prop = $this->attributes;

        if ($this->isMultiple()) {
            $prop['name'] = $this->getName() . '[]';
            $prop['multiple'] = "true";
        }

        return '<input ' . $this->_flat($prop) . ' />';
    }

    /**
     * @return boolean
     */
    public function isMultiple()
    {
        return $this->multiple;
    }

    /**
     * @param boolean $multiple
     */
    public function setMultiple($multiple)
    {
        $this->multiple = (bool)$multiple;
    }

    /**
     * Override method
     */
    protected function init()
    {
        $this->setAttribute('type', 'file');
    }
}