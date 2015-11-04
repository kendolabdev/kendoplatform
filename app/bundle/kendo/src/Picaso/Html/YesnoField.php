<?php
namespace Picaso\Html;

/**
 * Class YesnoField
 *
 * @package Picaso\Html
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

