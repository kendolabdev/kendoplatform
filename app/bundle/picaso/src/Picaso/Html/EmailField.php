<?php

namespace Picaso\Html;

/**
 * Class EmailField
 *
 * @package Picaso\Html
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