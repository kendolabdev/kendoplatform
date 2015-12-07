<?php

namespace Kendo\Html;

/**
 * Class PasswordField
 *
 * @package Kendo\Html
 */
class PasswordField extends TextField
{
    /**
     * Override method
     */
    protected function init()
    {
        $this->setAttribute('type', 'password');
        $this->setAttribute('autocomplete', 'off');
    }
}