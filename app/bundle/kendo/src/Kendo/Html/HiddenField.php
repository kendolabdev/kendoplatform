<?php

namespace Kendo\Html;

/**
 * Class HiddenField
 *
 * @package Kendo\Html
 */
class HiddenField extends TextField
{
    /**
     * @return bool
     */
    public function isHidden()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function hasLabel()
    {
        return false;
    }

    /**
     * Override method
     */
    protected function init()
    {
        $this->setAttribute('type', 'hidden');
    }

}