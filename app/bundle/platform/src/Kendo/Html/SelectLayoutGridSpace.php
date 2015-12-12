<?php

namespace Kendo\Html;

/**
 * Class SelectLayoutGridSpace
 *
 * @package Kendo\Html
 */
class SelectLayoutGridSpace extends SelectField
{
    /**
     * @var bool
     */
    protected $required = true;

    /**
     * @var string
     */
    protected $value = 'card-space-sm';

    /**
     * Available options
     *
     * @var array
     */
    protected $options = [
        ['value' => 'card-space-md', 'label' => 'Default - 15px'],
        ['value' => 'card-space-sm', 'label' => 'Small - 12px'],
        ['value' => 'card-space-xs', 'label' => 'Smaller - 5px'],
        ['value' => 'card-space-xxs', 'label' => 'Extra Small - 2px'],
    ];

    protected function init()
    {
        parent::init();

        $this->setLabel('core.layout_grid_space');
        $this->setNote('core.layout_grid_space_node');
        $this->setName('card_space');
    }
}