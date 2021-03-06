<?php
namespace Kendo\Html;

/**
 * Class GenderField
 *
 * @package Kendo\Html
 */
class GenderField extends SelectField
{
    /**
     *
     */
    protected function init()
    {
        parent::init();

        $this->setOptionTextKey('core.gender_opt_');

        /**
         * default options
         *
         * TODO: options should be configs via admincp
         */
        $this->options = [
            ['value' => 'male'],
            ['value' => 'female'],
        ];
    }
}