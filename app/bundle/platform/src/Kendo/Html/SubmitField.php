<?php

namespace Kendo\Html;

/**
 * Class SubmitField
 *
 * @package Kendo\Html
 */
class SubmitField extends ButtonField
{

    /**
     * @var string
     */
    protected $value = "submit";

    /**
     * Override method
     */
    protected function init()
    {
        if (null == $this->getName()) {
            $this->setName('_submit');
        }

        $this->setAttribute('type', 'submit');
    }
}