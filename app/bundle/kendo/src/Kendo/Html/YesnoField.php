<?php
namespace Kendo\Html;

/**
 * Class YesnoField
 *
 * @package Kendo\Html
 */
class YesnoField extends RadioField
{
    /**
     * @var bool
     */
    protected $inline = true;

    /**
     * @var string
     */
    protected $value;

    /**
     * @var string
     */
    protected $optionTextKey = 'core.';

    /**
     * @var array
     */
    protected $options = [
        ['value' => "1", 'label' => 'yes'],
        ['value' => "0", 'label' => 'no'],
    ];
}

