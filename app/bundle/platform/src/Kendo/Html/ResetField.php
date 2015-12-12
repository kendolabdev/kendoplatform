<?php

namespace Kendo\Html;

/**
 * Class ResetField
 *
 * @package Kendo\Html
 */
class ResetField extends ButtonField
{
    /**
     * Override method
     */
    protected function init()
    {
        $this->setAttribute('type', 'reset');
    }
}