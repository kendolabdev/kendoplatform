<?php

namespace Picaso\Html;

/**
 * Class PasswordField
 *
 * @package Picaso\Html
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