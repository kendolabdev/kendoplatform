<?php

namespace Picaso\Html;

/**
 * Class ResetField
 *
 * @package Picaso\Html
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