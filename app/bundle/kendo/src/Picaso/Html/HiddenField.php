<?php

namespace Picaso\Html;

/**
 * Class HiddenField
 *
 * @package Picaso\Html
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