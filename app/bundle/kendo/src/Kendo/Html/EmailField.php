<?php

namespace Kendo\Html;

/**
 * Class EmailField
 *
 * @package Kendo\Html
 */
class EmailField extends TextField
{
    /**
     * Override method
     */
    protected function init()
    {
        $this->setAttribute('type', 'email');
    }
}